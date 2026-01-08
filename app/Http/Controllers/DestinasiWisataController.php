<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DestinasiWisata;
use App\Models\Media;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DestinasiWisataController extends Controller
{
    /**
     * ADMIN: Lihat semua destinasi
     * PEMILIK: Hanya lihat destinasi yang tersedia
     * WARGA: Hanya lihat destinasi yang tersedia
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        // Kolom yang bisa di-filter
        $filterableColumns = ['jam_buka'];
        $searchableColumns = ['nama', 'deskripsi', 'alamat', 'kontak', 'tiket'];

        // Query dasar
        $query = DestinasiWisata::query();

        // ✅ PERBAIKAN: Hapus filter berdasarkan status karena kolom tidak ada
        // if ($user->isPemilik() || $user->isWarga()) {
        //     // PEMILIK & WARGA: Hanya lihat destinasi aktif
        //     $query->where('status', 'aktif'); // ❌ DIHAPUS
        // }
        // ADMIN: Lihat semua

        // Terapkan filter dan search
        $destinasiWisata = $query->filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->paginate(10)
            ->onEachSide(2);

        return view('pages.destinasiwisata.index', compact('destinasiWisata'));
    }

    /**
     * HANYA ADMIN: Buat destinasi baru
     */
    public function create()
    {
        $user = Auth::user();

        // ✅ AUTHORIZATION CHECK
        if (!$user->isAdmin()) {
            abort(403, 'Hanya admin yang bisa menambahkan destinasi wisata.');
        }

        return view('pages.destinasiwisata.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        // ✅ AUTHORIZATION CHECK
        if (!$user->isAdmin()) {
            abort(403, 'Hanya admin yang bisa menambahkan destinasi wisata.');
        }

        $validated = $request->validate([
            'nama' => 'required|string|max:255|min:3',
            'deskripsi' => 'required|string|min:10',
            'alamat' => 'required|string|max:500|min:10',
            'rt' => 'required|string|size:3',
            'rw' => 'required|string|size:3',
            'jam_buka' => 'required|date_format:H:i',
            'tiket' => 'required|numeric|min:0',
            'kontak' => 'required|string|min:10|max:15',
            // ✅ PERBAIKAN: Hapus validasi status karena kolom tidak ada
            // 'status' => 'required|in:aktif,nonaktif', // ❌ DIHAPUS
        ], [
            'nama.required' => 'Nama destinasi wajib diisi',
            'nama.min' => 'Nama destinasi minimal 3 karakter',
            'deskripsi.required' => 'Deskripsi wajib diisi',
            'deskripsi.min' => 'Deskripsi minimal 10 karakter',
            'alamat.required' => 'Alamat wajib diisi',
            'alamat.min' => 'Alamat minimal 10 karakter',
            'rt.required' => 'RT wajib diisi',
            'rt.size' => 'RT harus 3 karakter',
            'rw.required' => 'RW wajib diisi',
            'rw.size' => 'RW harus 3 karakter',
            'jam_buka.required' => 'Jam buka wajib diisi',
            'tiket.required' => 'Harga tiket wajib diisi',
            'tiket.min' => 'Harga tiket tidak boleh negatif',
            'kontak.required' => 'Kontak wajib diisi',
            'kontak.min' => 'Kontak minimal 10 digit',
            // 'status.required' => 'Status wajib dipilih', // ❌ DIHAPUS
            // 'status.in' => 'Status tidak valid' // ❌ DIHAPUS
        ]);

        // Simpan data destinasi wisata
        $destinasi = DestinasiWisata::create($validated);

        // Upload file jika ada
        if ($request->hasFile('foto_destinasi')) {
            foreach ($request->file('foto_destinasi') as $key => $file) {
                $originalName = $file->getClientOriginalName();
                $filename = time() . '_' . $originalName;
                $file->storeAs('destinasi_wisata', $filename, 'public');

                Media::create([
                    'file_name' => 'destinasi_wisata/' . $filename,
                    'ref_table' => 'destinasi_wisata',
                    'ref_id' => $destinasi->destinasi_id,
                    'mime_type' => $file->getMimeType(),
                    'sort_order' => $key + 1,
                    'caption' => null,
                ]);
            }
        }

        return redirect()->route('admin.destinasiwisata.index')
            ->with('success', 'Data destinasi wisata berhasil ditambahkan!');
    }

    /**
     * ADMIN: Lihat detail semua destinasi
     * PEMILIK & WARGA: Bisa lihat semua destinasi (tanpa filter status)
     */
    public function show(string $id)
    {
        $user = Auth::user();
        $destinasiWisata = DestinasiWisata::findOrFail($id);

        // ✅ PERBAIKAN: Hapus authorization check berdasarkan status
        // if (($user->isPemilik() || $user->isWarga()) && $destinasiWisata->status !== 'aktif') {
        //     abort(403, 'Destinasi ini tidak aktif atau tidak tersedia.'); // ❌ DIHAPUS
        // }

        $files = Media::where('ref_table', 'destinasi_wisata')
                     ->where('ref_id', $destinasiWisata->destinasi_id)
                     ->orderBy('sort_order', 'asc')
                     ->get();

        return view('pages.destinasiwisata.show', compact('destinasiWisata', 'files'));
    }

    /**
     * HANYA ADMIN: Edit destinasi
     */
    public function edit(string $id)
    {
        $user = Auth::user();

        // ✅ AUTHORIZATION CHECK
        if (!$user->isAdmin()) {
            abort(403, 'Hanya admin yang bisa mengedit destinasi wisata.');
        }

        $destinasi = DestinasiWisata::findOrFail($id);

        $files = Media::where('ref_table', 'destinasi_wisata')
                     ->where('ref_id', $destinasi->destinasi_id)
                     ->orderBy('sort_order', 'asc')
                     ->get();

        return view('pages.destinasiwisata.edit', compact('destinasi', 'files'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = Auth::user();

        // ✅ AUTHORIZATION CHECK
        if (!$user->isAdmin()) {
            abort(403, 'Hanya admin yang bisa mengupdate destinasi wisata.');
        }

        $validated = $request->validate([
            'nama' => 'required|string|max:255|min:3',
            'deskripsi' => 'required|string|min:10',
            'alamat' => 'required|string|max:500|min:10',
            'rt' => 'required|string|size:3',
            'rw' => 'required|string|size:3',
            'jam_buka' => 'required|date_format:H:i',
            'tiket' => 'required|numeric|min:0',
            'kontak' => 'required|string|min:10|max:15',
            // ✅ PERBAIKAN: Hapus validasi status
            // 'status' => 'required|in:aktif,nonaktif', // ❌ DIHAPUS
        ], [
            'nama.required' => 'Nama destinasi wajib diisi',
            'nama.min' => 'Nama destinasi minimal 3 karakter',
            'deskripsi.required' => 'Deskripsi wajib diisi',
            'deskripsi.min' => 'Deskripsi minimal 10 karakter',
            'alamat.required' => 'Alamat wajib diisi',
            'alamat.min' => 'Alamat minimal 10 karakter',
            'rt.required' => 'RT wajib diisi',
            'rt.size' => 'RT harus 3 karakter',
            'rw.required' => 'RW wajib diisi',
            'rw.size' => 'RW harus 3 karakter',
            'jam_buka.required' => 'Jam buka wajib diisi',
            'tiket.required' => 'Harga tiket wajib diisi',
            'tiket.min' => 'Harga tiket tidak boleh negatif',
            'kontak.required' => 'Kontak wajib diisi',
            'kontak.min' => 'Kontak minimal 10 digit',
            // 'status.required' => 'Status wajib dipilih', // ❌ DIHAPUS
            // 'status.in' => 'Status tidak valid' // ❌ DIHAPUS
        ]);

        $destinasi = DestinasiWisata::findOrFail($id);
        $destinasi->update($validated);

        return redirect()->route('admin.destinasiwisata.show', $destinasi->destinasi_id)
            ->with('success', 'Data destinasi wisata berhasil diperbarui!');
    }

    /**
     * HANYA ADMIN: Hapus destinasi
     */
    public function destroy(string $id)
    {
        $user = Auth::user();

        // ✅ AUTHORIZATION CHECK
        if (!$user->isAdmin()) {
            abort(403, 'Hanya admin yang bisa menghapus destinasi wisata.');
        }

        $destinasi = DestinasiWisata::findOrFail($id);

        // Hapus semua file terkait
        $files = Media::where('ref_table', 'destinasi_wisata')
                     ->where('ref_id', $destinasi->destinasi_id)
                     ->get();

        foreach ($files as $file) {
            Storage::disk('public')->delete($file->file_name);
            $file->delete();
        }

        $destinasi->delete();

        return redirect()->route('admin.destinasiwisata.index')
            ->with('success', 'Data destinasi wisata berhasil dihapus!');
    }

    /**
     * ====================================================
     * METHOD UNTUK PUBLIC VIEW (SEMUA ROLE BISA LIHAT)
     * ====================================================
     */

    /**
     * Public index - untuk semua role (view only)
     */
    public function publicIndex(Request $request)
    {
        $filterableColumns = [];
        $searchableColumns = ['nama', 'deskripsi', 'alamat'];

        // ✅ PERBAIKAN: Hapus filter status
        $destinasiWisata = DestinasiWisata::query() // Tanpa where status
            ->filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->paginate(12)
            ->onEachSide(2);

        return view('pages.destinasiwisata.public-index', compact('destinasiWisata'));
    }

    /**
     * Public show - untuk semua role (view only)
     */
    public function publicShow(string $id)
    {
        // ✅ PERBAIKAN: Hapus filter status
        $destinasiWisata = DestinasiWisata::findOrFail($id); // Tanpa where status

        $files = Media::where('ref_table', 'destinasi_wisata')
                     ->where('ref_id', $destinasiWisata->destinasi_id)
                     ->orderBy('sort_order', 'asc')
                     ->get();

        return view('pages.destinasiwisata.public-show', compact('destinasiWisata', 'files'));
    }

    /**
     * ====================================================
     * FILE UPLOAD METHODS (HANYA ADMIN)
     * ====================================================
     */

    public function uploadFiles(Request $request, string $id)
    {
        $user = Auth::user();

        // ✅ AUTHORIZATION CHECK
        if (!$user->isAdmin()) {
            abort(403, 'Hanya admin yang bisa upload file destinasi wisata.');
        }

        $request->validate([
            'foto_destinasi.*' => 'required|file|mimes:jpg,jpeg,png,gif,webp,bmp,pdf,doc,docx|max:10240',
        ]);

        $destinasi = DestinasiWisata::findOrFail($id);

        $currentMaxOrder = Media::where('ref_table', 'destinasi_wisata')
                              ->where('ref_id', $destinasi->destinasi_id)
                              ->max('sort_order') ?? 0;

        if ($request->hasFile('foto_destinasi')) {
            foreach ($request->file('foto_destinasi') as $key => $file) {
                $originalName = $file->getClientOriginalName();
                $filename = time() . '_' . $originalName;
                $file->storeAs('destinasi_wisata', $filename, 'public');

                Media::create([
                    'file_name' => 'destinasi_wisata/' . $filename,
                    'ref_table' => 'destinasi_wisata',
                    'ref_id' => $destinasi->destinasi_id,
                    'mime_type' => $file->getMimeType(),
                    'sort_order' => $currentMaxOrder + $key + 1,
                    'caption' => null,
                ]);
            }
        }

        $fileCount = $request->hasFile('foto_destinasi') ? count($request->file('foto_destinasi')) : 0;
        return back()->with('success', "{$fileCount} file berhasil diupload!");
    }

    public function deleteFile(string $id, string $fileId)
    {
        $user = Auth::user();

        // ✅ AUTHORIZATION CHECK
        if (!$user->isAdmin()) {
            abort(403, 'Hanya admin yang bisa menghapus file destinasi wisata.');
        }

        $destinasi = DestinasiWisata::findOrFail($id);

        $file = Media::where('media_id', $fileId)
            ->where('ref_table', 'destinasi_wisata')
            ->where('ref_id', $destinasi->destinasi_id)
            ->firstOrFail();

        $fileName = $file->file_name;
        Storage::disk('public')->delete($file->file_name);
        $file->delete();

        return back()->with('success', "File '{$fileName}' berhasil dihapus!");
    }

    /**
     * Download file - parameter harus sesuai dengan route
     * Route: /admin/destinasiwisata/{destinasi}/file/{fileId}/download
     */
    public function downloadFile(string $destinasi, string $fileId)
    {
        $user = Auth::user();
        $destinasiModel = DestinasiWisata::findOrFail($destinasi);

        // ✅ PERBAIKAN: Hapus check berdasarkan status
        // Authorization: semua role bisa download
        // if (($user->isPemilik() || $user->isWarga()) && $destinasiModel->status !== 'aktif') {
        //     abort(403, 'Anda tidak memiliki akses ke file ini.'); // ❌ DIHAPUS
        // }

        $file = Media::where('media_id', $fileId)
            ->where('ref_table', 'destinasi_wisata')
            ->where('ref_id', $destinasiModel->destinasi_id)
            ->firstOrFail();

        if (!Storage::disk('public')->exists($file->file_name)) {
            abort(404, 'File tidak ditemukan');
        }

        $filename = basename($file->file_name);
        $originalName = substr($filename, strpos($filename, '_') + 1);

        return Storage::disk('public')->download($file->file_name, $originalName);
    }

    /**
     * Show file - parameter harus sesuai dengan route
     * Route: /admin/destinasiwisata/{destinasi}/file/{fileId}/show
     */
    public function showFile(string $destinasi, string $fileId)
    {
        $user = Auth::user();
        $destinasiModel = DestinasiWisata::findOrFail($destinasi);

        // ✅ PERBAIKAN: Hapus check berdasarkan status
        // Authorization: semua role bisa lihat
        // if (($user->isPemilik() || $user->isWarga()) && $destinasiModel->status !== 'aktif') {
        //     abort(403, 'Anda tidak memiliki akses ke file ini.'); // ❌ DIHAPUS
        // }

        $file = Media::where('media_id', $fileId)
            ->where('ref_table', 'destinasi_wisata')
            ->where('ref_id', $destinasiModel->destinasi_id)
            ->firstOrFail();

        if (!Storage::disk('public')->exists($file->file_name)) {
            abort(404, 'File tidak ditemukan');
        }

        $mime = $file->mime_type;

        if (str_starts_with($mime, 'image/') || $mime === 'application/pdf') {
            return Storage::disk('public')->response($file->file_name);
        }

        $filename = basename($file->file_name);
        $originalName = substr($filename, strpos($filename, '_') + 1);
        return Storage::disk('public')->download($file->file_name, $originalName);
    }

    public function renameFile(Request $request, string $id, string $fileId)
    {
        $user = Auth::user();

        // ✅ AUTHORIZATION CHECK
        if (!$user->isAdmin()) {
            abort(403, 'Hanya admin yang bisa mengubah nama file destinasi wisata.');
        }

        $request->validate([
            'new_filename' => 'required|string|max:255'
        ]);

        $destinasi = DestinasiWisata::findOrFail($id);

        $file = Media::where('media_id', $fileId)
            ->where('ref_table', 'destinasi_wisata')
            ->where('ref_id', $destinasi->destinasi_id)
            ->firstOrFail();

        $oldFileName = $file->file_name;
        $newFilename = $request->new_filename;

        $extension = pathinfo($oldFileName, PATHINFO_EXTENSION);
        $newFileName = pathinfo($oldFileName, PATHINFO_DIRNAME) . '/' . $newFilename . '.' . $extension;

        if (Storage::disk('public')->exists($oldFileName)) {
            Storage::disk('public')->move($oldFileName, $newFileName);

            $file->file_name = $newFileName;
            $file->save();

            return response()->json([
                'success' => true,
                'message' => 'Nama file berhasil diubah!',
                'new_filename' => basename($newFileName)
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'File tidak ditemukan di storage'
        ], 404);
    }

    /**
     * ====================================================
     * METHOD UNTUK PEMILIK (HANYA LIHAT)
     * ====================================================
     */

    /**
     * Untuk role pemilik - lihat semua destinasi (tanpa filter)
     */
    public function pemilikIndex(Request $request)
    {
        $user = Auth::user();

        if (!$user->isPemilik()) {
            abort(403, 'Hanya pemilik yang bisa mengakses halaman ini.');
        }

        $filterableColumns = [];
        $searchableColumns = ['nama', 'deskripsi', 'alamat'];

        // ✅ PERBAIKAN: Hapus filter status
        $destinasiWisata = DestinasiWisata::query() // Tanpa where status
            ->filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->paginate(10)
            ->onEachSide(2);

        return view('pages.destinasiwisata.pemilik-index', compact('destinasiWisata'));
    }

    /**
     * Untuk role warga - lihat semua destinasi (tanpa filter)
     */
    public function wargaIndex(Request $request)
    {
        $user = Auth::user();

        if (!$user->isWarga()) {
            abort(403, 'Hanya warga yang bisa mengakses halaman ini.');
        }

        $filterableColumns = [];
        $searchableColumns = ['nama', 'deskripsi', 'alamat'];

        // ✅ PERBAIKAN: Hapus filter status
        $destinasiWisata = DestinasiWisata::query() // Tanpa where status
            ->filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->paginate(10)
            ->onEachSide(2);

        return view('pages.destinasiwisata.warga-index', compact('destinasiWisata'));
    }
}
