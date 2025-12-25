<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookingHomestay;
use App\Models\KamarHomestay;
use App\Models\Warga;
use App\Models\Media;
use Illuminate\Support\Facades\Storage;

class BookingHomestayController extends Controller
{
    public function index(Request $request)
    {
        // Kolom yang bisa di-filter
        $filterableColumns = ['status', 'metode_bayar', 'tanggal'];

        // Kolom yang bisa di-search
        $searchableColumns = ['warga_nama', 'status', 'metode_bayar'];

        // Query dengan filter DAN search
        $bookings = BookingHomestay::with(['kamar', 'warga', 'kamar.homestay'])
            ->filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->onEachSide(2);

        // Data untuk dropdown filter
        $kamars = KamarHomestay::with('homestay')->get();
        $wargas = Warga::all();

        return view('pages.booking_homestay.index', compact('bookings', 'kamars', 'wargas'));
    }

    public function create()
    {
        $kamars = KamarHomestay::with('homestay')->get();
        $wargas = Warga::all();

        return view('pages.booking_homestay.create', compact('kamars', 'wargas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kamar_id' => 'required|exists:kamar_homestay,kamar_id',
            'warga_id' => 'required|exists:warga,warga_id',
            'checkin' => 'required|date|after_or_equal:today',
            'checkout' => 'required|date|after:checkin',
            'total' => 'required|numeric|min:0',
            'status' => 'required|in:pending,confirmed,paid,cancelled,completed',
            'metode_bayar' => 'nullable|in:cash,transfer,qris,other',
            'bukti_bayar.*' => 'nullable|file|mimes:jpg,jpeg,png,gif,webp,bmp,pdf,doc,docx|max:10240',
        ], [
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
                // Simpan dengan nama asli + timestamp agar unique
                $originalName = $file->getClientOriginalName();
                $filename = time() . '_' . $originalName;

                // Simpan file ke storage
                $file->storeAs('booking_homestay', $filename, 'public');

                // Simpan ke tabel media
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

        return redirect()->route('booking-homestay.index')
            ->with('success', 'Booking berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $booking = BookingHomestay::with(['kamar', 'warga', 'kamar.homestay'])->findOrFail($id);

        $files = Media::where('ref_table', 'booking_homestay')
                     ->where('ref_id', $booking->booking_id)
                     ->orderBy('sort_order', 'asc')
                     ->get();

        return view('pages.booking_homestay.show', compact('booking', 'files'));
    }

    public function edit($id)
    {
        $booking = BookingHomestay::with(['kamar', 'warga'])->findOrFail($id);
        $kamars = KamarHomestay::with('homestay')->get();
        $wargas = Warga::all();

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
        $validated = $request->validate([
            'kamar_id' => 'required|exists:kamar_homestay,kamar_id',
            'warga_id' => 'required|exists:warga,warga_id',
            'checkin' => 'required|date',
            'checkout' => 'required|date|after:checkin',
            'total' => 'required|numeric|min:0',
            'status' => 'required|in:pending,confirmed,paid,cancelled,completed',
            'metode_bayar' => 'nullable|in:cash,transfer,qris,other',
            'bukti_bayar.*' => 'nullable|file|mimes:jpg,jpeg,png,gif,webp,bmp,pdf,doc,docx|max:10240',
        ]);

        $booking = BookingHomestay::findOrFail($id);

        // Cek ketersediaan kamar (kecuali untuk booking ini sendiri)
        $isAvailable = $this->cekKetersediaanKamar($request->kamar_id, $request->checkin, $request->checkout, $id);

        if (!$isAvailable) {
            return back()->withErrors(['kamar_id' => 'Kamar tidak tersedia pada tanggal yang dipilih'])->withInput();
        }

        $booking->update($validated);

        // Upload file tambahan jika ada
        if ($request->hasFile('bukti_bayar')) {
            // Ambil urutan terakhir untuk sort_order
            $currentMaxOrder = Media::where('ref_table', 'booking_homestay')
                                  ->where('ref_id', $booking->booking_id)
                                  ->max('sort_order') ?? 0;

            foreach ($request->file('bukti_bayar') as $key => $file) {
                // Simpan dengan nama asli + timestamp
                $originalName = $file->getClientOriginalName();
                $filename = time() . '_' . $originalName;

                // Simpan file ke storage
                $file->storeAs('booking_homestay', $filename, 'public');

                // Simpan ke tabel media
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

        return redirect()->route('booking-homestay.show', $booking->booking_id)
            ->with('success', 'Booking berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $booking = BookingHomestay::findOrFail($id);

        // Hapus semua file terkait
        $files = Media::where('ref_table', 'booking_homestay')
                     ->where('ref_id', $booking->booking_id)
                     ->get();

        foreach ($files as $file) {
            Storage::disk('public')->delete($file->file_name);
            $file->delete();
        }

        $booking->delete();

        return redirect()->route('booking-homestay.index')
            ->with('success', 'Booking berhasil dihapus!');
    }

    /**
     * Cek ketersediaan kamar
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

    /**
     * Upload multiple files for booking homestay
     */
    public function uploadFiles(Request $request, string $id)
    {
        $request->validate([
            'bukti_bayar.*' => 'required|file|mimes:jpg,jpeg,png,gif,webp,bmp,pdf,doc,docx|max:10240',
        ]);

        $booking = BookingHomestay::findOrFail($id);

        // Ambil urutan terakhir untuk sort_order
        $currentMaxOrder = Media::where('ref_table', 'booking_homestay')
                              ->where('ref_id', $booking->booking_id)
                              ->max('sort_order') ?? 0;

        if ($request->hasFile('bukti_bayar')) {
            foreach ($request->file('bukti_bayar') as $key => $file) {
                // Simpan dengan nama asli + timestamp
                $originalName = $file->getClientOriginalName();
                $filename = time() . '_' . $originalName;

                // Simpan file ke storage
                $file->storeAs('booking_homestay', $filename, 'public');

                // Simpan ke tabel media
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

    /**
     * Delete specific file for booking homestay
     */
    public function deleteFile(string $id, string $fileId)
    {
        $booking = BookingHomestay::findOrFail($id);

        $file = Media::where('media_id', $fileId)
            ->where('ref_table', 'booking_homestay')
            ->where('ref_id', $booking->booking_id)
            ->firstOrFail();

        $fileName = basename($file->file_name);

        // Hapus file dari storage
        Storage::disk('public')->delete($file->file_name);

        // Hapus record dari database
        $file->delete();

        return back()->with('success', "File '{$fileName}' berhasil dihapus!");
    }

    /**
     * Download file
     */
    public function downloadFile(string $id, string $fileId)
    {
        $booking = BookingHomestay::findOrFail($id);

        $file = Media::where('media_id', $fileId)
            ->where('ref_table', 'booking_homestay')
            ->where('ref_id', $booking->booking_id)
            ->firstOrFail();

        // Cek apakah file ada
        if (!Storage::disk('public')->exists($file->file_name)) {
            abort(404, 'File tidak ditemukan');
        }

        // Ambil nama asli dari filename (hapus timestamp)
        $filename = basename($file->file_name);
        $originalName = substr($filename, strpos($filename, '_') + 1);

        // Download file
        return Storage::disk('public')->download($file->file_name, $originalName);
    }

    /**
     * Show file in browser (preview gambar & PDF)
     */
    public function showFile(string $id, string $fileId)
    {
        $booking = BookingHomestay::findOrFail($id);

        $file = Media::where('media_id', $fileId)
            ->where('ref_table', 'booking_homestay')
            ->where('ref_id', $booking->booking_id)
            ->firstOrFail();

        // Cek apakah file ada
        if (!Storage::disk('public')->exists($file->file_name)) {
            abort(404, 'File tidak ditemukan');
        }

        $mime = $file->mime_type;

        // Jika file adalah gambar atau PDF, tampilkan di browser
        if (str_starts_with($mime, 'image/') || $mime === 'application/pdf') {
            return Storage::disk('public')->response($file->file_name);
        }

        // Untuk DOC/DOCX, force download
        $filename = basename($file->file_name);
        $originalName = substr($filename, strpos($filename, '_') + 1);
        return Storage::disk('public')->download($file->file_name, $originalName);
    }

    /**
     * Rename file
     */
    public function renameFile(Request $request, string $id, string $fileId)
    {
        $request->validate([
            'new_filename' => 'required|string|max:255'
        ]);

        $booking = BookingHomestay::findOrFail($id);

        $file = Media::where('media_id', $fileId)
            ->where('ref_table', 'booking_homestay')
            ->where('ref_id', $booking->booking_id)
            ->firstOrFail();

        $oldFileName = $file->file_name;
        $newFilename = $request->new_filename;

        // Dapatkan ekstensi file lama
        $extension = pathinfo($oldFileName, PATHINFO_EXTENSION);

        // Buat nama file baru dengan ekstensi
        $newFileName = pathinfo($oldFileName, PATHINFO_DIRNAME) . '/' . $newFilename . '.' . $extension;

        // Rename file di storage
        if (Storage::disk('public')->exists($oldFileName)) {
            Storage::disk('public')->move($oldFileName, $newFileName);

            // Update di database
            $file->file_name = $newFileName;
            $file->save();

            return response()->json([
                'success' => true,
                'message' => 'Nama file berhasil diubah!',
                'new_filename' => basename($newFileName)
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'File tidak ditemukan di storage'
        ], 404);
    }
}
