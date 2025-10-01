<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PariwisataDestinasiAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $destinasi = [
            [
                'destinasi_id' => 1,
                'nama' => 'Pantai Indah',
                'deskripsi' => 'Pantai dengan pemandangan sunset yang menakjubkan dan pasir putih yang bersih',
                'alamat' => 'Jl. Pantai Indah No. 1',
                'rt' => '01',
                'rw' => '02',
                'jam_buka' => '06:00 - 18:00',
                'tiket' => 15000,
                'kontak' => '081234567890'
            ],
            [
                'destinasi_id' => 2,
                'nama' => 'Air Terjun Segar',
                'deskripsi' => 'Air terjun dengan air yang jernih dan sejuk, cocok untuk refreshing',
                'alamat' => 'Jl. Air Terjun No. 5',
                'rt' => '03',
                'rw' => '01',
                'jam_buka' => '07:00 - 17:00',
                'tiket' => 20000,
                'kontak' => '081234567891'
            ],
            [
                'destinasi_id' => 3,
                'nama' => 'Bukit Asri',
                'deskripsi' => 'Bukit dengan pemandangan desa yang luas dan udara segar',
                'alamat' => 'Jl. Bukit Asri No. 10',
                'rt' => '02',
                'rw' => '04',
                'jam_buka' => '05:00 - 19:00',
                'tiket' => 10000,
                'kontak' => '081234567892'
            ],
        ];

    return view('pariwisatadestinasi_admin', compact('destinasi'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
