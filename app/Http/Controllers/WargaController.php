<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Warga;

class WargaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $warga = Warga::all(); // menggunakan pagination
        return view('admin.warga.index', compact('warga'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.warga.create');
    }

    /**
     * Store a newly created resource in storage.
     */
 public function store(Request $request)
{
    $validated = $request->validate([
        'no_ktp' => 'required|string|unique:warga|max:16',
        'nama' => 'required|string|max:255',
        'jenis_kelamin' => 'required|in:L,P',
        'agama' => 'required|string|max:255',
        'pekerjaan' => 'required|string|max:255',
        'telp' => 'required|string|max:15',
        'email' => 'nullable|email|max:255'
    ], [
        // Pesan error dalam bahasa Indonesia
        'no_ktp.required' => 'Nomor KTP wajib diisi',
        'no_ktp.unique' => 'Nomor KTP sudah terdaftar',
        'no_ktp.max' => 'Nomor KTP maksimal 16 digit',
        'nama.required' => 'Nama lengkap wajib diisi',
        'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih',
        'jenis_kelamin.in' => 'Jenis kelamin harus Laki-laki atau Perempuan',
        'agama.required' => 'Agama wajib dipilih',
        'pekerjaan.required' => 'Pekerjaan wajib diisi',
        'telp.required' => 'Nomor telepon wajib diisi',
        'telp.max' => 'Nomor telepon maksimal 15 digit',
        'email.email' => 'Format email tidak valid'
    ]);

   Warga::create($validated);

    return redirect()->route('warga.index')
        ->with('success', 'Data warga berhasil ditambahkan!');
}
    /**
     * Display the specified resource.
     */
    public function show(Warga $warga)
    {
        return view('warga.show', compact('warga'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
{
    $data['dataWarga'] = Warga::findOrFail($id);
    return view('admin.warga.edit', $data);
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    $validated = $request->validate([
        'no_ktp' => 'required|string|max:16|unique:warga,no_ktp,' . $id . ',warga_id',
        'nama' => 'required|string|max:255',
        'jenis_kelamin' => 'required|in:L,P',
        'agama' => 'required|string|max:255',
        'pekerjaan' => 'required|string|max:255',
        'telp' => 'required|string|max:15',
        'email' => 'nullable|email|max:255'
    ], [
        'no_ktp.required' => 'Nomor KTP wajib diisi',
        'no_ktp.unique' => 'Nomor KTP sudah terdaftar',
        'no_ktp.max' => 'Nomor KTP maksimal 16 digit',
        'nama.required' => 'Nama lengkap wajib diisi',
        'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih',
        'jenis_kelamin.in' => 'Jenis kelamin harus Laki-laki atau Perempuan',
        'agama.required' => 'Agama wajib dipilih',
        'pekerjaan.required' => 'Pekerjaan wajib diisi',
        'telp.required' => 'Nomor telepon wajib diisi',
        'telp.max' => 'Nomor telepon maksimal 15 digit',
        'email.email' => 'Format email tidak valid'
    ]);

    $warga = Warga::findOrFail($id);
    $warga->update($validated);

    return redirect()->route('warga.index')->with('success', 'Perubahan Data Berhasil');
}

    /**
     * Remove the specified resource from storage.
     */
   public function destroy(string $id)
{
    $warga = Warga::findOrFail($id);
    $warga->delete();
    return redirect()->route('warga.index')->with('success', 'Data berhasil dihapus');
}
}
