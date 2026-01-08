<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KamarHomestay;
use App\Models\Homestay;
use App\Models\Media;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class KamarHomestayController extends Controller
{
    /**
     * ADMIN: Lihat semua kamar
     * PEMILIK: Lihat kamar di homestay miliknya
     * WARGA: Hanya lihat kamar (view only)
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        // Kolom yang bisa di-filter
        $filterableColumns = ['homestay_id', 'kapasitas'];
        $searchableColumns = ['nama_kamar', 'fasilitas_json'];

        // Query dasar
        $query = KamarHomestay::with('homestay');

        // ✅ FILTER BERDASARKAN ROLE
        if ($user->isPemilik()) {
            // PEMILIK: Hanya kamar di homestay miliknya
            $query->whereHas('homestay', function($q) use ($user) {
                $q->where('pemilik_warga_id', $user->warga_id);
            });
        } elseif ($user->isWarga()) {
            // WARGA: Hanya lihat kamar di homestay aktif
            $query->whereHas('homestay', function($q) {
                $q->where('status', 'aktif');
            });
        }
        // ADMIN: Lihat semua

        // Terapkan filter dan search
        $kamarHomestay = $query->filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->paginate(10)
            ->onEachSide(2);

        // Ambil data homestay untuk dropdown filter
        $homestays = $user->isAdmin() ? Homestay::all() : Homestay::where('status', 'aktif')->get();

        return view('pages.kamar_homestay.index', compact('kamarHomestay', 'homestays'));
    }

    /**
     * ADMIN: Buat kamar untuk homestay mana saja
     * PEMILIK: Hanya buat kamar untuk homestay miliknya
     * WARGA: Tidak bisa create kamar
     */
    public function create()
    {
        $user = Auth::user();

        if ($user->isAdmin()) {
            // ADMIN: Pilih semua homestay
            $homestays = Homestay::all();
        } elseif ($user->isPemilik()) {
            // PEMILIK: Hanya homestay miliknya
            $homestays = Homestay::where('pemilik_warga_id', $user->warga_id)->get();
        } else {
            // WARGA: Tidak boleh create kamar
            abort(403, 'Anda tidak memiliki akses untuk membuat kamar homestay.');
        }

        return view('pages.kamar_homestay.create', compact('homestays'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        // ✅ VALIDASI BERDASARKAN ROLE
        $validationRules = [
            'nama_kamar' => 'required|string|max:100|min:3',
            'kapasitas' => 'required|integer|min:1|max:20',
            'fasilitas_json' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
            'foto_kamar.*' => 'nullable|file|mimes:jpg,jpeg,png,gif,webp,bmp,pdf,doc,docx|max:10240',
        ];

        if ($user->isAdmin()) {
            // ADMIN: Bisa pilih homestay mana saja
            $validationRules['homestay_id'] = 'required|exists:homestay,homestay_id';
        } elseif ($user->isPemilik()) {
            // PEMILIK: Hanya homestay miliknya
            $homestayIds = Homestay::where('pemilik_warga_id', $user->warga_id)
                ->pluck('homestay_id')
                ->toArray();

            $validationRules['homestay_id'] = 'required|in:' . implode(',', $homestayIds);
        } else {
            // WARGA: Tidak boleh create kamar
            abort(403, 'Anda tidak memiliki akses untuk membuat kamar homestay.');
        }

        $validated = $request->validate($validationRules, [
            'homestay_id.required' => 'Homestay wajib dipilih',
            'homestay_id.exists' => 'Homestay tidak valid',
            'nama_kamar.required' => 'Nama kamar wajib diisi',
            'nama_kamar.min' => 'Nama kamar minimal 3 karakter',
            'kapasitas.required' => 'Kapasitas wajib diisi',
            'kapasitas.min' => 'Kapasitas minimal 1 orang',
            'kapasitas.max' => 'Kapasitas maksimal 20 orang',
            'harga.required' => 'Harga wajib diisi',
            'harga.min' => 'Harga tidak boleh negatif'
        ]);

        // Validasi JSON jika diisi
        if ($request->filled('fasilitas_json')) {
            json_decode($request->fasilitas_json);
            if (json_last_error() !== JSON_ERROR_NONE) {
                return back()->withErrors(['fasilitas_json' => 'Format JSON tidak valid'])->withInput();
            }
        }

        $kamar = KamarHomestay::create($validated);

        // Upload file jika ada
        if ($request->hasFile('foto_kamar')) {
            foreach ($request->file('foto_kamar') as $key => $file) {
                $originalName = $file->getClientOriginalName();
                $filename = time() . '_' . $originalName;
                $file->storeAs('kamar_homestay', $filename, 'public');

                Media::create([
                    'file_name' => 'kamar_homestay/' . $filename,
                    'ref_table' => 'kamar_homestay',
                    'ref_id' => $kamar->kamar_id,
                    'mime_type' => $file->getMimeType(),
                    'sort_order' => $key + 1,
                    'caption' => null,
                ]);
            }
        }

        // ✅ REDIRECT BERDASARKAN ROLE
        if ($user->isAdmin()) {
            return redirect()->route('admin.kamar.index')
                ->with('success', 'Kamar homestay berhasil ditambahkan!');
        } elseif ($user->isPemilik()) {
            return redirect()->route('pemilik.kamar.index')
                ->with('success', 'Kamar homestay berhasil ditambahkan!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = Auth::user();
        $kamar = KamarHomestay::with('homestay')->findOrFail($id);

        // ✅ AUTHORIZATION CHECK
        if ($user->isPemilik()) {
            // PEMILIK: Hanya bisa lihat kamar di homestay miliknya
            if ($kamar->homestay->pemilik_warga_id != $user->warga_id) {
                abort(403, 'Anda hanya bisa melihat kamar di homestay milik Anda.');
            }
        } elseif ($user->isWarga()) {
            // WARGA: Hanya lihat kamar di homestay aktif
            if ($kamar->homestay->status !== 'aktif') {
                abort(403, 'Kamar tidak tersedia untuk dilihat.');
            }
        }

        $files = Media::where('ref_table', 'kamar_homestay')
                     ->where('ref_id', $kamar->kamar_id)
                     ->orderBy('sort_order', 'asc')
                     ->get();

        return view('pages.kamar_homestay.show', compact('kamar', 'files'));
    }

    /**
     * Edit kamar
     */
    public function edit($id)
    {
        $user = Auth::user();
        $kamar = KamarHomestay::with('homestay')->findOrFail($id);

        // ✅ AUTHORIZATION CHECK
        if ($user->isPemilik()) {
            // PEMILIK: Hanya bisa edit kamar di homestay miliknya
            if ($kamar->homestay->pemilik_warga_id != $user->warga_id) {
                abort(403, 'Anda hanya bisa mengedit kamar di homestay milik Anda.');
            }
        } elseif ($user->isWarga()) {
            // WARGA: Tidak boleh edit kamar
            abort(403, 'Anda tidak memiliki akses untuk mengedit kamar homestay.');
        }

        if ($user->isAdmin()) {
            $homestays = Homestay::all();
        } elseif ($user->isPemilik()) {
            $homestays = Homestay::where('pemilik_warga_id', $user->warga_id)->get();
        }

        return view('pages.kamar_homestay.edit', compact('kamar', 'homestays'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $kamar = KamarHomestay::with('homestay')->findOrFail($id);

        // ✅ AUTHORIZATION CHECK
        if ($user->isPemilik()) {
            if ($kamar->homestay->pemilik_warga_id != $user->warga_id) {
                abort(403, 'Anda hanya bisa mengupdate kamar di homestay milik Anda.');
            }
        } elseif ($user->isWarga()) {
            abort(403, 'Anda tidak memiliki akses untuk mengupdate kamar homestay.');
        }

        // Validasi berdasarkan role
        $validationRules = [
            'nama_kamar' => 'required|string|max:100|min:3',
            'kapasitas' => 'required|integer|min:1|max:20',
            'fasilitas_json' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
            'foto_kamar.*' => 'nullable|file|mimes:jpg,jpeg,png,gif,webp,bmp,pdf,doc,docx|max:10240',
        ];

        if ($user->isAdmin()) {
            return redirect()->route('admin.kamarhomestay.show', $kamar->kamar_id)
            ->with('success', 'Kamar berhasil diperbarui!');
    } else {
        // Untuk pemilik
        return redirect()->route('pemilik.kamar.show', $kamar->kamar_id)
            ->with('success', 'Kamar berhasil diperbarui!');
    }

        $validated = $request->validate($validationRules);

        // Validasi JSON jika diisi
        if ($request->filled('fasilitas_json')) {
            json_decode($request->fasilitas_json);
            if (json_last_error() !== JSON_ERROR_NONE) {
                return back()->withErrors(['fasilitas_json' => 'Format JSON tidak valid'])->withInput();
            }
        }

        $kamar->update($validated);

        // Upload file tambahan jika ada
        if ($request->hasFile('foto_kamar')) {
            $currentMaxOrder = Media::where('ref_table', 'kamar_homestay')
                                  ->where('ref_id', $kamar->kamar_id)
                                  ->max('sort_order') ?? 0;

            foreach ($request->file('foto_kamar') as $key => $file) {
                $originalName = $file->getClientOriginalName();
                $filename = time() . '_' . $originalName;
                $file->storeAs('kamar_homestay', $filename, 'public');

                Media::create([
                    'file_name' => 'kamar_homestay/' . $filename,
                    'ref_table' => 'kamar_homestay',
                    'ref_id' => $kamar->kamar_id,
                    'mime_type' => $file->getMimeType(),
                    'sort_order' => $currentMaxOrder + $key + 1,
                    'caption' => null,
                ]);
            }
        }

        // ✅ REDIRECT BERDASARKAN ROLE
        if ($user->isAdmin()) {
            return redirect()->route('admin.kamar.show', $kamar->kamar_id)
                ->with('success', 'Kamar homestay berhasil diperbarui!');
        } elseif ($user->isPemilik()) {
            return redirect()->route('pemilik.kamar.show', $kamar->kamar_id)
                ->with('success', 'Kamar homestay berhasil diperbarui!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = Auth::user();
        $kamar = KamarHomestay::with('homestay')->findOrFail($id);

        // ✅ AUTHORIZATION CHECK
        if ($user->isPemilik()) {
            if ($kamar->homestay->pemilik_warga_id != $user->warga_id) {
                abort(403, 'Anda hanya bisa menghapus kamar di homestay milik Anda.');
            }
        } elseif ($user->isWarga()) {
            abort(403, 'Anda tidak memiliki akses untuk menghapus kamar homestay.');
        }

        // Hapus semua file terkait
        $files = Media::where('ref_table', 'kamar_homestay')
                     ->where('ref_id', $kamar->kamar_id)
                     ->get();

        foreach ($files as $file) {
            Storage::disk('public')->delete($file->file_name);
            $file->delete();
        }

        $kamar->delete();

        // ✅ REDIRECT BERDASARKAN ROLE
        if ($user->isAdmin()) {
            return redirect()->route('admin.kamar.index')
                ->with('success', 'Kamar homestay berhasil dihapus!');
        } elseif ($user->isPemilik()) {
            return redirect()->route('pemilik.kamar.index')
                ->with('success', 'Kamar homestay berhasil dihapus!');
        }
    }

    /**
     * ====================================================
     * METHOD KHUSUS UNTUK PEMILIK (KAMAR DI HOMESTAY SAYA)
     * ====================================================
     */

    /**
     * PEMILIK: Hanya lihat kamar di homestay miliknya
     */
    public function myHomestayKamar(Request $request)
    {
        $user = Auth::user();

        if (!$user->isPemilik()) {
            abort(403, 'Hanya pemilik homestay yang bisa mengakses halaman ini.');
        }

        $filterableColumns = ['homestay_id', 'kapasitas'];
        $searchableColumns = ['nama_kamar', 'fasilitas_json'];

        $kamarHomestay = KamarHomestay::with('homestay')
            ->whereHas('homestay', function($q) use ($user) {
                $q->where('pemilik_warga_id', $user->warga_id);
            })
            ->filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->paginate(10)
            ->onEachSide(2);

    //     $homestays = Homestay::where('pemilik_warga_id', $user->warga_id)->get();

    //     return view('pages.kamar_homestay.my-homestay', compact('kamarHomestay', 'homestays'));
    // }

     $homestays = Homestay::where('pemilik_warga_id', $user->warga_id)->get();
      return view('pages.kamar_homestay.index', compact('kamarHomestay', 'homestays'))->with('isPemilikView', true);
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
        $filterableColumns = ['kapasitas'];
        $searchableColumns = ['nama_kamar'];

        $kamarHomestay = KamarHomestay::with('homestay')
            ->whereHas('homestay', function($q) {
                $q->where('status', 'aktif');
            })
            ->filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->paginate(12)
            ->onEachSide(2);

        $homestays = Homestay::where('status', 'aktif')->get();

        return view('pages.kamar_homestay.public-index', compact('kamarHomestay', 'homestays'));
    }

    /**
     * Public show - untuk semua role (view only)
     */
    public function publicShow($id)
    {
        $kamar = KamarHomestay::with('homestay')
            ->whereHas('homestay', function($q) {
                $q->where('status', 'aktif');
            })
            ->findOrFail($id);

        $files = Media::where('ref_table', 'kamar_homestay')
                     ->where('ref_id', $kamar->kamar_id)
                     ->orderBy('sort_order', 'asc')
                     ->get();

        return view('pages.kamar_homestay.public-show', compact('kamar', 'files'));
    }

    /**
     * ====================================================
     * FILE UPLOAD METHODS (DENGAN AUTHORIZATION)
     * ====================================================
     */

    public function uploadFiles(Request $request, string $id)
    {
        $user = Auth::user();
        $kamar = KamarHomestay::with('homestay')->findOrFail($id);

        // ✅ AUTHORIZATION CHECK
        if ($user->isPemilik()) {
            if ($kamar->homestay->pemilik_warga_id != $user->warga_id) {
                abort(403, 'Anda hanya bisa upload file untuk kamar di homestay milik Anda.');
            }
        } elseif ($user->isWarga()) {
            abort(403, 'Anda tidak memiliki akses untuk upload file kamar homestay.');
        }

        $request->validate([
            'foto_kamar.*' => 'required|file|mimes:jpg,jpeg,png,gif,webp,bmp,pdf,doc,docx|max:10240',
        ]);

        $currentMaxOrder = Media::where('ref_table', 'kamar_homestay')
                              ->where('ref_id', $kamar->kamar_id)
                              ->max('sort_order') ?? 0;

        if ($request->hasFile('foto_kamar')) {
            foreach ($request->file('foto_kamar') as $key => $file) {
                $originalName = $file->getClientOriginalName();
                $filename = time() . '_' . $originalName;
                $file->storeAs('kamar_homestay', $filename, 'public');

                Media::create([
                    'file_name' => 'kamar_homestay/' . $filename,
                    'ref_table' => 'kamar_homestay',
                    'ref_id' => $kamar->kamar_id,
                    'mime_type' => $file->getMimeType(),
                    'sort_order' => $currentMaxOrder + $key + 1,
                    'caption' => null,
                ]);
            }
        }

        $fileCount = $request->hasFile('foto_kamar') ? count($request->file('foto_kamar')) : 0;
        return back()->with('success', "{$fileCount} file berhasil diupload!");
    }

    /**
     * Delete specific file for kamar homestay
     */
    public function deleteFile(string $id, string $fileId)
    {
        $user = Auth::user();
        $kamar = KamarHomestay::with('homestay')->findOrFail($id);

        // ✅ AUTHORIZATION CHECK
        if ($user->isPemilik()) {
            if ($kamar->homestay->pemilik_warga_id != $user->warga_id) {
                abort(403, 'Anda hanya bisa menghapus file dari kamar di homestay milik Anda.');
            }
        } elseif ($user->isWarga()) {
            abort(403, 'Anda tidak memiliki akses untuk menghapus file kamar homestay.');
        }

        $file = Media::where('media_id', $fileId)
            ->where('ref_table', 'kamar_homestay')
            ->where('ref_id', $kamar->kamar_id)
            ->firstOrFail();

        $fileName = basename($file->file_name);
        Storage::disk('public')->delete($file->file_name);
        $file->delete();

        return back()->with('success', "File '{$fileName}' berhasil dihapus!");
    }

    /**
     * Download file
     */
    public function downloadFile(string $id, string $fileId)
    {
        $user = Auth::user();
        $kamar = KamarHomestay::with('homestay')->findOrFail($id);

        // Authorization check
        if ($user->isPemilik() && $kamar->homestay->pemilik_warga_id != $user->warga_id) {
            abort(403, 'Anda tidak memiliki akses ke file ini.');
        } elseif ($user->isWarga() && $kamar->homestay->status !== 'aktif') {
            abort(403, 'Kamar tidak tersedia.');
        }

        $file = Media::where('media_id', $fileId)
            ->where('ref_table', 'kamar_homestay')
            ->where('ref_id', $kamar->kamar_id)
            ->firstOrFail();

        if (!Storage::disk('public')->exists($file->file_name)) {
            abort(404, 'File tidak ditemukan');
        }

        $filename = basename($file->file_name);
        $originalName = substr($filename, strpos($filename, '_') + 1);

        return Storage::disk('public')->download($file->file_name, $originalName);
    }

    /**
     * Show file in browser (preview gambar & PDF)
     */
    public function showFile(string $id, string $fileId)
    {
        $user = Auth::user();
        $kamar = KamarHomestay::with('homestay')->findOrFail($id);

        // Authorization check
        if ($user->isPemilik() && $kamar->homestay->pemilik_warga_id != $user->warga_id) {
            abort(403, 'Anda tidak memiliki akses ke file ini.');
        } elseif ($user->isWarga() && $kamar->homestay->status !== 'aktif') {
            abort(403, 'Kamar tidak tersedia.');
        }

        $file = Media::where('media_id', $fileId)
            ->where('ref_table', 'kamar_homestay')
            ->where('ref_id', $kamar->kamar_id)
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

    /**
     * Rename file
     */
    public function renameFile(Request $request, string $id, string $fileId)
    {
        $user = Auth::user();
        $kamar = KamarHomestay::with('homestay')->findOrFail($id);

        // ✅ AUTHORIZATION CHECK
        if ($user->isPemilik() && $kamar->homestay->pemilik_warga_id != $user->warga_id) {
            abort(403, 'Anda tidak memiliki akses untuk mengubah nama file ini.');
        } elseif ($user->isWarga()) {
            abort(403, 'Anda tidak memiliki akses untuk mengubah nama file ini.');
        }

        $request->validate([
            'new_filename' => 'required|string|max:255'
        ]);

        $file = Media::where('media_id', $fileId)
            ->where('ref_table', 'kamar_homestay')
            ->where('ref_id', $kamar->kamar_id)
            ->firstOrFail();

        $oldFileName = $file->file_name;
        $newFilename = $request->new_filename;

        // Dapatkan ekstensi file lama
        $extension = pathinfo($oldFileName, PATHINFO_EXTENSION);

        // Buat nama file baru dengan ekstensi
        $newFileName = pathinfo($oldFileName, PATHINFO_DIRNAME) . '/' . $newFilename . '.' . $extension;

        // Rename file di storage
        if (Storage::disk('public')->exists($oldFileName)) {
            Storage::disk('public')->move($oldFileName, $newFileName);

            // Update di database
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
}
