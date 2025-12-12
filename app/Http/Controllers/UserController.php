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
        // // Hanya admin yang bisa akses CRUD user lain
        // $this->middleware('checkrole:admin')->except(['myProfile', 'updateMyProfile', 'deleteMyProfilePhoto']);
        // // Semua yang login bisa akses profile sendiri
        // $this->middleware('checkislogin')->only(['myProfile', 'updateMyProfile', 'deleteMyProfilePhoto']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Kolom yang bisa di-filter
        $filterableColumns = ['urutan', 'role'];

        // Kolom yang bisa di-search
        $searchableColumns = ['name', 'email', 'id'];

        // Query dengan filter DAN search
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
            'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ], [
            'role.required' => 'Role wajib dipilih',
            'role.in' => 'Role harus admin, pemilik, atau warga',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ];

        // Handle profile photo upload - SIMPAN KE profile_users
        if ($request->hasFile('profile_photo')) {
            $file = $request->file('profile_photo');

            // Buat nama file yang unik
            $fileName = 'user_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            // Pastikan folder profile_users ada
            $folderPath = 'public/profile_user'; // PERUBAHAN: profile_users bukan profile_user
            if (!Storage::exists($folderPath)) {
                Storage::makeDirectory($folderPath);
            }

            // Simpan file ke profile_users
            $file->storeAs($folderPath, $fileName);
            $data['profile_photo'] = $fileName;

            // Debug info
            \Log::info('Foto disimpan ke: ' . storage_path('app/' . $folderPath . '/' . $fileName));
        }

        User::create($data);

        return redirect()->route('user.index')
            ->with('success', 'User berhasil ditambahkan');
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
            'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ], [
            'role.required' => 'Role wajib dipilih',
            'role.in' => 'Role harus admin, pemilik, atau warga',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ];

        // Update password if provided
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        // Handle remove photo request
        if ($request->has('remove_photo') && $request->remove_photo == '1') {
            // Delete old photo if exists - HAPUS DARI profile_users
            if ($user->profile_photo && Storage::exists('public/profile_user/' . $user->profile_photo)) {
                Storage::delete('public/profile_user/' . $user->profile_photo);
            }
            $data['profile_photo'] = null;
        }

        // Handle profile photo upload - SIMPAN KE profile_users
        if ($request->hasFile('profile_photo')) {
            // Delete old photo if exists - HAPUS DARI profile_users
            if ($user->profile_photo && Storage::exists('public/profile_user/' . $user->profile_photo)) {
                Storage::delete('public/profile_user/' . $user->profile_photo);
            }

            // Upload new photo
            $file = $request->file('profile_photo');

            // Buat nama file yang unik
            $fileName = 'user_' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();

            // Pastikan folder profile_users ada
            $folderPath = 'public/profile_user'; // PERUBAHAN: profile_users bukan profile_user
            if (!Storage::exists($folderPath)) {
                Storage::makeDirectory($folderPath);
            }

            // Simpan file ke profile_users
            $file->storeAs($folderPath, $fileName);
            $data['profile_photo'] = $fileName;

            // Debug info
            \Log::info('Foto diupdate ke: ' . storage_path('app/' . $folderPath . '/' . $fileName));
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

        // Delete profile photo if exists - HAPUS DARI profile_users
        if ($user->profile_photo && Storage::exists('public/profile_user/' . $user->profile_photo)) {
            Storage::delete('public/profile_user/' . $user->profile_photo);
        }

        $user->delete();

        return redirect()->route('user.index')
            ->with('success', 'User berhasil dihapus');
    }

    // ==================== PROFILE METHODS (UNTUK USER LOGIN SENDIRI) ====================

    /**
     * Show my profile (untuk user yang login edit profile sendiri)
     */
    public function myProfile()
    {
        $user = Auth::user();
        return view('pages.user.my-profile', compact('user'));
    }

    /**
     * Update my profile (untuk user yang login edit profile sendiri)
     */
    public function updateMyProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'current_password' => 'nullable|string',
            'new_password' => 'nullable|min:8|confirmed',
            'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        // Update basic info
        $user->name = $request->name;
        $user->email = $request->email;

        // Update password if provided
        if ($request->filled('current_password') && $request->filled('new_password')) {
            if (Hash::check($request->current_password, $user->password)) {
                $user->password = Hash::make($request->new_password);
            } else {
                return back()->withErrors(['current_password' => 'Password saat ini salah']);
            }
        }

        // Handle remove photo request untuk profile sendiri
        if ($request->has('remove_photo') && $request->remove_photo == '1') {
            // Delete old photo if exists - HAPUS DARI profile_users
            if ($user->profile_photo && Storage::exists('public/profile_user/' . $user->profile_photo)) {
                Storage::delete('public/profile_user/' . $user->profile_photo);
            }
            $user->profile_photo = null;
        }

        // Handle profile photo upload - SIMPAN KE profile_users
        if ($request->hasFile('profile_photo')) {
            // Delete old photo if exists - HAPUS DARI profile_users
            if ($user->profile_photo && Storage::exists('public/profile_user/' . $user->profile_photo)) {
                Storage::delete('public/profile_user/' . $user->profile_photo);
            }

            // Upload new photo
            $file = $request->file('profile_photo');

            // Buat nama file yang unik
            $fileName = 'user_' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();

            // Pastikan folder profile_users ada
            $folderPath = 'public/profile_user'; // PERUBAHAN: profile_users bukan profile_user
            if (!Storage::exists($folderPath)) {
                Storage::makeDirectory($folderPath);
            }

            // Simpan file ke profile_users
            $file->storeAs($folderPath, $fileName);
            $user->profile_photo = $fileName;
        }

        $user->save();

        return redirect()->route('user.my-profile')->with('success', 'Profile berhasil diperbarui');
    }

    /**
     * Delete my profile photo (untuk user yang login)
     */
    public function deleteMyProfilePhoto()
    {
        $user = Auth::user();

        if ($user->profile_photo && Storage::exists('public/profile_user/' . $user->profile_photo)) {
            Storage::delete('public/profile_user/' . $user->profile_photo);
            $user->profile_photo = null;
            $user->save();

            return back()->with('success', 'Foto profile berhasil dihapus');
        }

        return back()->with('error', 'Tidak ada foto untuk dihapus');
    }
}
