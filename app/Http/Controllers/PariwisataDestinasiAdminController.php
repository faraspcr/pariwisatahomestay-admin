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
        return view('pariwisatadestinasi_admin');
        $destinasi = [
            ['nama' => 'Pantai Indah', 'alamat' => 'RT 01 RW 02', 'tiket' => 15000],
            ['nama' => 'Air Terjun Segar', 'alamat' => 'RT 03 RW 01', 'tiket' => 20000],
            ['nama' => 'Bukit Asri', 'alamat' => 'RT 02 RW 04', 'tiket' => 10000],
        ];

        // ✨ Passing data ke view
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
