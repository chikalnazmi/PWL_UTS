<?php

use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\AuthController;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/level', [LevelController::class, 'index']);
// Route::get('/kategori', [KategoriController::class, 'index']);
// Route::get('/user', [UserController::class, 'index']);
// Route::get('/user/tambah', [UserController::class, 'tambah']);
// Route::post('/user/tambah_simpan', [UserController::class, 'tambah_simpan']);
// Route::get('/user/ubah/{id}', [UserController::class, 'ubah']);
// Route::put('/user/ubah_simpan/{id}', [UserController::class, 'ubah_simpan']);
// Route::get('/user/hapus/{id}', [UserController::class, 'hapus']);

Route::pattern('id', '[0-9]+');

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'postLogin']);
Route::get('logout', [AuthController::class, 'logout'])->middleware('auth');


Route::middleware(['auth'])->group(function() {
    Route::get('/', [WelcomeController::class, 'index']);

    Route::middleware(['authorize:ADM'])->group(function(){
        Route::get('/level', [LevelController::class, 'index']);
        Route::get('/level/list', [LevelController::class,'list']);
        Route::get('/level/create', [LevelController::class, 'create']);
        Route::post('/level', [LevelController::class, 'store']);
        Route::get('/level/{id}/edit', [LevelController::class, 'edit']);
        Route::put('/level/{id}', [LevelController::class, 'update']);
        Route::delete('/level/{id}', [LevelController::class, 'destroy']);
    });


    // PERTEMUAN 5

    Route::group(['prefix' => 'user'], function () {
        Route::get('/', [UserController::class, 'index']);          // menampilkan halaman awal user
        Route::post('/list', [UserController::class, 'list']);      // menampilkan data user dalam bentuk json untuk datatables
        Route::get('/create', [UserController::class, 'create']);   // menampilkan halaman form tambah user
        Route::post('/', [UserController::class, 'store']);         // menyimpan data user baru
        Route::get('/create_ajax', [UserController::class, 'create_ajax']);   // menampilkan halaman form tambah user ajax
        Route::post('/ajax', [UserController::class, 'store_ajax']);         // menyimpan data user baru ajax
        Route::get('/{id}', [UserController::class, 'show']);       // menampilkan detail user
        Route::get('/{id}/edit', [UserController::class, 'edit']);  // menampilkan halaman form edit user
        Route::put('/{id}', [UserController::class, 'update']);     // menyimpan perubahan data user
        Route::delete('/{id}', [UserController::class, 'destroy']); // menghapus data user
        Route::get('/{id}/edit_ajax', [UserController::class, 'edit_ajax']); // Menampilkan halaman form edit user Ajax
        Route::put('/{id}/update_ajax', [UserController::class, 'update_ajax']); // Menyimpan perubahan data user Ajax
        Route::get('/{id}/delete_ajax', [UserController::class, 'confirm_ajax']); // Untuk tampilkan form confirm delete user Ajax
        Route::delete('/{id}/delete_ajax', [UserController::class, 'delete_ajax']); // Untuk hapus data user Ajax
    });

    Route::group(['prefix' => 'kategori'], function () {
        Route::get('/', [KategoriController::class, 'index']); //menampilkan halaman awal user
        Route::post('/list', [KategoriController::class, 'list']); //menampilkan dta user dalam bentuk json untuk datatables
        Route::get('/create', [KategoriController::class, 'create']); //menampilkan halaman form tambah user
        Route::post('/', [KategoriController::class, 'store']); //menyimpan data user baru
        Route::get('/create_ajax', [KategoriController::class, 'create_ajax']);
        Route::post('/ajax', [KategoriController::class, 'store_ajax']);
        Route::get('/{id}', [KategoriController::class, 'show']); //menampilkan halaman detail user
        Route::get('/{id}/edit', [KategoriController::class, 'edit']); //menampilkan halaman form edit user
        Route::put('{id}', [KategoriController::class, 'update']); //menyimpan perubahan data user
        Route::get('/{id}/edit_ajax', [KategoriController::class, 'edit_ajax']);
        Route::put('/{id}/update_ajax', [KategoriController::class, 'update_ajax']);
        Route::get('/{id}/delete_ajax', [KategoriController::class, 'confirm_ajax']);
        Route::delete('/{id}/delete_ajax', [KategoriController::class, 'delete_ajax']);
        Route::delete('{id}', [KategoriController::class, 'destroy']); //menghapus data user
    });

    Route::group(['prefix' => 'supplier'], function () {
        Route::get('/', [SupplierController::class, 'index']); //menampilkan halaman awal user
        Route::post('/list', [SupplierController::class, 'list']); //menampilkan dta user dalam bentuk json untuk datatables
        Route::get('/create', [SupplierController::class, 'create']); //menampilkan halaman form tambah user
        Route::post('/', [SupplierController::class, 'store']); //menyimpan data user baru
        Route::get('/create_ajax', [SupplierController::class, 'create_ajax']);
        Route::post('/ajax', [SupplierController::class, 'store_ajax']);
        Route::get('/{id}/edit_ajax', [SupplierController::class, 'edit_ajax']);
        Route::put('/{id}/update_ajax', [SupplierController::class, 'update_ajax']);
        Route::get('/{id}/delete_ajax', [SupplierController::class, 'confirm_ajax']);
        Route::delete('/{id}/delete_ajax', [SupplierController::class, 'delete_ajax']);
        Route::get('/{id}', [SupplierController::class, 'show']); //menampilkan halaman detail user
        Route::get('/{id}/edit', [SupplierController::class, 'edit']); //menampilkan halaman form edit user
        Route::put('{id}', [SupplierController::class, 'update']); //menyimpan perubahan data user
        Route::delete('{id}', [SupplierController::class, 'destroy']); //menghapus data user
    });

    Route::group(['prefix' => 'barang'], function () {
        Route::get('/', [BarangController::class, 'index']); //menampilkan halaman awal user
        Route::post('/list', [BarangController::class, 'list']); //menampilkan dta user dalam bentuk json untuk datatables
        Route::get('/create', [BarangController::class, 'create']); //menampilkan halaman form tambah user
        Route::post('/', [BarangController::class, 'store']); //menyimpan data user baru
        Route::get('/create_ajax', [BarangController::class, 'create_ajax']);
        Route::post('/ajax', [BarangController::class, 'store_ajax']);
        Route::get('/{id}/edit_ajax', [BarangController::class, 'edit_ajax']);
        Route::put('/{id}/update_ajax', [BarangController::class, 'update_ajax']);
        Route::get('/{id}/delete_ajax', [BarangController::class, 'confirm_ajax']);
        Route::delete('/{id}/delete_ajax', [BarangController::class, 'delete_ajax']);
        Route::get('/{id}', [BarangController::class, 'show']); //menampilkan halaman detail user
        Route::get('/{id}/edit', [BarangController::class, 'edit']); //menampilkan halaman form edit user
        Route::put('{id}', [BarangController::class, 'update']); //menyimpan perubahan data user
        Route::delete('{id}', [BarangController::class, 'destroy']); //menghapus data user
    });

});