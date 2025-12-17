<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function __construct()
    {
        // Middleware sesuai kebutuhan
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filterableColumns = ['urutan', 'role'];
        $searchableColumns = ['name', 'email', 'id'];

        $users = User::filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->paginate(10)
            ->onEachSide(2);

        return view('pages.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'role' => 'required|in:admin,pemilik,warga',
            'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
        ], [
            'role.required' => 'Role wajib dipilih',
            'role.in' => 'Role harus admin, pemilik, atau warga',
            'profile_photo.image' => 'File harus berupa gambar',
            'profile_photo.mimes' => 'Format gambar harus jpg, jpeg, png, gif, atau webp',
            'profile_photo.max' => 'Ukuran gambar maksimal 2MB',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ];

        // ✅ PERBAIKAN: Pakai cara temanmu yang sudah berhasil
        if ($request->hasFile('profile_photo')) {
            $file = $request->file('profile_photo');

            // Validasi manual tipe file
            $allowedMimes = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg', 'image/webp'];
            if (!in_array($file->getMimeType(), $allowedMimes)) {
                return back()->withErrors([
                    'profile_photo' => 'Format file tidak didukung. Gunakan jpg, jpeg, png, gif, atau webp.'
                ])->withInput();
            }

            // ✅ CARA BENAR: Simpan dengan store() ke folder 'profile_pictures'
            $path = $request->file('profile_photo')->store('profile_pictures', 'public');

            // Simpan FULL PATH ke database
            $data['profile_picture'] = $path; // Contoh: 'profile_pictures/filename.jpg'
        }

        User::create($data);

        return redirect()->route('user.index')
            ->with('success', 'User berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return view('pages.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('pages.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:8|confirmed',
            'role' => 'required|in:admin,pemilik,warga',
            'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
        ], [
            'role.required' => 'Role wajib dipilih',
            'role.in' => 'Role harus admin, pemilik, atau warga',
            'profile_photo.image' => 'File harus berupa gambar',
            'profile_photo.mimes' => 'Format gambar harus jpg, jpeg, png, gif, atau webp',
            'profile_photo.max' => 'Ukuran gambar maksimal 2MB',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ];

        // Update password jika diisi
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        // ✅ PERBAIKAN: Handle hapus foto (seperti temanmu)
        if ($request->has('remove_photo') && $request->remove_photo == '1') {
            // Hapus file dari storage
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }
            $data['profile_picture'] = null;
        }

        // ✅ PERBAIKAN: Handle upload foto baru (seperti temanmu)
        if ($request->hasFile('profile_photo')) {
            // Hapus foto lama jika ada
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }

            $file = $request->file('profile_photo');

            // Validasi manual tipe file
            $allowedMimes = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg', 'image/webp'];
            if (!in_array($file->getMimeType(), $allowedMimes)) {
                return back()->withErrors([
                    'profile_photo' => 'Format file tidak didukung. Gunakan jpg, jpeg, png, gif, atau webp.'
                ])->withInput();
            }

            // ✅ CARA BENAR: Simpan dengan store()
            $path = $request->file('profile_photo')->store('profile_pictures', 'public');

            // Simpan FULL PATH ke database
            $data['profile_picture'] = $path;
        }

        $user->update($data);

        return redirect()->route('user.index')
            ->with('success', 'User berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        // ✅ PERBAIKAN: Hapus foto profil jika ada (seperti temanmu)
        if ($user->profile_picture) {
            Storage::disk('public')->delete($user->profile_picture);
        }

        $user->delete();

        return redirect()->route('user.index')
            ->with('success', 'User berhasil dihapus');
    }

    /**
     * PROFILE METHODS - TAMBAHKAN INI
     */
    public function myProfile()
    {
        $user = Auth::user();
        return view('pages.user.my-profile', compact('user'));
    }

    public function updateMyProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:8|confirmed',
        ], [
            'profile_photo.image' => 'File harus berupa gambar',
            'profile_photo.mimes' => 'Format gambar harus jpg, jpeg, png, gif, atau webp',
            'profile_photo.max' => 'Ukuran gambar maksimal 2MB',
            'current_password.required_with' => 'Password saat ini diperlukan untuk mengganti password',
            'new_password.confirmed' => 'Konfirmasi password baru tidak cocok',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        // Update password jika diminta
        if ($request->filled('current_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors([
                    'current_password' => 'Password saat ini tidak sesuai'
                ])->withInput();
            }

            if ($request->filled('new_password')) {
                $data['password'] = Hash::make($request->new_password);
            }
        }

        // Handle upload foto profil
        if ($request->hasFile('profile_photo')) {
            // Hapus foto lama jika ada
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }

            $file = $request->file('profile_photo');

            // Validasi manual tipe file
            $allowedMimes = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg', 'image/webp'];
            if (!in_array($file->getMimeType(), $allowedMimes)) {
                return back()->withErrors([
                    'profile_photo' => 'Format file tidak didukung. Gunakan jpg, jpeg, png, gif, atau webp.'
                ])->withInput();
            }

            // Simpan file
            $path = $request->file('profile_photo')->store('profile_pictures', 'public');
            $data['profile_picture'] = $path;
        }

        // Handle hapus foto
        if ($request->has('remove_photo') && $request->remove_photo == '1') {
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }
            $data['profile_picture'] = null;
        }

        $user->update($data);

        return redirect()->route('user.my-profile')
            ->with('success', 'Profil berhasil diperbarui');
    }

    public function deleteMyProfilePhoto()
    {
        $user = Auth::user();

        if ($user->profile_picture) {
            Storage::disk('public')->delete($user->profile_picture);
            $user->update(['profile_picture' => null]);

            return redirect()->route('user.my-profile')
                ->with('success', 'Foto profil berhasil dihapus');
        }

        return redirect()->route('user.my-profile')
            ->with('error', 'Tidak ada foto profil untuk dihapus');
    }
}
