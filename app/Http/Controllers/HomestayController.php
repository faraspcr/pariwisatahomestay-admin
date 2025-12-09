<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Homestay;
use App\Models\Warga;

class HomestayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // HANYA PAGINATION, TANPA FILTER & SEARCH
        $homestays = Homestay::with('pemilik')
            ->paginate(10)
            ->onEachSide(2);

        return view('pages.homestay.index', compact('homestays'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $wargas = Warga::all();
        return view('pages.homestay.create', compact('wargas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100|min:3',
            'pemilik_warga_id' => 'required|exists:warga,warga_id',
            'alamat' => 'required|string|max:500|min:10',
            'rt' => 'nullable|string|max:5',
            'rw' => 'nullable|string|max:5',
            'fasilitas_json' => 'nullable|string',
            'harga_per_malam' => 'required|numeric|min:0',
            'status' => 'required|in:aktif,nonaktif,pending'
        ], [
            'nama.required' => 'Nama homestay wajib diisi',
            'nama.min' => 'Nama homestay minimal 3 karakter',
            'pemilik_warga_id.required' => 'Pemilik wajib dipilih',
            'pemilik_warga_id.exists' => 'Pemilik tidak valid',
            'alamat.required' => 'Alamat wajib diisi',
            'alamat.min' => 'Alamat minimal 10 karakter',
            'harga_per_malam.required' => 'Harga per malam wajib diisi',
            'harga_per_malam.min' => 'Harga tidak boleh negatif',
            'status.required' => 'Status wajib dipilih',
            'status.in' => 'Status tidak valid'
        ]);

        Homestay::create($validated);

        return redirect()->route('homestay.index')
            ->with('success', 'Homestay berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $homestay = Homestay::with('pemilik')->findOrFail($id);
        return view('pages.homestay.show', compact('homestay'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $homestay = Homestay::findOrFail($id);
        $wargas = Warga::all();
        return view('pages.homestay.edit', compact('homestay', 'wargas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100|min:3',
            'pemilik_warga_id' => 'required|exists:warga,warga_id',
            'alamat' => 'required|string|max:500|min:10',
            'rt' => 'nullable|string|max:5',
            'rw' => 'nullable|string|max:5',
            'fasilitas_json' => 'nullable|string',
            'harga_per_malam' => 'required|numeric|min:0',
            'status' => 'required|in:aktif,nonaktif,pending'
        ]);

        $homestay = Homestay::findOrFail($id);
        $homestay->update($validated);

        return redirect()->route('homestay.index')
            ->with('success', 'Homestay berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $homestay = Homestay::findOrFail($id);
        $homestay->delete();

        return redirect()->route('homestay.index')
            ->with('success', 'Homestay berhasil dihapus!');
    }
}
