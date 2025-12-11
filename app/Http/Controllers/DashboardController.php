<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // TAMBAHKAN INI
use App\Models\Warga;
use App\Models\DestinasiWisata;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // ========== TAMBAHKAN INI: Cek apakah user sudah login ==========
        if (!Auth::check()) {
            return redirect()->route('auth.login')->with('error', 'Silakan login terlebih dahulu!');
        }

        // ========== TAMBAHKAN INI: Ambil data user yang login ==========
        $user = Auth::user();
        $lastLogin = session('last_login');

        // Data statistik yang sudah ada
        $totalWarga = Warga::count();
        $totalDestinasi = DestinasiWisata::count();
        $totalUser = User::count();
        $totalAktivitas = 25; // TAMBAHKAN: Contoh data aktivitas

        // Data untuk WhatsApp button
        $whatsappData = [
            'phone_number' => '6281234567890', // Ganti dengan nomor admin
            'default_message' => 'Halo Admin Bina Desa! Saya perlu bantuan terkait sistem Bina Desa. Bisa dibantu?',
            'admin_name' => 'Admin Bina Desa'
        ];

        // ========== TAMBAHKAN INI: Kirim semua data ke view ==========
        return view('pages.dashboard', compact(
            'totalWarga',
            'totalDestinasi',
            'totalUser',
            'whatsappData',
            'user',          // TAMBAHKAN: data user
            'lastLogin',     // TAMBAHKAN: last login dari session
            'totalAktivitas' // TAMBAHKAN: total aktivitas
        ));
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
