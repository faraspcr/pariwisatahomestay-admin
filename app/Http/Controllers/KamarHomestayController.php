<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KamarHomestay;
use App\Models\Homestay;
use App\Models\Media;
use Illuminate\Support\Facades\Storage;

class KamarHomestayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Kolom yang bisa di-filter
        $filterableColumns = ['homestay_id', 'kapasitas'];

        // Kolom yang bisa di-search
        $searchableColumns = ['nama_kamar', 'fasilitas_json'];

        // Query dengan filter DAN search
        $kamarHomestay = KamarHomestay::with('homestay')
            ->filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->paginate(10)
            ->onEachSide(2);

        // Ambil data homestay untuk dropdown filter
        $homestays = Homestay::all();

        return view('pages.kamar_homestay.index', compact('kamarHomestay', 'homestays'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $homestays = Homestay::all();
        return view('pages.kamar_homestay.create', compact('homestays'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'homestay_id' => 'required|exists:homestay,homestay_id',
            'nama_kamar' => 'required|string|max:100|min:3',
            'kapasitas' => 'required|integer|min:1|max:20',
            'fasilitas_json' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
            'foto_kamar.*' => 'nullable|file|mimes:jpg,jpeg,png,gif,webp,bmp,pdf,doc,docx|max:10240',
        ], [
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
                // Simpan dengan nama asli + timestamp agar unique
                $originalName = $file->getClientOriginalName();
                $filename = time() . '_' . $originalName;

                // Simpan file ke storage
                $file->storeAs('kamar_homestay', $filename, 'public');

                // Simpan ke tabel media
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

        return redirect()->route('kamar_homestay.index')
            ->with('success', 'Kamar homestay berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kamar = KamarHomestay::with('homestay')->findOrFail($id);

        $files = Media::where('ref_table', 'kamar_homestay')
                     ->where('ref_id', $kamar->kamar_id)
                     ->orderBy('sort_order', 'asc')
                     ->get();

        return view('pages.kamar_homestay.show', compact('kamar', 'files'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $kamar = KamarHomestay::findOrFail($id);
        $homestays = Homestay::all();
        return view('pages.kamar_homestay.edit', compact('kamar', 'homestays'));
    }

    /**
     * Update the specified resource in storage.
     */
        /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'homestay_id' => 'required|exists:homestay,homestay_id',
            'nama_kamar' => 'required|string|max:100|min:3',
            'kapasitas' => 'required|integer|min:1|max:20',
            'fasilitas_json' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
            'foto_kamar.*' => 'nullable|file|mimes:jpg,jpeg,png,gif,webp,bmp,pdf,doc,docx|max:10240',
        ]);

        // Validasi JSON jika diisi
        if ($request->filled('fasilitas_json')) {
            json_decode($request->fasilitas_json);
            if (json_last_error() !== JSON_ERROR_NONE) {
                return back()->withErrors(['fasilitas_json' => 'Format JSON tidak valid'])->withInput();
            }
        }

        $kamar = KamarHomestay::findOrFail($id);
        $kamar->update($validated);

        // Upload file tambahan jika ada
        if ($request->hasFile('foto_kamar')) {
            // Ambil urutan terakhir untuk sort_order
            $currentMaxOrder = Media::where('ref_table', 'kamar_homestay')
                                  ->where('ref_id', $kamar->kamar_id)
                                  ->max('sort_order') ?? 0;

            foreach ($request->file('foto_kamar') as $key => $file) {
                // Simpan dengan nama asli + timestamp
                $originalName = $file->getClientOriginalName();
                $filename = time() . '_' . $originalName;

                // Simpan file ke storage
                $file->storeAs('kamar_homestay', $filename, 'public');

                // Simpan ke tabel media
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

        return redirect()->route('kamar_homestay.show', $kamar->kamar_id)
            ->with('success', 'Kamar homestay berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kamar = KamarHomestay::findOrFail($id);

        // Hapus semua file terkait
        $files = Media::where('ref_table', 'kamar_homestay')
                     ->where('ref_id', $kamar->kamar_id)
                     ->get();

        foreach ($files as $file) {
            Storage::disk('public')->delete($file->file_name);
            $file->delete();
        }

        $kamar->delete();

        return redirect()->route('kamar_homestay.index')
            ->with('success', 'Kamar homestay berhasil dihapus!');
    }

    /**
     * Upload multiple files for kamar homestay
     */
    public function uploadFiles(Request $request, string $id)
    {
        $request->validate([
            'foto_kamar.*' => 'required|file|mimes:jpg,jpeg,png,gif,webp,bmp,pdf,doc,docx|max:10240',
        ]);

        $kamar = KamarHomestay::findOrFail($id);

        // Ambil urutan terakhir untuk sort_order
        $currentMaxOrder = Media::where('ref_table', 'kamar_homestay')
                              ->where('ref_id', $kamar->kamar_id)
                              ->max('sort_order') ?? 0;

        if ($request->hasFile('foto_kamar')) {
            foreach ($request->file('foto_kamar') as $key => $file) {
                // Simpan dengan nama asli + timestamp
                $originalName = $file->getClientOriginalName();
                $filename = time() . '_' . $originalName;

                // Simpan file ke storage
                $file->storeAs('kamar_homestay', $filename, 'public');

                // Simpan ke tabel media
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
        $kamar = KamarHomestay::findOrFail($id);

        $file = Media::where('media_id', $fileId)
            ->where('ref_table', 'kamar_homestay')
            ->where('ref_id', $kamar->kamar_id)
            ->firstOrFail();

        $fileName = basename($file->file_name);

        // Hapus file dari storage
        Storage::disk('public')->delete($file->file_name);

        // Hapus record dari database
        $file->delete();

        return back()->with('success', "File '{$fileName}' berhasil dihapus!");
    }

    /**
     * Download file
     */
    public function downloadFile(string $id, string $fileId)
    {
        $kamar = KamarHomestay::findOrFail($id);

        $file = Media::where('media_id', $fileId)
            ->where('ref_table', 'kamar_homestay')
            ->where('ref_id', $kamar->kamar_id)
            ->firstOrFail();

        // Cek apakah file ada
        if (!Storage::disk('public')->exists($file->file_name)) {
            abort(404, 'File tidak ditemukan');
        }

        // Ambil nama asli dari filename (hapus timestamp)
        $filename = basename($file->file_name);
        $originalName = substr($filename, strpos($filename, '_') + 1);

        // Download file
        return Storage::disk('public')->download($file->file_name, $originalName);
    }

    /**
     * Show file in browser (preview gambar & PDF)
     */
    public function showFile(string $id, string $fileId)
    {
        $kamar = KamarHomestay::findOrFail($id);

        $file = Media::where('media_id', $fileId)
            ->where('ref_table', 'kamar_homestay')
            ->where('ref_id', $kamar->kamar_id)
            ->firstOrFail();

        // Cek apakah file ada
        if (!Storage::disk('public')->exists($file->file_name)) {
            abort(404, 'File tidak ditemukan');
        }

        $mime = $file->mime_type;

        // Jika file adalah gambar atau PDF, tampilkan di browser
        if (str_starts_with($mime, 'image/') || $mime === 'application/pdf') {
            return Storage::disk('public')->response($file->file_name);
        }

        // Untuk DOC/DOCX, force download
        $filename = basename($file->file_name);
        $originalName = substr($filename, strpos($filename, '_') + 1);
        return Storage::disk('public')->download($file->file_name, $originalName);
    }

    /**
     * Rename file
     */
    public function renameFile(Request $request, string $id, string $fileId)
    {
        $request->validate([
            'new_filename' => 'required|string|max:255'
        ]);

        $kamar = KamarHomestay::findOrFail($id);

        $file = Media::where('media_id', $fileId)
            ->where('ref_table', 'kamar_homestay')
            ->where('ref_id', $kamar->kamar_id)
            ->firstOrFail();

        $oldFileName = $file->file_name;
        $newFilename = $request->new_filename;

        // Dapatkan ekstensi file lamafr
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
