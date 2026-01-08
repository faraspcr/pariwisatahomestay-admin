<?php
namespace App\Http\Controllers;

use App\Models\DestinasiWisata;
use App\Models\UlasanWisata;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UlasanWisataController extends Controller
{
    /**
     * ADMIN: Lihat semua ulasan
     * PEMILIK: Hanya lihat ulasan (view only)
     * WARGA: Hanya lihat ulasan (view only untuk public)
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        // Kolom yang bisa di-filter
        $filterableColumns = ['rating'];
        $searchableColumns = ['komentar'];

        // Query dasar
        $query = UlasanWisata::with(['destinasi', 'warga']);

        // ✅ PERBAIKAN: Hapus filter status karena kolom tidak ada
        // if ($user->isPemilik() || $user->isWarga()) {
        //     // PEMILIK & WARGA: Hanya lihat ulasan untuk destinasi yang aktif
        //     $query->whereHas('destinasi', function($q) {
        //         $q->where('status', 'aktif'); // ❌ DIHAPUS
        //     });
        // }
        // ADMIN: Lihat semua

        // Terapkan filter dan search
        $ulasan = $query->filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->orderBy('waktu', 'desc')
            ->paginate(10)
            ->onEachSide(2);

        // Stats untuk cards
        $baseQuery = UlasanWisata::filter($request, $filterableColumns)
                        ->search($request, $searchableColumns);

        // ✅ PERBAIKAN: Hapus filter status untuk stats
        // Filter stats berdasarkan role
        // if ($user->isPemilik() || $user->isWarga()) {
        //     $baseQuery->whereHas('destinasi', function($q) {
        //         $q->where('status', 'aktif'); // ❌ DIHAPUS
        //     });
        // }

        $stats = [
            'totalUlasan'       => $user->isAdmin() ? UlasanWisata::count() : $baseQuery->count(),
            'avgRating'         => $baseQuery->avg('rating') ?? 0,
            'totalDestinasi'    => $user->isAdmin() ? DestinasiWisata::count() : DestinasiWisata::count(), // ✅ PERBAIKAN: Hapus where status
            'ulasanBulanIni'    => $baseQuery->whereMonth('waktu', now()->month)
                ->whereYear('waktu', now()->year)
                ->count(),
            'totalFiltered'     => $baseQuery->count(),
            'avgRatingFiltered' => $baseQuery->avg('rating') ?? 0,
        ];

        return view('pages.ulasan_wisata.index', array_merge([
            'ulasan'        => $ulasan,
            'currentRating' => $request->input('rating'),
            'currentSearch' => $request->input('search'),
        ], $stats));
    }

    /**
     * ADMIN: Buat ulasan untuk siapa saja
     * PEMILIK: Tidak bisa create ulasan
     * WARGA: Hanya bisa create ulasan untuk dirinya sendiri
     */
    public function create()
    {
        $user = Auth::user();

        if ($user->isAdmin()) {
            // ADMIN: Pilih semua destinasi dan warga
            $destinasi = DestinasiWisata::all();
            $warga = Warga::all();
        } elseif ($user->isWarga()) {
            // WARGA: Hanya bisa create ulasan untuk dirinya sendiri
            $warga = Warga::where('warga_id', $user->warga_id)->get();

            // ✅ PERBAIKAN: Hapus filter status
            // Hanya destinasi yang aktif
            $destinasi = DestinasiWisata::all(); // Tanpa where status
        } else {
            // PEMILIK: Tidak boleh create ulasan
            abort(403, 'Anda tidak memiliki akses untuk membuat ulasan.');
        }

        return view('pages.ulasan_wisata.create', compact('destinasi', 'warga'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        // ✅ VALIDASI BERDASARKAN ROLE
        $validationRules = [
            'destinasi_id' => 'required|exists:destinasi_wisata,destinasi_id',
            'rating'       => 'required|integer|between:1,5',
            'komentar'     => 'required|string|min:10',
        ];

        if ($user->isAdmin()) {
            // ADMIN: Bisa pilih warga siapa saja
            $validationRules['warga_id'] = 'required|exists:warga,warga_id';
        } elseif ($user->isWarga()) {
            // WARGA: Otomatis pakai warga_id sendiri
            $request->merge(['warga_id' => $user->warga_id]);
        } else {
            // PEMILIK: Tidak boleh create ulasan
            abort(403, 'Anda tidak memiliki akses untuk membuat ulasan.');
        }

        $validated = $request->validate($validationRules, [
            'destinasi_id.required' => 'Destinasi wisata wajib dipilih',
            'destinasi_id.exists'   => 'Destinasi wisata tidak valid',
            'warga_id.required'     => 'Warga wajib dipilih',
            'warga_id.exists'       => 'Warga tidak valid',
            'rating.required'       => 'Rating wajib dipilih',
            'rating.between'        => 'Rating harus antara 1-5',
            'komentar.required'     => 'Komentar wajib diisi',
            'komentar.min'          => 'Komentar minimal 10 karakter',
        ]);

        // Cek apakah warga sudah memberikan ulasan untuk destinasi ini
        $existingReview = UlasanWisata::where('destinasi_id', $request->destinasi_id)
            ->where('warga_id', $request->warga_id)
            ->first();

        if ($existingReview) {
            return back()->withErrors(['destinasi_id' => 'Anda sudah memberikan ulasan untuk destinasi ini.'])->withInput();
        }

        UlasanWisata::create([
            'destinasi_id' => $request->destinasi_id,
            'warga_id'     => $request->warga_id,
            'rating'       => $request->rating,
            'komentar'     => $request->komentar,
            'waktu'        => now(),
        ]);

        // ✅ REDIRECT BERDASARKAN ROLE
        if ($user->isAdmin()) {
            return redirect()->route('admin.ulasan_wisata.index')
                ->with('success', 'Ulasan berhasil ditambahkan');
        } elseif ($user->isWarga()) {
            return redirect()->route('warga.ulasan.index')
                ->with('success', 'Ulasan berhasil ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = Auth::user();
        $ulasan = UlasanWisata::with(['destinasi', 'warga'])->findOrFail($id);

        // ✅ PERBAIKAN: Hapus authorization check berdasarkan status
        // if ($user->isPemilik() || $user->isWarga()) {
        //     // Pastikan destinasi aktif
        //     if ($ulasan->destinasi->status !== 'aktif') {
        //         abort(403, 'Anda tidak memiliki akses ke ulasan ini.');
        //     }
        // }

        return view('pages.ulasan_wisata.show', compact('ulasan'));
    }

    /**
     * Edit ulasan
     */
    public function edit($id)
    {
        $user = Auth::user();
        $ulasan = UlasanWisata::with(['destinasi', 'warga'])->findOrFail($id);

        // ✅ AUTHORIZATION CHECK
        if ($user->isPemilik()) {
            // PEMILIK: Tidak boleh edit ulasan
            abort(403, 'Anda tidak memiliki akses untuk mengedit ulasan.');
        } elseif ($user->isWarga()) {
            // WARGA: Hanya bisa edit ulasan miliknya sendiri
            if ($ulasan->warga_id != $user->warga_id) {
                abort(403, 'Anda hanya bisa mengedit ulasan milik Anda sendiri.');
            }
        }

        if ($user->isAdmin()) {
            $destinasi = DestinasiWisata::all();
            $warga = Warga::all();
        } elseif ($user->isWarga()) {
            // ✅ PERBAIKAN: Hapus filter status
            $destinasi = DestinasiWisata::all(); // Tanpa where status
            $warga = Warga::where('warga_id', $user->warga_id)->get();
        }

        return view('pages.ulasan_wisata.edit', compact('ulasan', 'destinasi', 'warga'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $ulasan = UlasanWisata::findOrFail($id);

        // ✅ AUTHORIZATION CHECK
        if ($user->isPemilik()) {
            abort(403, 'Anda tidak memiliki akses untuk mengupdate ulasan.');
        } elseif ($user->isWarga()) {
            if ($ulasan->warga_id != $user->warga_id) {
                abort(403, 'Anda hanya bisa mengupdate ulasan milik Anda sendiri.');
            }
        }

        // Validasi berdasarkan role
        $validationRules = [
            'rating'       => 'required|integer|between:1,5',
            'komentar'     => 'required|string|min:10',
        ];

        if ($user->isAdmin()) {
            $validationRules['destinasi_id'] = 'required|exists:destinasi_wisata,destinasi_id';
            $validationRules['warga_id'] = 'required|exists:warga,warga_id';
        } elseif ($user->isWarga()) {
            // WARGA: Tidak bisa ganti destinasi atau warga
            $request->merge([
                'destinasi_id' => $ulasan->destinasi_id,
                'warga_id' => $user->warga_id
            ]);
        }

        $validated = $request->validate($validationRules, [
            'destinasi_id.required' => 'Destinasi wisata wajib dipilih',
            'destinasi_id.exists'   => 'Destinasi wisata tidak valid',
            'warga_id.required'     => 'Warga wajib dipilih',
            'warga_id.exists'       => 'Warga tidak valid',
            'rating.required'       => 'Rating wajib dipilih',
            'rating.between'        => 'Rating harus antara 1-5',
            'komentar.required'     => 'Komentar wajib diisi',
            'komentar.min'          => 'Komentar minimal 10 karakter',
        ]);

        $ulasan->update($validated);

        // ✅ REDIRECT BERDASARKAN ROLE
        if ($user->isAdmin()) {
            return redirect()->route('admin.ulasan_wisata.index')
                ->with('success', 'Ulasan berhasil diperbarui');
        } elseif ($user->isWarga()) {
            return redirect()->route('warga.ulasan.index')
                ->with('success', 'Ulasan berhasil diperbarui');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = Auth::user();
        $ulasan = UlasanWisata::findOrFail($id);

        // ✅ AUTHORIZATION CHECK
        if ($user->isPemilik()) {
            abort(403, 'Anda tidak memiliki akses untuk menghapus ulasan.');
        } elseif ($user->isWarga()) {
            if ($ulasan->warga_id != $user->warga_id) {
                abort(403, 'Anda hanya bisa menghapus ulasan milik Anda sendiri.');
            }
        }

        $ulasan->delete();

        // ✅ REDIRECT BERDASARKAN ROLE
        if ($user->isAdmin()) {
            return redirect()->route('admin.ulasan_wisata.index')
                ->with('success', 'Ulasan berhasil dihapus');
        } elseif ($user->isWarga()) {
            return redirect()->route('warga.ulasan.index')
                ->with('success', 'Ulasan berhasil dihapus');
        }
    }

    /**
     * ====================================================
     * METHOD KHUSUS UNTUK WARGA (ULASAN SAYA)
     * ====================================================
     */

    /**
     * WARGA: Hanya lihat ulasan miliknya sendiri
     */
    public function myUlasan(Request $request)
    {
        $user = Auth::user();

        if (!$user->isWarga()) {
            abort(403, 'Hanya warga yang bisa mengakses halaman ini.');
        }

        $filterableColumns = ['rating'];
        $searchableColumns = ['komentar'];

        // Query untuk data tabel
        $query = UlasanWisata::with(['destinasi', 'warga'])
            ->where('warga_id', $user->warga_id);

        $ulasan = $query->filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->orderBy('waktu', 'desc')
            ->paginate(10)
            ->onEachSide(2);

        // ✅ TAMBAHKAN STATISTIK SEPERTI DI METHOD index()
        $baseQuery = UlasanWisata::filter($request, $filterableColumns)
                        ->search($request, $searchableColumns)
                        ->where('warga_id', $user->warga_id);

        $stats = [
            'totalUlasan'       => $baseQuery->count(),
            'avgRating'         => $baseQuery->avg('rating') ?? 0,
            'totalDestinasi'    => $baseQuery->distinct('destinasi_id')->count('destinasi_id'),
            'ulasanBulanIni'    => $baseQuery->whereMonth('waktu', now()->month)
                ->whereYear('waktu', now()->year)
                ->count(),
            'totalFiltered'     => $baseQuery->count(),
            'avgRatingFiltered' => $baseQuery->avg('rating') ?? 0,
        ];

        return view('pages.ulasan_wisata.index', array_merge([
            'ulasan'        => $ulasan,
            'currentRating' => $request->input('rating'),
            'currentSearch' => $request->input('search'),
        ], $stats));
    }

    /**
     * ====================================================
     * METHOD UNTUK PUBLIC VIEW (SEMUA ROLE BISA LIHAT)
     * ====================================================
     */

    /**
     * Public index - untuk semua role (view only)
     */
    public function publicIndex(Request $request)
    {
        $filterableColumns = ['rating'];
        $searchableColumns = ['komentar'];

        // ✅ PERBAIKAN: Hapus filter status
        $ulasan = UlasanWisata::with(['destinasi', 'warga'])
            ->filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->orderBy('waktu', 'desc')
            ->paginate(12)
            ->onEachSide(2);

        // ✅ TAMBAHKAN STATISTIK JIKA VIEW PUBLIC-INDEX BUTUH
        $baseQuery = UlasanWisata::filter($request, $filterableColumns)
                        ->search($request, $searchableColumns);

        $stats = [
            'totalUlasan'       => $baseQuery->count(),
            'avgRating'         => $baseQuery->avg('rating') ?? 0,
            'totalDestinasi'    => DestinasiWisata::count(),
            'ulasanBulanIni'    => $baseQuery->whereMonth('waktu', now()->month)
                ->whereYear('waktu', now()->year)
                ->count(),
            'totalFiltered'     => $baseQuery->count(),
            'avgRatingFiltered' => $baseQuery->avg('rating') ?? 0,
        ];

        return view('pages.ulasan_wisata.public-index', array_merge([
            'ulasan'        => $ulasan,
            'currentRating' => $request->input('rating'),
            'currentSearch' => $request->input('search'),
        ], $stats));
    }

    /**
     * Public show - untuk semua role (view only)
     */
    public function publicShow($id)
    {
        // ✅ PERBAIKAN: Hapus filter status
        $ulasan = UlasanWisata::with(['destinasi', 'warga'])
            ->findOrFail($id);

        return view('pages.ulasan_wisata.public-show', compact('ulasan'));
    }
}
