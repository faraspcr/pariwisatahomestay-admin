<?php
namespace App\Http\Controllers;

use App\Models\DestinasiWisata;
use App\Models\UlasanWisata;
use App\Models\Warga;
use Illuminate\Http\Request;

class UlasanWisataController extends Controller
{
    public function index(Request $request)
    {
        // Kolom yang bisa di-filter
        $filterableColumns = ['rating'];

        // TAMBAHKAN: Kolom yang bisa dicari (searchable columns)
        $searchableColumns = ['komentar'];

        // Query dengan filter DAN search
        $ulasan = UlasanWisata::with(['destinasi', 'warga'])
            ->filter($request, $filterableColumns)
            ->search($request, $searchableColumns) // TAMBAHKAN: Fitur search
            ->paginate(10)
            ->onEachSide(2);

        // Stats untuk cards (perlu dihitung ulang berdasarkan filter & search)
        $baseQuery = UlasanWisata::filter($request, $filterableColumns)
                        ->search($request, $searchableColumns);

        $stats = [
            'totalUlasan'       => UlasanWisata::count(),
            'avgRating'         => UlasanWisata::avg('rating') ?? 0,
            'totalDestinasi'    => DestinasiWisata::count(),
            'ulasanBulanIni'    => UlasanWisata::whereMonth('waktu', now()->month)
                ->whereYear('waktu', now()->year)
                ->count(),
            // Stats berdasarkan filter & search
            'totalFiltered'     => $baseQuery->count(),
            'avgRatingFiltered' => $baseQuery->avg('rating') ?? 0,
        ];

        return view('pages.ulasan_wisata.index', array_merge([
            'ulasan'        => $ulasan,
            'currentRating' => $request->input('rating'),
            'currentSearch' => $request->input('search'),
        ], $stats));
    }

    public function create()
    {
        $destinasi = DestinasiWisata::all();
        $warga = Warga::all();

        return view('pages.ulasan_wisata.create', compact('destinasi', 'warga'));
    }

    // Method store, edit, update, destroy tetap sama...
    public function store(Request $request)
    {
        $request->validate([
            'destinasi_id' => 'required|exists:destinasi_wisata,destinasi_id',
            'warga_id'     => 'required|exists:warga,warga_id',
            'rating'       => 'required|integer|between:1,5',
            'komentar'     => 'required|string|min:10',
        ], [
            'destinasi_id.required' => 'Destinasi wisata wajib dipilih',
            'destinasi_id.exists'   => 'Destinasi wisata tidak valid',
            'warga_id.required'     => 'Warga wajib dipilih',
            'warga_id.exists'       => 'Warga tidak valid',
            'rating.required'       => 'Rating wajib dipilih',
            'rating.between'        => 'Rating harus antara 1-5',
            'komentar.required'     => 'Komentar wajib diisi',
            'komentar.min'          => 'Komentar minimal 10 karakter',
        ]);

        UlasanWisata::create([
            'destinasi_id' => $request->destinasi_id,
            'warga_id'     => $request->warga_id,
            'rating'       => $request->rating,
            'komentar'     => $request->komentar,
            'waktu'        => now(),
        ]);

        return redirect()->route('ulasan_wisata.index')
            ->with('success', 'Ulasan berhasil ditambahkan');
    }

    public function edit($id)
    {
        $ulasan    = UlasanWisata::with(['destinasi', 'warga'])->findOrFail($id);
        $destinasi = DestinasiWisata::all();
        $warga     = Warga::all();
        return view('pages.ulasan_wisata.edit', compact('ulasan', 'destinasi', 'warga'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'destinasi_id' => 'required|exists:destinasi_wisata,destinasi_id',
            'warga_id'     => 'required|exists:warga,warga_id',
            'rating'       => 'required|integer|between:1,5',
            'komentar'     => 'required|string|min:10',
        ], [
            'destinasi_id.required' => 'Destinasi wisata wajib dipilih',
            'destinasi_id.exists'   => 'Destinasi wisata tidak valid',
            'warga_id.required'     => 'Warga wajib dipilih',
            'warga_id.exists'       => 'Warga tidak valid',
            'rating.required'       => 'Rating wajib dipilih',
            'rating.between'        => 'Rating harus antara 1-5',
            'komentar.required'     => 'Komentar wajib diisi',
            'komentar.min'          => 'Komentar minimal 10 karakter',
        ]);

        $ulasan = UlasanWisata::findOrFail($id);
        $ulasan->update([
            'destinasi_id' => $request->destinasi_id,
            'warga_id'     => $request->warga_id,
            'rating'       => $request->rating,
            'komentar'     => $request->komentar,
        ]);

        return redirect()->route('ulasan_wisata.index')
            ->with('success', 'Ulasan berhasil diperbarui');
    }

    public function destroy($id)
    {
        $ulasan = UlasanWisata::findOrFail($id);
        $ulasan->delete();

        return redirect()->route('ulasan_wisata.index')
            ->with('success', 'Ulasan berhasil dihapus');
    }
}
