<?php

namespace App\Http\Controllers;

use App\Models\LevelModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index()
    {
        $id = session('user_id');
        $breadcrumb = (object) [
            'title' => 'Profile',
            'list' => ['Home', 'profile']
        ];
        $page = (object) [
            'title' => 'Profile Anda'
        ];
        $activeMenu = 'profile'; // set menu yang sedang aktif
        $user = UserModel::with('level')->find(Auth::user()->user_id);
        $level = LevelModel::all(); // ambil data level untuk filter level
        return view('profile.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'level' => $level, 'user' => $user,'activeMenu' => $activeMenu]);
    }

    public function show(string $id)
    {
        $user = UserModel::with('level')->find($id);
        $breadcrumb = (object) ['title' => 'Detail User', 'list' => ['Home', 'User', 'Detail']];
        $page = (object) ['title' => 'Detail user'];
        $activeMenu = 'user'; // set menu yang sedang aktif
        return view('user.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'user' => $user, 'activeMenu' => $activeMenu]);
    }

    public function edit_ajax(string $id)
    {
        $user = UserModel::find($id);
        $level = LevelModel::select('level_id', 'level_nama')->get();
        return view('profile.edit_ajax', ['user' => $user, 'level' => $level]);
    }

    public function update_ajax(Request $request, $id)
{
    $validated = $request->validate([
        'username' => 'required|string|max:255',
        'nama' => 'required|string|max:255',
        'level_id' => 'required|exists:level_models,level_id', // Tambahkan validasi untuk level_id
    ]);
    
    $user = UserModel::find($id);
    
    $user->username = $request->input('username');
    $user->nama = $request->input('nama');

    // Update password jika diisi
    if ($request->filled('password')) {
        $user->password = bcrypt($request->input('password')); // Pastikan password di-hash
    }

    $user->level_id = $request->input('level_id'); // Tambahkan untuk mengupdate level
    $user->save();

    return response()->json(['status' => true, 'message' => 'Profile updated successfully!']);
}




    public function edit_foto(string $id)
    {
        $user = UserModel::find($id);
        $level = LevelModel::select('level_id', 'level_nama')->get();
        return view('profile.edit_foto', ['user' => $user, 'level'=>$level]);
    }

    public function update_foto(Request $request, $id)
    {
        // cek apakah request dari ajax
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'user_profile'   => 'required|mimes:jpeg,png,jpg|max:4096'
            ];
            // use Illuminate\Support\Facades\Validator;
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false, // respon json, true: berhasil, false: gagal
                    'message' => 'Validasi gagal.',
                    'msgField' => $validator->errors() // menunjukkan field mana yang error
                ]);
            }
            $check = UserModel::find($id);
            if ($check) {
                if ($request->has('user_profile')) {
                    $file = $request->file('user_profile');
                    $extension = $file->getClientOriginalExtension();

                    $filename = time() . '.' . $extension;

                    $path = 'image/profile/';
                    $file->move($path, $filename);
                }
                $check->update([
                    'user_profile'      => $path.$filename
                ]);
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil diupdate'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }
        return redirect('/');
    }

}
