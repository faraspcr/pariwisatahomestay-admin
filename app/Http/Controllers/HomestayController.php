<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Homestay;
use App\Models\Warga;
use App\Models\Media;
use Illuminate\Support\Facades\Storage;

class HomestayController extends Controller
{
    public function index(Request $request)
    {
        // Kolom yang bisa di-filter
        $filterableColumns = ['status'];

        // Kolom yang bisa di-search (sesuai dengan kolom di tabel homestay)
        $searchableColumns = ['nama', 'alamat', 'rt', 'rw'];

        // Query dengan filter DAN search PERSIS SEPERTI DI WARGA CONTROLLER
        $homestays = Homestay::with('pemilik')
            ->filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->paginate(10)
            ->onEachSide(2);

        return view('pages.homestay.index', compact('homestays'));
    }

    public function create()
    {
        $wargas = Warga::all();
        return view('pages.homestay.create', compact('wargas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100|min:3',
            'pemilik_warga_id' => 'required|exists:warga,warga_id',
            'alamat' => 'required|string|max:500|min:10',
            'rt' => 'nullable|string|max:5',
            'rw' => 'nullable|string|max:5',
            'fasilitas_json' => 'nullable|string',
            'harga_per_malam' => 'required|numeric|min:0',
            'status' => 'required|in:aktif,nonaktif,pending',
            // FORMAT YANG DIDUKUNG: Gambar + PDF + DOC/DOCX
            'foto_homestay' => 'nullable|array',
            'foto_homestay.*' => 'file|mimes:jpg,jpeg,png,gif,webp,bmp,pdf,doc,docx|max:10240',
        ], [
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

        return redirect()->route('homestay.index')
            ->with('success', 'Homestay berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $homestay = Homestay::with('pemilik')->findOrFail($id);

        $files = Media::where('ref_table', 'homestay')
                     ->where('ref_id', $homestay->homestay_id)
                     ->orderBy('sort_order', 'asc')
                     ->get();

        return view('pages.homestay.show', compact('homestay', 'files'));
    }

    public function edit($id)
    {
        $homestay = Homestay::findOrFail($id);
        $wargas = Warga::all();

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
        $validated = $request->validate([
            'nama' => 'required|string|max:100|min:3',
            'pemilik_warga_id' => 'required|exists:warga,warga_id',
            'alamat' => 'required|string|max:500|min:10',
            'rt' => 'nullable|string|max:5',
            'rw' => 'nullable|string|max:5',
            'fasilitas_json' => 'nullable|string',
            'harga_per_malam' => 'required|numeric|min:0',
            'status' => 'required|in:aktif,nonaktif,pending'
        ]);

        $homestay = Homestay::findOrFail($id);
        $homestay->update($validated);

        return redirect()->route('homestay.index')
            ->with('success', 'Homestay berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $homestay = Homestay::findOrFail($id);

        // Hapus semua file terkait
        $files = Media::where('ref_table', 'homestay')
                     ->where('ref_id', $homestay->homestay_id)
                     ->get();

        foreach ($files as $file) {
            Storage::disk('public')->delete($file->file_name);
            $file->delete();
        }

        $homestay->delete();

        return redirect()->route('homestay.index')
            ->with('success', 'Homestay berhasil dihapus!');
    }

    /**
     * Upload multiple files for homestay
     */
    public function uploadFiles(Request $request, string $id)
    {
        // FORMAT YANG DIDUKUNG: Gambar + PDF + DOC/DOCX
        $request->validate([
            'foto_homestay.*' => 'required|file|mimes:jpg,jpeg,png,gif,webp,bmp,pdf,doc,docx|max:10240',
        ]);

        $homestay = Homestay::findOrFail($id);

        // Ambil urutan terakhir untuk sort_order
        $currentMaxOrder = Media::where('ref_table', 'homestay')
                              ->where('ref_id', $homestay->homestay_id)
                              ->max('sort_order') ?? 0;

        if ($request->hasFile('foto_homestay')) {
            foreach ($request->file('foto_homestay') as $key => $file) {
                // Simpan dengan nama asli + timestamp
                $originalName = $file->getClientOriginalName();
                $filename = time() . '_' . $originalName;

                // Simpan file
                $file->storeAs('homestay', $filename, 'public');

                // SIMPAN KE MEDIA
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
        $homestay = Homestay::findOrFail($id);

        $file = Media::where('media_id', $fileId)
            ->where('ref_table', 'homestay')
            ->where('ref_id', $homestay->homestay_id)
            ->firstOrFail();

        $fileName = $file->file_name;

        Storage::disk('public')->delete($file->file_name);

        // Delete database record
        $file->delete();

        return back()->with('success', "File '{$fileName}' berhasil dihapus!");
    }

    /**
     * Download file
     */
    public function downloadFile(string $id, string $fileId)
    {
        $homestay = Homestay::findOrFail($id);

        $file = Media::where('media_id', $fileId)
            ->where('ref_table', 'homestay')
            ->where('ref_id', $homestay->homestay_id)
            ->firstOrFail();

        if (!Storage::disk('public')->exists($file->file_name)) {
            abort(404, 'File tidak ditemukan');
        }

        // Ambil nama asli dari filename (hapus timestamp)
        $filename = basename($file->file_name);
        $originalName = substr($filename, strpos($filename, '_') + 1);

        return Storage::disk('public')->download($file->file_name, $originalName);
    }

    /**
     * Show file in browser (preview gambar & PDF)
     */
    public function showFile(string $id, string $fileId)
    {
        $homestay = Homestay::findOrFail($id);

        $file = Media::where('media_id', $fileId)
            ->where('ref_table', 'homestay')
            ->where('ref_id', $homestay->homestay_id)
            ->firstOrFail();

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
}
