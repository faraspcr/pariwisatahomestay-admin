<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Warga;
use App\Models\DestinasiWisata;
use App\Models\User;
use App\Models\Homestay;
use App\Models\KamarHomestay;
use App\Models\BookingHomestay;
use App\Models\UlasanWisata;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // ========== Cek apakah user sudah login ==========
        if (!Auth::check()) {
            return redirect()->route('auth.login')->with('error', 'Silakan login terlebih dahulu!');
        }

        // ========== Ambil data user yang login ==========
        $user = Auth::user();
        $lastLogin = session('last_login');

        // ========== Data statistik yang sudah ada
        $totalWarga = Warga::count();
        $totalDestinasi = DestinasiWisata::count();
        $totalUser = User::count();
        $totalAktivitas = 25;

        // ========== Data untuk fitur baru ==========
        $totalHomestay = Homestay::count();
        $totalKamar = KamarHomestay::count();
        $totalBooking = BookingHomestay::count();
        $totalUlasan = UlasanWisata::count();

        // ========== Data untuk WhatsApp button
        $whatsappData = [
            'phone_number' => '6281234567890',
            'default_message' => 'Halo Admin Bina Desa! Saya perlu bantuan terkait sistem Bina Desa. Bisa dibantu?',
            'admin_name' => 'Admin Bina Desa'
        ];

        // ========== Kirim SEMUA data ke view ==========
        return view('pages.dashboard', compact(
            'totalWarga',
            'totalDestinasi',
            'totalUser',
            'whatsappData',
            'user',
            'lastLogin',
            'totalAktivitas',
            'totalHomestay',
            'totalKamar',
            'totalBooking',
            'totalUlasan'
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
