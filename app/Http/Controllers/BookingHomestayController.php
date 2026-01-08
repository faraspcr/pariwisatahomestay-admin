<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookingHomestay;
use App\Models\KamarHomestay;
use App\Models\Warga;
use App\Models\Media;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BookingHomestayController extends Controller
{
    /**
     * ADMIN: Lihat semua booking
     * PEMILIK: Lihat booking di homestay miliknya
     * WARGA: Lihat booking miliknya sendiri
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        // Kolom yang bisa di-filter
        $filterableColumns = ['status', 'metode_bayar'];
        $searchableColumns = ['status', 'metode_bayar'];

        // Query dasar dengan relasi
        $query = BookingHomestay::with(['kamar', 'warga', 'kamar.homestay']);

        // ✅ FILTER BERDASARKAN ROLE
        if ($user->isPemilik()) {
            // PEMILIK: Hanya booking di homestay miliknya
            $query->whereHas('kamar.homestay', function($q) use ($user) {
                $q->where('pemilik_warga_id', $user->warga_id);
            });
        } elseif ($user->isWarga()) {
            // WARGA: Hanya booking miliknya sendiri
            $query->where('warga_id', $user->warga_id);
        }
        // ADMIN: Lihat semua (tidak ada filter tambahan)

        // Terapkan filter, search, dan pagination
        $bookings = $query->filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->onEachSide(2);

        // Data untuk dropdown (hanya admin yang butuh semua)
        $kamars = $user->isAdmin() ? KamarHomestay::with('homestay')->get() : collect();
        $wargas = $user->isAdmin() ? Warga::all() : collect();

        return view('pages.booking_homestay.index', compact('bookings', 'kamars', 'wargas'));
    }

    /**
     * ADMIN: Buat booking untuk siapa saja
     * PEMILIK: Tidak bisa create booking (hanya lihat)
     * WARGA: Hanya bisa booking untuk dirinya sendiri
     */
    public function create()
    {
        $user = Auth::user();

        if ($user->isAdmin()) {
            // ADMIN: Pilih semua kamar dan warga
            $kamars = KamarHomestay::with('homestay')->get();
            $wargas = Warga::all();
        } elseif ($user->isWarga()) {
            // WARGA: Hanya bisa booking untuk dirinya sendiri
            $wargas = Warga::where('warga_id', $user->warga_id)->get();

            // Hanya tampilkan kamar yang tersedia di homestay aktif
            $kamars = KamarHomestay::with('homestay')
                ->whereHas('homestay', function($q) {
                    $q->where('status', 'aktif');
                })
                ->get();
        } else {
            // PEMILIK: Tidak boleh create booking
            abort(403, 'Anda tidak memiliki akses untuk membuat booking.');
        }

        return view('pages.booking_homestay.create', compact('kamars', 'wargas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        // ✅ VALIDASI BERDASARKAN ROLE
        $validationRules = [
            'kamar_id' => 'required|exists:kamar_homestay,kamar_id',
            'checkin' => 'required|date|after_or_equal:today',
            'checkout' => 'required|date|after:checkin',
            'total' => 'required|numeric|min:0',
            'status' => 'required|in:pending,confirmed,paid,cancelled,completed',
            'metode_bayar' => 'nullable|in:cash,transfer,qris,other',
            'bukti_bayar.*' => 'nullable|file|mimes:jpg,jpeg,png,gif,webp,bmp,pdf,doc,docx|max:10240',
        ];

        if ($user->isAdmin()) {
            // ADMIN: Bisa pilih warga siapa saja
            $validationRules['warga_id'] = 'required|exists:warga,warga_id';
        } elseif ($user->isWarga()) {
            // WARGA: Otomatis pakai warga_id sendiri
            $request->merge(['warga_id' => $user->warga_id]);
            $validationRules['status'] = 'required|in:pending'; // Warga hanya bisa pending
        } else {
            // PEMILIK: Tidak boleh create booking
            abort(403, 'Anda tidak memiliki akses untuk membuat booking.');
        }

        $validated = $request->validate($validationRules, [
            'kamar_id.required' => 'Kamar wajib dipilih',
            'warga_id.required' => 'Warga wajib dipilih',
            'checkin.required' => 'Tanggal check-in wajib diisi',
            'checkin.after_or_equal' => 'Tanggal check-in tidak boleh di masa lalu',
            'checkout.required' => 'Tanggal check-out wajib diisi',
            'checkout.after' => 'Tanggal check-out harus setelah check-in',
            'total.required' => 'Total harga wajib diisi',
            'total.min' => 'Total harga tidak boleh negatif',
            'status.required' => 'Status wajib dipilih',
            'status.in' => 'Status tidak valid'
        ]);

        // Cek ketersediaan kamar
        $isAvailable = $this->cekKetersediaanKamar($request->kamar_id, $request->checkin, $request->checkout);

        if (!$isAvailable) {
            return back()->withErrors(['kamar_id' => 'Kamar tidak tersedia pada tanggal yang dipilih'])->withInput();
        }

        $booking = BookingHomestay::create($validated);

        // Upload file bukti bayar jika ada
        if ($request->hasFile('bukti_bayar')) {
            foreach ($request->file('bukti_bayar') as $key => $file) {
                $originalName = $file->getClientOriginalName();
                $filename = time() . '_' . $originalName;
                $file->storeAs('booking_homestay', $filename, 'public');

                Media::create([
                    'file_name' => 'booking_homestay/' . $filename,
                    'ref_table' => 'booking_homestay',
                    'ref_id' => $booking->booking_id,
                    'mime_type' => $file->getMimeType(),
                    'sort_order' => $key + 1,
                    'caption' => null,
                ]);
            }
        }

        // ✅ REDIRECT BERDASARKAN ROLE
        if ($user->isAdmin()) {
            return redirect()->route('admin.booking.index')
                ->with('success', 'Booking berhasil dibuat!');
        } elseif ($user->isWarga()) {
            return redirect()->route('warga.booking.index')
                ->with('success', 'Booking berhasil dibuat! Menunggu konfirmasi.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = Auth::user();
        $booking = BookingHomestay::with(['kamar', 'warga', 'kamar.homestay'])->findOrFail($id);

        // ✅ AUTHORIZATION CHECK
        if ($user->isPemilik()) {
            // PEMILIK: Hanya bisa lihat booking di homestay miliknya
            if ($booking->kamar->homestay->pemilik_warga_id != $user->warga_id) {
                abort(403, 'Anda hanya bisa melihat booking di homestay milik Anda.');
            }
        } elseif ($user->isWarga()) {
            // WARGA: Hanya bisa lihat booking miliknya sendiri
            if ($booking->warga_id != $user->warga_id) {
                abort(403, 'Anda hanya bisa melihat booking milik Anda sendiri.');
            }
        }

        $files = Media::where('ref_table', 'booking_homestay')
                     ->where('ref_id', $booking->booking_id)
                     ->orderBy('sort_order', 'asc')
                     ->get();

        return view('pages.booking_homestay.show', compact('booking', 'files'));
    }

    /**
     * Edit booking
     */
    public function edit($id)
    {
        $user = Auth::user();
        $booking = BookingHomestay::with(['kamar', 'warga', 'kamar.homestay'])->findOrFail($id);

        // ✅ AUTHORIZATION CHECK
        if ($user->isPemilik()) {
            // PEMILIK: Hanya bisa edit booking di homestay miliknya
            if ($booking->kamar->homestay->pemilik_warga_id != $user->warga_id) {
                abort(403, 'Anda hanya bisa mengedit booking di homestay milik Anda.');
            }
        } elseif ($user->isWarga()) {
            // WARGA: Hanya bisa edit booking miliknya sendiri yang masih pending
            if ($booking->warga_id != $user->warga_id) {
                abort(403, 'Anda hanya bisa mengedit booking milik Anda sendiri.');
            }
            if ($booking->status != 'pending') {
                abort(403, 'Anda hanya bisa mengedit booking yang masih pending.');
            }
        }

        // Data untuk dropdown
        if ($user->isAdmin()) {
            $kamars = KamarHomestay::with('homestay')->get();
            $wargas = Warga::all();
        } elseif ($user->isPemilik()) {
            // PEMILIK: Hanya kamar di homestay miliknya
            $kamars = KamarHomestay::with('homestay')
                ->whereHas('homestay', function($q) use ($user) {
                    $q->where('pemilik_warga_id', $user->warga_id);
                })
                ->get();
            $wargas = Warga::where('warga_id', $booking->warga_id)->get(); // Hanya warga ini
        } elseif ($user->isWarga()) {
            // WARGA: Hanya kamar yang tersedia, dan hanya dirinya sendiri
            $kamars = KamarHomestay::with('homestay')
                ->whereHas('homestay', function($q) {
                    $q->where('status', 'aktif');
                })
                ->get();
            $wargas = Warga::where('warga_id', $user->warga_id)->get();
        }

        $files = Media::where('ref_table', 'booking_homestay')
                     ->where('ref_id', $booking->booking_id)
                     ->orderBy('sort_order', 'asc')
                     ->get();

        return view('pages.booking_homestay.edit', compact('booking', 'kamars', 'wargas', 'files'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $booking = BookingHomestay::findOrFail($id);

        // ✅ AUTHORIZATION CHECK
        if ($user->isPemilik()) {
            if ($booking->kamar->homestay->pemilik_warga_id != $user->warga_id) {
                abort(403, 'Anda hanya bisa mengupdate booking di homestay milik Anda.');
            }
        } elseif ($user->isWarga()) {
            if ($booking->warga_id != $user->warga_id) {
                abort(403, 'Anda hanya bisa mengupdate booking milik Anda sendiri.');
            }
            if ($booking->status != 'pending') {
                abort(403, 'Anda hanya bisa mengupdate booking yang masih pending.');
            }
        }

        // Validasi berdasarkan role
        $validationRules = [
            'kamar_id' => 'required|exists:kamar_homestay,kamar_id',
            'checkin' => 'required|date',
            'checkout' => 'required|date|after:checkin',
            'total' => 'required|numeric|min:0',
            'status' => 'required|in:pending,confirmed,paid,cancelled,completed',
            'metode_bayar' => 'nullable|in:cash,transfer,qris,other',
            'bukti_bayar.*' => 'nullable|file|mimes:jpg,jpeg,png,gif,webp,bmp,pdf,doc,docx|max:10240',
        ];

        if ($user->isAdmin()) {
            $validationRules['warga_id'] = 'required|exists:warga,warga_id';
        } elseif ($user->isPemilik() || $user->isWarga()) {
            // Pemilik dan warga tidak bisa ganti warga
            $request->merge(['warga_id' => $booking->warga_id]);
        }

        $validated = $request->validate($validationRules);

        // Cek ketersediaan kamar (kecuali untuk booking ini sendiri)
        $isAvailable = $this->cekKetersediaanKamar($request->kamar_id, $request->checkin, $request->checkout, $id);

        if (!$isAvailable) {
            return back()->withErrors(['kamar_id' => 'Kamar tidak tersedia pada tanggal yang dipilih'])->withInput();
        }

        $booking->update($validated);

        // Upload file tambahan jika ada
        if ($request->hasFile('bukti_bayar')) {
            $currentMaxOrder = Media::where('ref_table', 'booking_homestay')
                                  ->where('ref_id', $booking->booking_id)
                                  ->max('sort_order') ?? 0;

            foreach ($request->file('bukti_bayar') as $key => $file) {
                $originalName = $file->getClientOriginalName();
                $filename = time() . '_' . $originalName;
                $file->storeAs('booking_homestay', $filename, 'public');

                Media::create([
                    'file_name' => 'booking_homestay/' . $filename,
                    'ref_table' => 'booking_homestay',
                    'ref_id' => $booking->booking_id,
                    'mime_type' => $file->getMimeType(),
                    'sort_order' => $currentMaxOrder + $key + 1,
                    'caption' => null,
                ]);
            }
        }

        // ✅ REDIRECT BERDASARKAN ROLE
        if ($user->isAdmin()) {
            return redirect()->route('admin.booking.show', $booking->booking_id)
                ->with('success', 'Booking berhasil diperbarui!');
        } elseif ($user->isPemilik()) {
            return redirect()->route('pemilik.booking.show', $booking->booking_id)
                ->with('success', 'Booking berhasil diperbarui!');
        } elseif ($user->isWarga()) {
            return redirect()->route('warga.booking.show', $booking->booking_id)
                ->with('success', 'Booking berhasil diperbarui!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = Auth::user();
        $booking = BookingHomestay::findOrFail($id);

        // ✅ AUTHORIZATION CHECK
        if ($user->isPemilik()) {
            // PEMILIK: Hanya bisa hapus booking di homestay miliknya
            if ($booking->kamar->homestay->pemilik_warga_id != $user->warga_id) {
                abort(403, 'Anda hanya bisa menghapus booking di homestay milik Anda.');
            }
        } elseif ($user->isWarga()) {
            // WARGA: Hanya bisa hapus booking miliknya sendiri yang masih pending
            if ($booking->warga_id != $user->warga_id) {
                abort(403, 'Anda hanya bisa menghapus booking milik Anda sendiri.');
            }
            if ($booking->status != 'pending') {
                abort(403, 'Anda hanya bisa menghapus booking yang masih pending.');
            }
        }

        // Hapus semua file terkait
        $files = Media::where('ref_table', 'booking_homestay')
                     ->where('ref_id', $booking->booking_id)
                     ->get();

        foreach ($files as $file) {
            Storage::disk('public')->delete($file->file_name);
            $file->delete();
        }

        $booking->delete();

        // ✅ REDIRECT BERDASARKAN ROLE
        if ($user->isAdmin()) {
            return redirect()->route('admin.booking.index')
                ->with('success', 'Booking berhasil dihapus!');
        } elseif ($user->isPemilik()) {
            return redirect()->route('pemilik.booking.index')
                ->with('success', 'Booking berhasil dihapus!');
        } elseif ($user->isWarga()) {
            return redirect()->route('warga.booking.index')
                ->with('success', 'Booking berhasil dihapus!');
        }
    }

    /**
     * ====================================================
     * METHOD KHUSUS UNTUK PEMILIK (BOOKING DI HOMESTAY SAYA)
     * ====================================================
     */

    /**
     * PEMILIK: Hanya lihat booking di homestay miliknya
     */
    public function myHomestayBooking(Request $request)
    {
        $user = Auth::user();

        if (!$user->isPemilik()) {
            abort(403, 'Hanya pemilik homestay yang bisa mengakses halaman ini.');
        }

        $filterableColumns = ['status', 'metode_bayar'];
        $searchableColumns = ['status', 'metode_bayar'];

        $bookings = BookingHomestay::with(['kamar', 'warga', 'kamar.homestay'])
            ->whereHas('kamar.homestay', function($q) use ($user) {
                $q->where('pemilik_warga_id', $user->warga_id);
            })
            ->filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->onEachSide(2);

    //     return view('pages.booking_homestay.my-homestay', compact('bookings'));
    // }
 return view('pages.booking_homestay.index', compact('bookings'));
}
    /**
     * ====================================================
     * METHOD KHUSUS UNTUK WARGA (BOOKING SAYA)
     * ====================================================
     */

    /**
     * WARGA: Hanya lihat booking miliknya sendiri
     */
    public function myBooking(Request $request)
    {
        $user = Auth::user();

        if (!$user->isWarga()) {
            abort(403, 'Hanya warga yang bisa mengakses halaman ini.');
        }

        $filterableColumns = ['status', 'metode_bayar'];
        $searchableColumns = ['status', 'metode_bayar'];

        $bookings = BookingHomestay::with(['kamar', 'warga', 'kamar.homestay'])
            ->where('warga_id', $user->warga_id)
            ->filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->onEachSide(2);

    //     return view('pages.booking_homestay.my-booking', compact('bookings'));
    // }
     return view('pages.booking_homestay.index', compact('bookings'));
}

    /**
     * ====================================================
     * HELPER METHOD & FILE UPLOAD (DENGAN AUTHORIZATION)
     * ====================================================
     */

    private function cekKetersediaanKamar($kamarId, $checkin, $checkout, $bookingId = null)
    {
        $query = BookingHomestay::where('kamar_id', $kamarId)
            ->where('status', '!=', 'cancelled')
            ->where(function($q) use ($checkin, $checkout) {
                $q->whereBetween('checkin', [$checkin, $checkout])
                  ->orWhereBetween('checkout', [$checkin, $checkout])
                  ->orWhere(function($q2) use ($checkin, $checkout) {
                      $q2->where('checkin', '<=', $checkin)
                         ->where('checkout', '>=', $checkout);
                  });
            });

        if ($bookingId) {
            $query->where('booking_id', '!=', $bookingId);
        }

        return $query->count() === 0;
    }

    public function uploadFiles(Request $request, string $id)
    {
        $user = Auth::user();
        $booking = BookingHomestay::with('kamar.homestay')->findOrFail($id);

        // ✅ AUTHORIZATION CHECK
        if ($user->isPemilik()) {
            if ($booking->kamar->homestay->pemilik_warga_id != $user->warga_id) {
                abort(403, 'Anda hanya bisa upload file untuk booking di homestay milik Anda.');
            }
        } elseif ($user->isWarga()) {
            if ($booking->warga_id != $user->warga_id) {
                abort(403, 'Anda hanya bisa upload file untuk booking milik Anda sendiri.');
            }
        }

        $request->validate([
            'bukti_bayar.*' => 'required|file|mimes:jpg,jpeg,png,gif,webp,bmp,pdf,doc,docx|max:10240',
        ]);

        $currentMaxOrder = Media::where('ref_table', 'booking_homestay')
                              ->where('ref_id', $booking->booking_id)
                              ->max('sort_order') ?? 0;

        if ($request->hasFile('bukti_bayar')) {
            foreach ($request->file('bukti_bayar') as $key => $file) {
                $originalName = $file->getClientOriginalName();
                $filename = time() . '_' . $originalName;
                $file->storeAs('booking_homestay', $filename, 'public');

                Media::create([
                    'file_name' => 'booking_homestay/' . $filename,
                    'ref_table' => 'booking_homestay',
                    'ref_id' => $booking->booking_id,
                    'mime_type' => $file->getMimeType(),
                    'sort_order' => $currentMaxOrder + $key + 1,
                    'caption' => null,
                ]);
            }
        }

        $fileCount = $request->hasFile('bukti_bayar') ? count($request->file('bukti_bayar')) : 0;
        return back()->with('success', "{$fileCount} file berhasil diupload!");
    }

    public function deleteFile(string $id, string $fileId)
    {
        $user = Auth::user();
        $booking = BookingHomestay::with('kamar.homestay')->findOrFail($id);

        // ✅ AUTHORIZATION CHECK
        if ($user->isPemilik()) {
            if ($booking->kamar->homestay->pemilik_warga_id != $user->warga_id) {
                abort(403, 'Anda hanya bisa menghapus file dari booking di homestay milik Anda.');
            }
        } elseif ($user->isWarga()) {
            if ($booking->warga_id != $user->warga_id) {
                abort(403, 'Anda hanya bisa menghapus file dari booking milik Anda sendiri.');
            }
        }

        $file = Media::where('media_id', $fileId)
            ->where('ref_table', 'booking_homestay')
            ->where('ref_id', $booking->booking_id)
            ->firstOrFail();

        $fileName = basename($file->file_name);
        Storage::disk('public')->delete($file->file_name);
        $file->delete();

        return back()->with('success', "File '{$fileName}' berhasil dihapus!");
    }

    // Method downloadFile dan showFile (tambahkan authorization check juga)
    public function downloadFile(string $id, string $fileId)
    {
        $user = Auth::user();
        $booking = BookingHomestay::with('kamar.homestay')->findOrFail($id);

        // Authorization check
        if ($user->isPemilik() && $booking->kamar->homestay->pemilik_warga_id != $user->warga_id) {
            abort(403, 'Anda tidak memiliki akses ke file ini.');
        } elseif ($user->isWarga() && $booking->warga_id != $user->warga_id) {
            abort(403, 'Anda tidak memiliki akses ke file ini.');
        }

        // ... sisa kode sama ...
    }
}
