<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookingHomestay;
use App\Models\KamarHomestay;
use App\Models\Warga;

class BookingHomestayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Kolom yang bisa di-filter
        $filterableColumns = ['status', 'metode_bayar', 'tanggal'];

        // Kolom yang bisa di-search
        $searchableColumns = ['warga_nama', 'status', 'metode_bayar'];

        // Query dengan filter DAN search
        $bookings = BookingHomestay::with(['kamar', 'warga', 'kamar.homestay'])
            ->filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->onEachSide(2);

        // Data untuk dropdown filter
        $kamars = KamarHomestay::with('homestay')->get();
        $wargas = Warga::all();

        return view('pages.booking_homestay.index', compact('bookings', 'kamars', 'wargas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kamars = KamarHomestay::with('homestay')->get();
        $wargas = Warga::all();

        return view('pages.booking_homestay.create', compact('kamars', 'wargas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kamar_id' => 'required|exists:kamar_homestay,kamar_id',
            'warga_id' => 'required|exists:warga,warga_id',
            'checkin' => 'required|date|after_or_equal:today',
            'checkout' => 'required|date|after:checkin',
            'total' => 'required|numeric|min:0',
            'status' => 'required|in:pending,confirmed,paid,cancelled,completed',
            'metode_bayar' => 'nullable|in:cash,transfer,qris,other'
        ], [
            'kamar_id.required' => 'Kamar wajib dipilih',
            'warga_id.required' => 'Warga wajib dipilih',
            'checkin.required' => 'Tanggal check-in wajib diisi',
            'checkin.after_or_equal' => 'Tanggal check-in tidak boleh di masa lalu',
            'checkout.required' => 'Tanggal check-out wajib diisi',
            'checkout.after' => 'Tanggal check-out harus setelah check-in',
            'total.required' => 'Total harga wajib diisi',
            'total.min' => 'Total harga tidak boleh negatif',
            'status.required' => 'Status wajib dipilih',
            'status.in' => 'Status tidak valid'
        ]);

        // Cek ketersediaan kamar
        $isAvailable = $this->cekKetersediaanKamar($request->kamar_id, $request->checkin, $request->checkout);

        if (!$isAvailable) {
            return back()->withErrors(['kamar_id' => 'Kamar tidak tersedia pada tanggal yang dipilih'])->withInput();
        }

        BookingHomestay::create($validated);

        return redirect()->route('booking-homestay.index')
            ->with('success', 'Booking berhasil dibuat!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $booking = BookingHomestay::with(['kamar', 'warga'])->findOrFail($id);
        $kamars = KamarHomestay::with('homestay')->get();
        $wargas = Warga::all();

        return view('pages.booking_homestay.edit', compact('booking', 'kamars', 'wargas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'kamar_id' => 'required|exists:kamar_homestay,kamar_id',
            'warga_id' => 'required|exists:warga,warga_id',
            'checkin' => 'required|date',
            'checkout' => 'required|date|after:checkin',
            'total' => 'required|numeric|min:0',
            'status' => 'required|in:pending,confirmed,paid,cancelled,completed',
            'metode_bayar' => 'nullable|in:cash,transfer,qris,other'
        ]);

        $booking = BookingHomestay::findOrFail($id);

        // Cek ketersediaan kamar (kecuali untuk booking ini sendiri)
        $isAvailable = $this->cekKetersediaanKamar($request->kamar_id, $request->checkin, $request->checkout, $id);

        if (!$isAvailable) {
            return back()->withErrors(['kamar_id' => 'Kamar tidak tersedia pada tanggal yang dipilih'])->withInput();
        }

        $booking->update($validated);

        return redirect()->route('booking-homestay.index')
            ->with('success', 'Booking berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $booking = BookingHomestay::findOrFail($id);
        $booking->delete();

        return redirect()->route('booking-homestay.index')
            ->with('success', 'Booking berhasil dihapus!');
    }

    /**
     * Cek ketersediaan kamar
     */
    private function cekKetersediaanKamar($kamarId, $checkin, $checkout, $bookingId = null)
    {
        $query = BookingHomestay::where('kamar_id', $kamarId)
            ->where('status', '!=', 'cancelled')
            ->where(function($q) use ($checkin, $checkout) {
                $q->whereBetween('checkin', [$checkin, $checkout])
                  ->orWhereBetween('checkout', [$checkin, $checkout])
                  ->orWhere(function($q2) use ($checkin, $checkout) {
                      $q2->where('checkin', '<=', $checkin)
                         ->where('checkout', '>=', $checkout);
                  });
            });

        if ($bookingId) {
            $query->where('booking_id', '!=', $bookingId);
        }

        return $query->count() === 0;
    }
}
