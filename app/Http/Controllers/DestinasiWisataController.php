<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DestinasiWisata;
use App\Models\Media;
use Illuminate\Support\Facades\Storage;

class DestinasiWisataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Kolom yang bisa di-filter
        $filterableColumns = ['jam_buka'];

        // Kolom yang bisa di-search (TAMBAH 'tiket')
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
            'foto_destinasi.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        // Simpan data destinasi wisata
        $destinasi = DestinasiWisata::create($validated);

        // Upload foto jika ada
        if ($request->hasFile('foto_destinasi')) {
            foreach ($request->file('foto_destinasi') as $key => $file) {
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/destinasi_wisata', $filename);

                // SIMPAN KE MEDIA DENGAN STRUKTUR YANG BENAR
                Media::create([
                    'file_name' => $filename,  // FILE_NAME BUKAN FILE_URL
                    'ref_table' => 'destinasi_wisata',
                    'ref_id' => $destinasi->destinasi_id,
                    'mime_type' => $file->getMimeType(),
                    'sort_order' => $key + 1,
                    'caption' => null, // optional
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
            Storage::delete('public/destinasi_wisata/' . $file->file_name);
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
        $request->validate([
            'foto_destinasi.*' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        $destinasi = DestinasiWisata::findOrFail($id);

        if ($request->hasFile('foto_destinasi')) {
            foreach ($request->file('foto_destinasi') as $key => $file) {
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/destinasi_wisata', $filename);

                // SIMPAN DENGAN FILE_NAME
                Media::create([
                    'file_name' => $filename,
                    'ref_table' => 'destinasi_wisata',
                    'ref_id' => $destinasi->destinasi_id,
                    'mime_type' => $file->getMimeType(),
                    'sort_order' => $key + 1,
                ]);
            }
        }

        return back()->with('success', "Foto berhasil diupload!");
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

        // Delete physical file
        Storage::delete('public/destinasi_wisata/' . $file->file_name);

        // Delete database record
        $file->delete();

        return back()->with('success', "File '{$fileName}' berhasil dihapus!");
    }
}
