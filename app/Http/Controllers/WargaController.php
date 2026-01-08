<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Warga;
use Illuminate\Support\Facades\Auth;

class WargaController extends Controller
{
    /**
     * ADMIN: Lihat semua warga
     * PEMILIK: Hanya lihat warga (view only)
     * WARGA: Tidak bisa akses index (hanya lihat data sendiri)
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        // ✅ AUTHORIZATION CHECK
        if ($user->isWarga()) {
            // WARGA: Tidak boleh akses daftar semua warga
            abort(403, 'Anda tidak memiliki akses untuk melihat daftar warga.');
        }

        // Kolom yang bisa di-filter
        $filterableColumns = ['jenis_kelamin'];
        $searchableColumns = ['nama', 'email', 'telp', 'agama'];

        // Query dasar
        $warga = Warga::filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->paginate(10)
            ->onEachSide(2);

        return view('pages.warga.index', compact('warga'));
    }

    /**
     * ADMIN: Buat warga baru
     * PEMILIK: Tidak bisa create warga
     * WARGA: Tidak bisa create warga
     */
    public function create()
    {
        $user = Auth::user();

        // ✅ AUTHORIZATION CHECK
        if (!$user->isAdmin()) {
            abort(403, 'Hanya admin yang bisa menambahkan data warga.');
        }

        return view('pages.warga.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        // ✅ AUTHORIZATION CHECK
        if (!$user->isAdmin()) {
            abort(403, 'Hanya admin yang bisa menambahkan data warga.');
        }

        $validated = $request->validate([
            'no_ktp' => 'required|string|size:16|unique:warga',
            'nama' => 'required|string|max:255|min:3',
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'required|string|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu',
            'pekerjaan' => 'required|string|max:255|min:2',
            'telp' => 'required|string|min:10|max:15',
            'email' => 'nullable|email|max:255'
        ], [
            'no_ktp.required' => 'Nomor KTP wajib diisi',
            'no_ktp.size' => 'Nomor KTP harus 16 digit',
            'no_ktp.unique' => 'Nomor KTP sudah terdaftar',
            'nama.required' => 'Nama lengkap wajib diisi',
            'nama.min' => 'Nama lengkap minimal 3 karakter',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih',
            'jenis_kelamin.in' => 'Jenis kelamin harus Laki-laki atau Perempuan',
            'agama.required' => 'Agama wajib dipilih',
            'agama.in' => 'Agama harus dipilih dari pilihan yang tersedia',
            'pekerjaan.required' => 'Pekerjaan wajib diisi',
            'pekerjaan.min' => 'Pekerjaan minimal 2 karakter',
            'telp.required' => 'Nomor telepon wajib diisi',
            'telp.min' => 'Nomor telepon minimal 10 digit',
            'telp.max' => 'Nomor telepon maksimal 15 digit',
            'email.email' => 'Format email tidak valid'
        ]);

        Warga::create($validated);

        return redirect()->route('admin.warga.index')
            ->with('success', 'Data warga berhasil ditambahkan!');
    }

    /**
     * ADMIN: Lihat detail warga
     * PEMILIK: Hanya lihat detail warga
     * WARGA: Hanya lihat detail dirinya sendiri
     */
    public function show(string $id)
    {
        $user = Auth::user();
        $warga = Warga::findOrFail($id);

        // ✅ AUTHORIZATION CHECK
        if ($user->isWarga()) {
            // WARGA: Hanya bisa lihat data dirinya sendiri
            if ($warga->warga_id != $user->warga_id) {
                abort(403, 'Anda hanya bisa melihat data diri Anda sendiri.');
            }
        }

        return view('pages.warga.show', compact('warga'));
    }

    /**
     * ADMIN: Edit semua warga
     * PEMILIK: Tidak bisa edit warga
     * WARGA: Hanya edit data dirinya sendiri
     */
    public function edit(string $id)
    {
        $user = Auth::user();
        $warga = Warga::findOrFail($id);

        // ✅ AUTHORIZATION CHECK
        if ($user->isPemilik()) {
            // PEMILIK: Tidak boleh edit data warga
            abort(403, 'Anda tidak memiliki akses untuk mengedit data warga.');
        } elseif ($user->isWarga()) {
            // WARGA: Hanya bisa edit data dirinya sendiri
            if ($warga->warga_id != $user->warga_id) {
                abort(403, 'Anda hanya bisa mengedit data diri Anda sendiri.');
            }
        }

        return view('pages.warga.edit', compact('warga'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = Auth::user();
        $warga = Warga::findOrFail($id);

        // ✅ AUTHORIZATION CHECK
        if ($user->isPemilik()) {
            abort(403, 'Anda tidak memiliki akses untuk mengupdate data warga.');
        } elseif ($user->isWarga()) {
            if ($warga->warga_id != $user->warga_id) {
                abort(403, 'Anda hanya bisa mengupdate data diri Anda sendiri.');
            }
        }

        $validated = $request->validate([
            'no_ktp' => 'required|string|size:16|unique:warga,no_ktp,' . $id . ',warga_id',
            'nama' => 'required|string|max:255|min:3',
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'required|string|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu',
            'pekerjaan' => 'required|string|max:255|min:2',
            'telp' => 'required|string|min:10|max:15',
            'email' => 'nullable|email|max:255'
        ], [
            'no_ktp.required' => 'Nomor KTP wajib diisi',
            'no_ktp.size' => 'Nomor KTP harus 16 digit',
            'no_ktp.unique' => 'Nomor KTP sudah terdaftar',
            'nama.required' => 'Nama lengkap wajib diisi',
            'nama.min' => 'Nama lengkap minimal 3 karakter',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih',
            'jenis_kelamin.in' => 'Jenis kelamin harus Laki-laki atau Perempuan',
            'agama.required' => 'Agama wajib dipilih',
            'agama.in' => 'Agama harus dipilih dari pilihan yang tersedia',
            'pekerjaan.required' => 'Pekerjaan wajib diisi',
            'pekerjaan.min' => 'Pekerjaan minimal 2 karakter',
            'telp.required' => 'Nomor telepon wajib diisi',
            'telp.min' => 'Nomor telepon minimal 10 digit',
            'telp.max' => 'Nomor telepon maksimal 15 digit',
            'email.email' => 'Format email tidak valid'
        ]);

        $warga->update($validated);

        // ✅ REDIRECT BERDASARKAN ROLE
        if ($user->isAdmin()) {
            return redirect()->route('admin.warga.index')->with('success', 'Data warga berhasil diperbarui!');
        } elseif ($user->isWarga()) {
            return redirect()->route('warga.data-saya')->with('success', 'Data diri Anda berhasil diperbarui!');
        }
    }

    /**
     * ADMIN: Hapus warga
     * PEMILIK: Tidak bisa hapus warga
     * WARGA: Tidak bisa hapus warga (termasuk dirinya sendiri)
     */
    public function destroy(string $id)
    {
        $user = Auth::user();

        // ✅ AUTHORIZATION CHECK
        if (!$user->isAdmin()) {
            abort(403, 'Hanya admin yang bisa menghapus data warga.');
        }

        $warga = Warga::findOrFail($id);

        // Cek apakah warga memiliki homestay
        if ($warga->homestays()->exists()) {
            return redirect()->route('admin.warga.index')
                ->with('error', 'Tidak dapat menghapus warga yang memiliki homestay.');
        }

        // Cek apakah warga memiliki booking
        if ($warga->bookings()->exists()) {
            return redirect()->route('admin.warga.index')
                ->with('error', 'Tidak dapat menghapus warga yang memiliki booking.');
        }

        $warga->delete();

        return redirect()->route('admin.warga.index')
            ->with('success', 'Data warga berhasil dihapus!');
    }

    /**
     * ====================================================
     * METHOD KHUSUS UNTUK WARGA (DATA SAYA)
     * ====================================================
     */

    /**
     * WARGA: Hanya lihat data dirinya sendiri
     */
    public function myData()
    {
        $user = Auth::user();

        if (!$user->isWarga()) {
            abort(403, 'Hanya warga yang bisa mengakses halaman ini.');
        }

        $warga = Warga::findOrFail($user->warga_id);

        return view('pages.warga.my-data', compact('warga'));
    }

    /**
     * WARGA: Edit data dirinya sendiri
     */
    public function editMyData()
    {
        $user = Auth::user();

        if (!$user->isWarga()) {
            abort(403, 'Hanya warga yang bisa mengakses halaman ini.');
        }

        $warga = Warga::findOrFail($user->warga_id);

        return view('pages.warga.edit-my-data', compact('warga'));
    }

    /**
     * WARGA: Update data dirinya sendiri
     */
    public function updateMyData(Request $request)
    {
        $user = Auth::user();

        if (!$user->isWarga()) {
            abort(403, 'Hanya warga yang bisa mengakses halaman ini.');
        }

        $warga = Warga::findOrFail($user->warga_id);

        $validated = $request->validate([
            'nama' => 'required|string|max:255|min:3',
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'required|string|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu',
            'pekerjaan' => 'required|string|max:255|min:2',
            'telp' => 'required|string|min:10|max:15',
            'email' => 'nullable|email|max:255'
        ], [
            'nama.required' => 'Nama lengkap wajib diisi',
            'nama.min' => 'Nama lengkap minimal 3 karakter',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih',
            'jenis_kelamin.in' => 'Jenis kelamin harus Laki-laki atau Perempuan',
            'agama.required' => 'Agama wajib dipilih',
            'agama.in' => 'Agama harus dipilih dari pilihan yang tersedia',
            'pekerjaan.required' => 'Pekerjaan wajib diisi',
            'pekerjaan.min' => 'Pekerjaan minimal 2 karakter',
            'telp.required' => 'Nomor telepon wajib diisi',
            'telp.min' => 'Nomor telepon minimal 10 digit',
            'telp.max' => 'Nomor telepon maksimal 15 digit',
            'email.email' => 'Format email tidak valid'
        ]);

        // Note: Warga tidak bisa ubah no_ktp
        $validated['no_ktp'] = $warga->no_ktp;

        $warga->update($validated);

        return redirect()->route('warga.data-saya')
            ->with('success', 'Data diri Anda berhasil diperbarui!');
    }
}
