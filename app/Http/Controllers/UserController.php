<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    // public function __construct()
    // {
    //     // Middleware: hanya admin yang bisa akses CRUD user (kecuali myProfile)
    //     $this->middleware('checkrole:admin')->except(['myProfile', 'updateMyProfile', 'deleteMyProfilePhoto']);
    // }

    /**
     * Display a listing of the resource.
     * HANYA ADMIN: Bisa lihat semua user
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        // ✅ DOUBLE CHECK: Pastikan hanya admin
        if (!$user->isAdmin()) {
            abort(403, 'Hanya admin yang bisa mengakses manajemen user.');
        }

        $filterableColumns = ['urutan', 'role'];
        $searchableColumns = ['name', 'email'];

        $users = User::filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->paginate(10)
            ->onEachSide(2);

        return view('pages.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     * HANYA ADMIN: Bisa create user baru
     */
    public function create()
    {
        $user = Auth::user();

        if (!$user->isAdmin()) {
            abort(403, 'Hanya admin yang bisa menambahkan user baru.');
        }

        return view('pages.user.create');
    }

    /**
     * Store a newly created resource in storage.
     * HANYA ADMIN: Bisa store user baru
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        if (!$user->isAdmin()) {
            abort(403, 'Hanya admin yang bisa menambahkan user baru.');
        }

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

        // Upload foto profil jika ada
        if ($request->hasFile('profile_photo')) {
            $file = $request->file('profile_photo');

            $allowedMimes = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg', 'image/webp'];
            if (!in_array($file->getMimeType(), $allowedMimes)) {
                return back()->withErrors([
                    'profile_photo' => 'Format file tidak didukung. Gunakan jpg, jpeg, png, gif, atau webp.'
                ])->withInput();
            }

            $path = $request->file('profile_photo')->store('profile_pictures', 'public');
            $data['profile_picture'] = $path;
        }

        User::create($data);

        return redirect()->route('admin.user.index')
            ->with('success', 'User berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     * HANYA ADMIN: Bisa lihat detail user
     */
    public function show(string $id)
    {
         $currentUser = Auth::user();

        if (!$currentUser->isAdmin()) {
        abort(403, 'Hanya admin yang bisa melihat detail user.');
    }

    $user = User::findOrFail($id);
    return view('pages.user.show', compact('user'));
}
    /**
     * Show the form for editing the specified resource.
     * HANYA ADMIN: Bisa edit user
     */
    public function edit(string $id)
    {
        $currentUser = Auth::user();

        if (!$currentUser->isAdmin()) {
            abort(403, 'Hanya admin yang bisa mengedit user.');
        }

        $user = User::findOrFail($id);

        // Admin tidak bisa edit role sendiri menjadi non-admin
        if ($currentUser->id == $user->id && $currentUser->isAdmin()) {
            return view('pages.user.edit', compact('user'))->with('warning',
                'Anda sedang mengedit akun sendiri. Ubah role dengan hati-hati.');
        }

        return view('pages.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     * HANYA ADMIN: Bisa update user
     */
    public function update(Request $request, string $id)
    {
        $currentUser = Auth::user();

        if (!$currentUser->isAdmin()) {
            abort(403, 'Hanya admin yang bisa mengupdate user.');
        }

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

        // Validasi khusus: Admin tidak boleh menghapus role admin dari diri sendiri
        if ($currentUser->id == $user->id && $request->role !== 'admin') {
            return back()->withErrors([
                'role' => 'Anda tidak bisa menghapus role admin dari akun sendiri.'
            ])->withInput();
        }

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ];

        // Update password jika diisi
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        // Handle hapus foto
        if ($request->has('remove_photo') && $request->remove_photo == '1') {
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }
            $data['profile_picture'] = null;
        }

        // Handle upload foto baru
        if ($request->hasFile('profile_photo')) {
            // Hapus foto lama jika ada
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }

            $file = $request->file('profile_photo');

            $allowedMimes = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg', 'image/webp'];
            if (!in_array($file->getMimeType(), $allowedMimes)) {
                return back()->withErrors([
                    'profile_photo' => 'Format file tidak didukung. Gunakan jpg, jpeg, png, gif, atau webp.'
                ])->withInput();
            }

            $path = $request->file('profile_photo')->store('profile_pictures', 'public');
            $data['profile_picture'] = $path;
        }

        $user->update($data);

        return redirect()->route('admin.user.index')
            ->with('success', 'User berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     * HANYA ADMIN: Bisa delete user (dengan validasi)
     */
    public function destroy(string $id)
    {
        $currentUser = Auth::user();

        if (!$currentUser->isAdmin()) {
            abort(403, 'Hanya admin yang bisa menghapus user.');
        }

        $user = User::findOrFail($id);

        // Validasi: Admin tidak bisa hapus diri sendiri
        if ($currentUser->id == $user->id) {
            return redirect()->route('admin.user.index')
                ->with('error', 'Anda tidak bisa menghapus akun sendiri.');
        }

        // Validasi: Tidak bisa hapus user yang memiliki data terkait


        // Hapus foto profil jika ada
        if ($user->profile_picture) {
            Storage::disk('public')->delete($user->profile_picture);
        }

        $user->delete();

        return redirect()->route('admin.user.index')
            ->with('success', 'User berhasil dihapus');
    }

    /**
     * ====================================================
     * PROFILE METHODS - UNTUK SEMUA ROLE (MY PROFILE)
     * ====================================================
     */

    /**
     * SEMUA ROLE: Bisa lihat profile sendiri
     */
    public function myProfile()
    {
        $user = Auth::user();
        return view('pages.user.my-profile', compact('user'));
    }

    /**
     * SEMUA ROLE: Bisa update profile sendiri
     */
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

            $allowedMimes = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg', 'image/webp'];
            if (!in_array($file->getMimeType(), $allowedMimes)) {
                return back()->withErrors([
                    'profile_photo' => 'Format file tidak didukung. Gunakan jpg, jpeg, png, gif, atau webp.'
                ])->withInput();
            }

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

    /**
     * SEMUA ROLE: Bisa hapus foto profile sendiri
     */
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
