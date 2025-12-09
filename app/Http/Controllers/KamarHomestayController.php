<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KamarHomestay;
use App\Models\Homestay;

class KamarHomestayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Kolom yang bisa di-filter
        $filterableColumns = ['homestay_id', 'kapasitas'];

        // Kolom yang bisa di-search
        $searchableColumns = ['nama_kamar', 'fasilitas_json'];

        // Query dengan filter DAN search
        $kamarHomestay = KamarHomestay::with('homestay')
            ->filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->paginate(10)
            ->onEachSide(2);

        // Ambil data homestay untuk dropdown filter
        $homestays = Homestay::all();

        return view('pages.kamar_homestay.index', compact('kamarHomestay', 'homestays'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $homestays = Homestay::all();
        return view('pages.kamar_homestay.create', compact('homestays'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'homestay_id' => 'required|exists:homestay,homestay_id',
            'nama_kamar' => 'required|string|max:100|min:3',
            'kapasitas' => 'required|integer|min:1|max:20',
            'fasilitas_json' => 'nullable|string',
            'harga' => 'required|numeric|min:0'
        ], [
            'homestay_id.required' => 'Homestay wajib dipilih',
            'homestay_id.exists' => 'Homestay tidak valid',
            'nama_kamar.required' => 'Nama kamar wajib diisi',
            'nama_kamar.min' => 'Nama kamar minimal 3 karakter',
            'kapasitas.required' => 'Kapasitas wajib diisi',
            'kapasitas.min' => 'Kapasitas minimal 1 orang',
            'kapasitas.max' => 'Kapasitas maksimal 20 orang',
            'harga.required' => 'Harga wajib diisi',
            'harga.min' => 'Harga tidak boleh negatif'
        ]);

        KamarHomestay::create($validated);

        return redirect()->route('kamar_homestay.index')
            ->with('success', 'Kamar homestay berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $kamar = KamarHomestay::findOrFail($id);
        $homestays = Homestay::all();
        return view('pages.kamar_homestay.edit', compact('kamar', 'homestays'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'homestay_id' => 'required|exists:homestay,homestay_id',
            'nama_kamar' => 'required|string|max:100|min:3',
            'kapasitas' => 'required|integer|min:1|max:20',
            'fasilitas_json' => 'nullable|string',
            'harga' => 'required|numeric|min:0'
        ]);

        $kamar = KamarHomestay::findOrFail($id);
        $kamar->update($validated);

        return redirect()->route('kamar_homestay.index')
            ->with('success', 'Kamar homestay berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kamar = KamarHomestay::findOrFail($id);
        $kamar->delete();

        return redirect()->route('kamar_homestay.index')
            ->with('success', 'Kamar homestay berhasil dihapus!');
    }
}
