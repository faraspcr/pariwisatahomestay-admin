<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Homestay;
use App\Models\Warga;
use App\Models\Media;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HomestayController extends Controller
{
    /**
     * ADMIN: Lihat semua homestay
     * PEMILIK: Lihat homestay miliknya saja
     * WARGA: Lihat semua homestay (view only)
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        // Kolom yang bisa di-filter
        $filterableColumns = ['status'];

        // Kolom yang bisa di-search
        $searchableColumns = ['nama', 'alamat', 'rt', 'rw'];

        // Query dasar
        $query = Homestay::with('pemilik');

        // ✅ FILTER BERDASARKAN ROLE
        if ($user->isPemilik()) {
            // PEMILIK: Hanya homestay miliknya sendiri
            $query->where('pemilik_warga_id', $user->warga_id);
        } elseif ($user->isWarga()) {
            // WARGA: Bisa lihat semua homestay yang aktif
            $query->where('status', 'aktif');
        }
        // ADMIN: Lihat semua (tidak ada filter tambahan)

        // Terapkan filter dan search
        $homestays = $query->filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->paginate(10)
            ->onEachSide(2);

        return view('pages.homestay.index', compact('homestays'));
    }

    /**
     * ADMIN: Bisa create homestay untuk siapa saja
     * PEMILIK: Hanya bisa create homestay untuk dirinya sendiri
     */
    public function create()
    {
        $user = Auth::user();

        if ($user->isAdmin()) {
            // ADMIN: Pilih semua warga sebagai pemilik
            $wargas = Warga::all();
        } elseif ($user->isPemilik()) {
            // PEMILIK: Hanya bisa pilih dirinya sendiri
            $wargas = Warga::where('warga_id', $user->warga_id)->get();
        } else {
            // WARGA: Tidak boleh akses create
            abort(403, 'Anda tidak memiliki akses untuk membuat homestay.');
        }

        return view('pages.homestay.create', compact('wargas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        // ✅ VALIDASI BERDASARKAN ROLE
        $validationRules = [
            'nama' => 'required|string|max:100|min:3',
            'alamat' => 'required|string|max:500|min:10',
            'rt' => 'nullable|string|max:5',
            'rw' => 'nullable|string|max:5',
            'fasilitas_json' => 'nullable|string',
            'harga_per_malam' => 'required|numeric|min:0',
            'status' => 'required|in:aktif,nonaktif,pending',
            'foto_homestay' => 'nullable|array',
            'foto_homestay.*' => 'file|mimes:jpg,jpeg,png,gif,webp,bmp,pdf,doc,docx|max:10240',
        ];

        if ($user->isAdmin()) {
            // ADMIN: Bisa pilih pemilik siapa saja
            $validationRules['pemilik_warga_id'] = 'required|exists:warga,warga_id';
        } elseif ($user->isPemilik()) {
            // PEMILIK: Otomatis pakai warga_id sendiri
            $request->merge(['pemilik_warga_id' => $user->warga_id]);
        } else {
            // WARGA: Tidak boleh create
            abort(403, 'Anda tidak memiliki akses untuk membuat homestay.');
        }

        $validated = $request->validate($validationRules, [
            'nama.required' => 'Nama homestay wajib diisi',
            'nama.min' => 'Nama homestay minimal 3 karakter',
            'pemilik_warga_id.required' => 'Pemilik wajib dipilih',
            'pemilik_warga_id.exists' => 'Pemilik tidak valid',
            'alamat.required' => 'Alamat wajib diisi',
            'alamat.min' => 'Alamat minimal 10 karakter',
            'harga_per_malam.required' => 'Harga per malam wajib diisi',
            'harga_per_malam.min' => 'Harga tidak boleh negatif',
            'status.required' => 'Status wajib dipilih',
            'status.in' => 'Status tidak valid'
        ]);

        // Simpan data homestay
        $homestay = Homestay::create($validated);

        // Upload file jika ada
        if ($request->hasFile('foto_homestay')) {
            foreach ($request->file('foto_homestay') as $key => $file) {
                // Simpan dengan nama asli + timestamp agar unique
                $originalName = $file->getClientOriginalName();
                $filename = time() . '_' . $originalName;

                // Simpan file ke storage
                $file->storeAs('homestay', $filename, 'public');

                // SIMPAN KE MEDIA
                Media::create([
                    'file_name' => 'homestay/' . $filename,
                    'ref_table' => 'homestay',
                    'ref_id' => $homestay->homestay_id,
                    'mime_type' => $file->getMimeType(),
                    'sort_order' => $key + 1,
                    'caption' => null,
                ]);
            }
        }

        // ✅ REDIRECT BERDASARKAN ROLE
        if ($user->isAdmin()) {
            return redirect()->route('admin.homestay.index')
                ->with('success', 'Homestay berhasil ditambahkan!');
        } elseif ($user->isPemilik()) {
            return redirect()->route('pemilik.homestay.index')
                ->with('success', 'Homestay berhasil ditambahkan!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = Auth::user();
        $homestay = Homestay::with('pemilik')->findOrFail($id);

        // ✅ AUTHORIZATION CHECK
        if ($user->isPemilik() && $homestay->pemilik_warga_id != $user->warga_id) {
            abort(403, 'Anda hanya bisa melihat homestay milik Anda sendiri.');
        }

        $files = Media::where('ref_table', 'homestay')
                     ->where('ref_id', $homestay->homestay_id)
                     ->orderBy('sort_order', 'asc')
                     ->get();

        return view('pages.homestay.show', compact('homestay', 'files'));
    }

    /**
     * Edit homestay
     */
    public function edit($id)
    {
        $user = Auth::user();
        $homestay = Homestay::findOrFail($id);

        // ✅ AUTHORIZATION CHECK
        if ($user->isPemilik() && $homestay->pemilik_warga_id != $user->warga_id) {
            abort(403, 'Anda hanya bisa mengedit homestay milik Anda sendiri.');
        } elseif ($user->isWarga()) {
            abort(403, 'Anda tidak memiliki akses untuk mengedit homestay.');
        }

        if ($user->isAdmin()) {
            $wargas = Warga::all();
        } elseif ($user->isPemilik()) {
            $wargas = Warga::where('warga_id', $user->warga_id)->get();
        }

        $files = Media::where('ref_table', 'homestay')
                     ->where('ref_id', $homestay->homestay_id)
                     ->orderBy('sort_order', 'asc')
                     ->get();

        return view('pages.homestay.edit', compact('homestay', 'wargas', 'files'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $homestay = Homestay::findOrFail($id);

        // ✅ AUTHORIZATION CHECK
        if ($user->isPemilik() && $homestay->pemilik_warga_id != $user->warga_id) {
            abort(403, 'Anda hanya bisa mengupdate homestay milik Anda sendiri.');
        } elseif ($user->isWarga()) {
            abort(403, 'Anda tidak memiliki akses untuk mengupdate homestay.');
        }

        $validationRules = [
            'nama' => 'required|string|max:100|min:3',
            'alamat' => 'required|string|max:500|min:10',
            'rt' => 'nullable|string|max:5',
            'rw' => 'nullable|string|max:5',
            'fasilitas_json' => 'nullable|string',
            'harga_per_malam' => 'required|numeric|min:0',
            'status' => 'required|in:aktif,nonaktif,pending'
        ];

        if ($user->isAdmin()) {
            $validationRules['pemilik_warga_id'] = 'required|exists:warga,warga_id';
        } elseif ($user->isPemilik()) {
            // Pastikan pemilik tidak bisa ganti pemiliknya sendiri
            $request->merge(['pemilik_warga_id' => $user->warga_id]);
        }

        $validated = $request->validate($validationRules);

        $homestay->update($validated);

        // ✅ REDIRECT BERDASARKAN ROLE
        if ($user->isAdmin()) {
            return redirect()->route('admin.homestay.index')
                ->with('success', 'Homestay berhasil diperbarui!');
        } elseif ($user->isPemilik()) {
            return redirect()->route('pemilik.homestay.index')
                ->with('success', 'Homestay berhasil diperbarui!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = Auth::user();
        $homestay = Homestay::findOrFail($id);

        // ✅ AUTHORIZATION CHECK
        if ($user->isPemilik() && $homestay->pemilik_warga_id != $user->warga_id) {
            abort(403, 'Anda hanya bisa menghapus homestay milik Anda sendiri.');
        } elseif ($user->isWarga()) {
            abort(403, 'Anda tidak memiliki akses untuk menghapus homestay.');
        }

        // Hapus semua file terkait
        $files = Media::where('ref_table', 'homestay')
                     ->where('ref_id', $homestay->homestay_id)
                     ->get();

        foreach ($files as $file) {
            Storage::disk('public')->delete($file->file_name);
            $file->delete();
        }

        $homestay->delete();

        // ✅ REDIRECT BERDASARKAN ROLE
        if ($user->isAdmin()) {
            return redirect()->route('admin.homestay.index')
                ->with('success', 'Homestay berhasil dihapus!');
        } elseif ($user->isPemilik()) {
            return redirect()->route('pemilik.homestay.index')
                ->with('success', 'Homestay berhasil dihapus!');
        }
    }

    /**
     * ====================================================
     * METHOD KHUSUS UNTUK PEMILIK (MY HOMESTAY)
     * ====================================================
     */

    /**
     * PEMILIK: Hanya lihat homestay miliknya sendiri
     */
    public function myHomestay(Request $request)
    {
        $user = Auth::user();

        // Pastikan hanya pemilik yang bisa akses
        if (!$user->isPemilik()) {
            abort(403, 'Hanya pemilik homestay yang bisa mengakses halaman ini.');
        }

        $filterableColumns = ['status'];
        $searchableColumns = ['nama', 'alamat', 'rt', 'rw'];


    $homestays = Homestay::with('pemilik')
        ->where('pemilik_warga_id', $user->warga_id)
        ->filter($request, $filterableColumns)
        ->search($request, $searchableColumns)
        ->paginate(10)
        ->onEachSide(2);

    //     return view('pages.homestay.my-homestay', compact('homestays'));
    // }
     return view('pages.homestay.index', compact('homestays'));
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
        // Hanya tampilkan homestay yang aktif
        $filterableColumns = [];
        $searchableColumns = ['nama', 'alamat'];

        $homestays = Homestay::with('pemilik')
            ->where('status', 'aktif')
            ->filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->paginate(12)
            ->onEachSide(2);

        return view('pages.homestay.public-index', compact('homestays'));
    }

    /**
     * Public show - untuk semua role (view only)
     */
    public function publicShow($id)
    {
        $homestay = Homestay::with('pemilik')
            ->where('status', 'aktif')
            ->findOrFail($id);

        $files = Media::where('ref_table', 'homestay')
                     ->where('ref_id', $homestay->homestay_id)
                     ->orderBy('sort_order', 'asc')
                     ->get();

        return view('pages.homestay.public-show', compact('homestay', 'files'));
    }

    /**
     * ====================================================
     * FILE UPLOAD METHODS (DENGAN AUTHORIZATION)
     * ====================================================
     */

    public function uploadFiles(Request $request, string $id)
    {
        $user = Auth::user();
        $homestay = Homestay::findOrFail($id);

        // ✅ AUTHORIZATION: Hanya admin atau pemilik homestay ini
        if ($user->isPemilik() && $homestay->pemilik_warga_id != $user->warga_id) {
            abort(403, 'Anda hanya bisa upload file untuk homestay milik Anda sendiri.');
        } elseif ($user->isWarga()) {
            abort(403, 'Anda tidak memiliki akses untuk upload file homestay.');
        }

        // Validasi dan upload file (sama seperti sebelumnya)
        $request->validate([
            'foto_homestay.*' => 'required|file|mimes:jpg,jpeg,png,gif,webp,bmp,pdf,doc,docx|max:10240',
        ]);

        $currentMaxOrder = Media::where('ref_table', 'homestay')
                              ->where('ref_id', $homestay->homestay_id)
                              ->max('sort_order') ?? 0;

        if ($request->hasFile('foto_homestay')) {
            foreach ($request->file('foto_homestay') as $key => $file) {
                $originalName = $file->getClientOriginalName();
                $filename = time() . '_' . $originalName;
                $file->storeAs('homestay', $filename, 'public');

                Media::create([
                    'file_name' => 'homestay/' . $filename,
                    'ref_table' => 'homestay',
                    'ref_id' => $homestay->homestay_id,
                    'mime_type' => $file->getMimeType(),
                    'sort_order' => $currentMaxOrder + $key + 1,
                    'caption' => null,
                ]);
            }
        }

        $fileCount = $request->hasFile('foto_homestay') ? count($request->file('foto_homestay')) : 0;
        return back()->with('success', "{$fileCount} file berhasil diupload!");
    }

    /**
     * Delete specific file for homestay
     */
    public function deleteFile(string $id, string $fileId)
    {
        $user = Auth::user();
        $homestay = Homestay::findOrFail($id);

        // ✅ AUTHORIZATION: Hanya admin atau pemilik homestay ini
        if ($user->isPemilik() && $homestay->pemilik_warga_id != $user->warga_id) {
            abort(403, 'Anda hanya bisa menghapus file dari homestay milik Anda sendiri.');
        } elseif ($user->isWarga()) {
            abort(403, 'Anda tidak memiliki akses untuk menghapus file homestay.');
        }

        $file = Media::where('media_id', $fileId)
            ->where('ref_table', 'homestay')
            ->where('ref_id', $homestay->homestay_id)
            ->firstOrFail();

        $fileName = $file->file_name;

        Storage::disk('public')->delete($file->file_name);
        $file->delete();

        return back()->with('success', "File '{$fileName}' berhasil dihapus!");
    }

    // Download dan show file (tambahkan authorization check juga)
    public function downloadFile(string $id, string $fileId)
    {
        $homestay = Homestay::findOrFail($id);

        // Untuk download, semua role yang bisa lihat homestay boleh download
        // Tapi cek apakah homestay aktif atau user punya akses
        $user = Auth::user();

        if ($homestay->status !== 'aktif') {
            if ($user->isPemilik() && $homestay->pemilik_warga_id != $user->warga_id) {
                abort(403, 'Anda tidak memiliki akses ke file ini.');
            } elseif ($user->isWarga()) {
                abort(403, 'Homestay tidak aktif.');
            }
        }

        $file = Media::where('media_id', $fileId)
            ->where('ref_table', 'homestay')
            ->where('ref_id', $homestay->homestay_id)
            ->firstOrFail();

        if (!Storage::disk('public')->exists($file->file_name)) {
            abort(404, 'File tidak ditemukan');
        }

        $filename = basename($file->file_name);
        $originalName = substr($filename, strpos($filename, '_') + 1);

        return Storage::disk('public')->download($file->file_name, $originalName);
    }

    public function showFile(string $id, string $fileId)
    {
        $homestay = Homestay::findOrFail($id);

        // Authorization sama seperti download
        $user = Auth::user();

        if ($homestay->status !== 'aktif') {
            if ($user->isPemilik() && $homestay->pemilik_warga_id != $user->warga_id) {
                abort(403, 'Anda tidak memiliki akses ke file ini.');
            } elseif ($user->isWarga()) {
                abort(403, 'Homestay tidak aktif.');
            }
        }

        $file = Media::where('media_id', $fileId)
            ->where('ref_table', 'homestay')
            ->where('ref_id', $homestay->homestay_id)
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
}
