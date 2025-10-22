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
        $warga = Warga::all();
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
    // app/Http/Controllers/WargaController.php
public function store(Request $request)
{
    $validated = $request->validate([
        'nama' => 'required|string|max:255',
        'nik' => 'required|string|unique:wargas|max:16',
        'tempat_lahir' => 'required|string|max:255',
        'tanggal_lahir' => 'required|date',
        'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
        'agama' => 'required|string|max:255',
        'pekerjaan' => 'required|string|max:255',
        'alamat' => 'required|string',
        'no_telepon' => 'required|string|max:15'
    ]);

    Warga::create($validated);

    return redirect()->route('warga.index')
        ->with('success', 'Data warga berhasil ditambahkan!');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
