<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\DestinasiWisata;
use App\Models\Media;
use Illuminate\Support\Facades\Storage;

class DestinasiWisataController extends Controller
{
    public function index(Request $request)
    {
        // Kolom yang bisa di-filter
        $filterableColumns = ['jam_buka'];

        // Kolom yang bisa di-search
        $searchableColumns = ['nama', 'deskripsi', 'alamat', 'kontak', 'tiket'];

        // Query dengan filter DAN search
        $destinasiWisata = DestinasiWisata::filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->paginate(10)
            ->onEachSide(2);

        return view('pages.destinasiwisata.index', compact('destinasiWisata'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.destinasiwisata.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255|min:3',
            'deskripsi' => 'required|string|min:10',
            'alamat' => 'required|string|max:500|min:10',
            'rt' => 'required|string|size:3',
            'rw' => 'required|string|size:3',
            'jam_buka' => 'required|date_format:H:i',
            'tiket' => 'required|numeric|min:0',
            'kontak' => 'required|string|min:10|max:15',
            'foto_destinasi' => 'nullable|array',
            // FORMAT YANG DIDUKUNG: Gambar + PDF + DOC/DOCX
            'foto_destinasi.*' => 'file|mimes:jpg,jpeg,png,gif,webp,bmp,pdf,doc,docx|max:10240',
        ]);

        // Simpan data destinasi wisata
        $destinasi = DestinasiWisata::create($validated);

        // Upload file jika ada
        if ($request->hasFile('foto_destinasi')) {
            foreach ($request->file('foto_destinasi') as $key => $file) {
                // Simpan dengan nama asli + timestamp agar unique
                $originalName = $file->getClientOriginalName();
                $filename = time() . '_' . $originalName;
                $file->storeAs('destinasi_wisata', $filename, 'public'); // TAMBAH: , 'public'

                // SIMPAN KE MEDIA - TAMBAHKAN PATH LENGKAP
                Media::create([
                    'file_name' => 'destinasi_wisata/' . $filename, // TAMBAH: 'destinasi_wisata/'
                    'ref_table' => 'destinasi_wisata',
                    'ref_id' => $destinasi->destinasi_id,
                    'mime_type' => $file->getMimeType(),
                    'sort_order' => $key + 1,
                    'caption' => null,
                ]);
            }
        }

        return redirect()->route('destinasiwisata.index')
            ->with('success', 'Data destinasi wisata berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $destinasiWisata = DestinasiWisata::findOrFail($id);

        $files = Media::where('ref_table', 'destinasi_wisata')
                     ->where('ref_id', $destinasiWisata->destinasi_id)
                     ->orderBy('sort_order', 'asc')
                     ->get();

        return view('pages.destinasiwisata.show', compact('destinasiWisata', 'files'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
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
        $validated = $request->validate([
            'nama' => 'required|string|max:255|min:3',
            'deskripsi' => 'required|string|min:10',
            'alamat' => 'required|string|max:500|min:10',
            'rt' => 'required|string|size:3',
            'rw' => 'required|string|size:3',
            'jam_buka' => 'required|date_format:H:i',
            'tiket' => 'required|numeric|min:0',
            'kontak' => 'required|string|min:10|max:15',
        ]);

        $destinasi = DestinasiWisata::findOrFail($id);
        $destinasi->update($validated);

        return redirect()->route('destinasiwisata.index')
            ->with('success', 'Data destinasi wisata berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $destinasi = DestinasiWisata::findOrFail($id);

        // Hapus semua file terkait
        $files = Media::where('ref_table', 'destinasi_wisata')
                     ->where('ref_id', $destinasi->destinasi_id)
                     ->get();

        foreach ($files as $file) {
            // **UBAH SEDIKIT: Gunakan Storage::disk('public')**
            Storage::disk('public')->delete($file->file_name);
            $file->delete();
        }

        $destinasi->delete();

        return redirect()->route('destinasiwisata.index')
            ->with('success', 'Data destinasi wisata berhasil dihapus!');
    }

    /**
     * Upload multiple files for destinasi wisata
     */
    public function uploadFiles(Request $request, string $id)
    {
        // FORMAT YANG DIDUKUNG: Gambar + PDF + DOC/DOCX
        $request->validate([
            'foto_destinasi.*' => 'required|file|mimes:jpg,jpeg,png,gif,webp,bmp,pdf,doc,docx|max:10240',
        ]);

        $destinasi = DestinasiWisata::findOrFail($id);

        // Ambil urutan terakhir untuk sort_order
        $currentMaxOrder = Media::where('ref_table', 'destinasi_wisata')
                              ->where('ref_id', $destinasi->destinasi_id)
                              ->max('sort_order') ?? 0;

        if ($request->hasFile('foto_destinasi')) {
            foreach ($request->file('foto_destinasi') as $key => $file) {
                // Simpan dengan nama asli + timestamp
                $originalName = $file->getClientOriginalName();
                $filename = time() . '_' . $originalName;

                // **TAMBAHKAN INI: Simpan dengan cara yang sama**
                $file->storeAs('destinasi_wisata', $filename, 'public'); // TAMBAH: , 'public'

                // SIMPAN KE MEDIA - TAMBAHKAN PATH LENGKAP
                Media::create([
                    'file_name' => 'destinasi_wisata/' . $filename, // TAMBAH: 'destinasi_wisata/'
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

    /**
     * Delete specific file for destinasi wisata
     */
    public function deleteFile(string $id, string $fileId)
    {
        $destinasi = DestinasiWisata::findOrFail($id);

        $file = Media::where('media_id', $fileId)
            ->where('ref_table', 'destinasi_wisata')
            ->where('ref_id', $destinasi->destinasi_id)
            ->firstOrFail();

        $fileName = $file->file_name;

        // **UBAH SEDIKIT: Gunakan Storage::disk('public')**
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
        $destinasi = DestinasiWisata::findOrFail($id);

        $file = Media::where('media_id', $fileId)
            ->where('ref_table', 'destinasi_wisata')
            ->where('ref_id', $destinasi->destinasi_id)
            ->firstOrFail();

        // **UBAH SEDIKIT: Gunakan Storage::disk('public') seperti teman Anda**
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
        $destinasi = DestinasiWisata::findOrFail($id);

        $file = Media::where('media_id', $fileId)
            ->where('ref_table', 'destinasi_wisata')
            ->where('ref_id', $destinasi->destinasi_id)
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
     public function renameFile(Request $request, string $id, string $fileId)
    {
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
