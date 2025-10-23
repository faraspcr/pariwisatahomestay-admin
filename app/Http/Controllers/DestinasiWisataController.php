<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DestinasiWisata;

class DestinasiWisataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $destinasiWisata = DestinasiWisata::paginate(10); // 10 data per halaman
         return view('admin.destinasiwisata.index', ['destinasiWisata' => $destinasiWisata]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.destinasiwisata.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'alamat' => 'required|string|max:500',
            'rt' => 'required|string|max:3',
            'rw' => 'required|string|max:3',
            'jam_buka' => 'required|date_format:H:i',
            'tiket' => 'required|numeric|min:0',
            'kontak' => 'required|string|max:20'
        ], [
            'nama.required' => 'Nama destinasi wajib diisi',
            'deskripsi.required' => 'Deskripsi wajib diisi',
            'alamat.required' => 'Alamat wajib diisi',
            'rt.required' => 'RT wajib diisi',
            'rw.required' => 'RW wajib diisi',
            'jam_buka.required' => 'Jam buka wajib diisi',
            'tiket.required' => 'Harga tiket wajib diisi',
            'kontak.required' => 'Kontak wajib diisi'
        ]);

        DestinasiWisata::create($validated);

        return redirect()->route('destinasiwisata.index')
            ->with('success', 'Data destinasi wisata berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(DestinasiWisata $destinasiWisata)
    {
        return view('admin.destinasiwisata.show', compact('destinasiWisata'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
{
    $destinasi = DestinasiWisata::findOrFail($id);
    return view('admin.destinasiwisata.edit', compact('destinasi'));
}
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    $validated = $request->validate([
        'nama_destinasi' => 'required|string|max:255',
        'lokasi' => 'required|string|max:255',
        'deskripsi' => 'required|string',
        'kategori' => 'required|string|max:255',
        'harga_tiket' => 'required|numeric|min:0',
        'jam_operasional' => 'required|string|max:255',
        'fasilitas' => 'nullable|string',
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
    ], [
        'nama_destinasi.required' => 'Nama destinasi wajib diisi',
        'lokasi.required' => 'Lokasi wajib diisi',
        'deskripsi.required' => 'Deskripsi wajib diisi',
        'kategori.required' => 'Kategori wajib dipilih',
        'harga_tiket.required' => 'Harga tiket wajib diisi',
        'harga_tiket.numeric' => 'Harga tiket harus berupa angka',
        'harga_tiket.min' => 'Harga tiket tidak boleh negatif',
        'jam_operasional.required' => 'Jam operasional wajib diisi',
        'gambar.image' => 'File harus berupa gambar',
        'gambar.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif',
        'gambar.max' => 'Ukuran gambar maksimal 2MB'
    ]);

    $destinasi = DestinasiWisata::findOrFail($id);

    // Handle upload gambar jika ada
    if ($request->hasFile('gambar')) {
        // Hapus gambar lama jika ada
        if ($destinasi->gambar && Storage::exists($destinasi->gambar)) {
            Storage::delete($destinasi->gambar);
        }

        // Simpan gambar baru
        $gambarPath = $request->file('gambar')->store('destinasi-wisata', 'public');
        $validated['gambar'] = $gambarPath;
    }

    $destinasi->update($validated);

    return redirect()->route('destinasivisata.index')->with('success', 'Data destinasi wisata berhasil diperbarui');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $destinasi = DestinasiWisata::findOrFail($id);
        $destinasi->delete();

        return redirect()->route('destinasiwisata.index')
            ->with('success', 'Data destinasi wisata berhasil dihapus!');
    }
}
