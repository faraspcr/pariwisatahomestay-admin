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
    $destinasiWisata = DestinasiWisata::orderBy('created_at', 'desc')->get();
    return view('pages.destinasiwisata.index', compact('destinasiWisata'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.destinasiwisata.create'); // PERBAIKAN: 'pages.'
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255|min:3',
            'deskripsi' => 'required|string|min:10',
            'alamat' => 'required|string|max:500|min:10',
            'rt' => 'required|string|size:3',
            'rw' => 'required|string|size:3',
            'jam_buka' => 'required|date_format:H:i',
            'tiket' => 'required|numeric|min:0',
            'kontak' => 'required|string|min:10|max:15'
        ], [
            // Pesan error dalam bahasa Indonesia
            'nama.required' => 'Nama destinasi wajib diisi',
            'nama.min' => 'Nama destinasi minimal 3 karakter',
            'deskripsi.required' => 'Deskripsi wajib diisi',
            'deskripsi.min' => 'Deskripsi minimal 10 karakter',
            'alamat.required' => 'Alamat wajib diisi',
            'alamat.min' => 'Alamat minimal 10 karakter',
            'rt.required' => 'RT wajib diisi',
            'rt.size' => 'RT harus 3 digit',
            'rw.required' => 'RW wajib diisi',
            'rw.size' => 'RW harus 3 digit',
            'jam_buka.required' => 'Jam buka wajib diisi',
            'jam_buka.date_format' => 'Format jam buka tidak valid',
            'tiket.required' => 'Harga tiket wajib diisi',
            'tiket.min' => 'Harga tiket tidak boleh negatif',
            'kontak.required' => 'Kontak wajib diisi',
            'kontak.min' => 'Kontak minimal 10 digit',
            'kontak.max' => 'Kontak maksimal 15 digit'
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
        return view('pages.destinasiwisata.show', compact('destinasiWisata')); // PERBAIKAN: 'pages.'
    }

    /**
     * Show the form for editing the specified resource.
     */
   public function edit(string $id)
    {
        $destinasi = DestinasiWisata::findOrFail($id);
        return view('pages.destinasiwisata.edit', compact('destinasi')); // PERBAIKAN: 'pages.'
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255|min:3',
            'deskripsi' => 'required|string|min:10',
            'alamat' => 'required|string|max:500|min:10',
            'rt' => 'required|string|size:3',
            'rw' => 'required|string|size:3',
            'jam_buka' => 'required|date_format:H:i',
            'tiket' => 'required|numeric|min:0',
            'kontak' => 'required|string|min:10|max:15'
        ], [
            'nama.required' => 'Nama destinasi wajib diisi',
            'nama.min' => 'Nama destinasi minimal 3 karakter',
            'deskripsi.required' => 'Deskripsi wajib diisi',
            'deskripsi.min' => 'Deskripsi minimal 10 karakter',
            'alamat.required' => 'Alamat wajib diisi',
            'alamat.min' => 'Alamat minimal 10 karakter',
            'rt.required' => 'RT wajib diisi',
            'rt.size' => 'RT harus 3 digit',
            'rw.required' => 'RW wajib diisi',
            'rw.size' => 'RW harus 3 digit',
            'jam_buka.required' => 'Jam buka wajib diisi',
            'jam_buka.date_format' => 'Format jam buka tidak valid',
            'tiket.required' => 'Harga tiket wajib diisi',
            'tiket.min' => 'Harga tiket tidak boleh negatif',
            'kontak.required' => 'Kontak wajib diisi',
            'kontak.min' => 'Kontak minimal 10 digit',
            'kontak.max' => 'Kontak maksimal 15 digit'
        ]);

        $destinasi = DestinasiWisata::findOrFail($id);
        $destinasi->update($validated);

        return redirect()->route('destinasiwisata.index')
            ->with('success', 'Data destinasi wisata berhasil diperbarui!');
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
