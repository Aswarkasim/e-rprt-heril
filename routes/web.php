<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminBannerController;
use App\Http\Controllers\AdminCategoryPostController;
use App\Http\Controllers\AdminConfigurationController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminDescController;
use App\Http\Controllers\AdminEkskulController;
use App\Http\Controllers\AdminGuruController;
use App\Http\Controllers\AdminKelasController;
use App\Http\Controllers\AdminMapelController;
use App\Http\Controllers\AdminNilaiController;
use App\Http\Controllers\AdminRaportController;
use App\Http\Controllers\AdminSekolahController;
use App\Http\Controllers\AdminSiswaController;
use App\Http\Controllers\AdminTaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [AdminAuthController::class, 'index']);



Route::prefix('/admin/auth')->group(function () {
    Route::get('/', [AdminAuthController::class, 'index'])->middleware('guest');
    Route::post('/login', [AdminAuthController::class, 'login']);

    Route::get('/register', [AdminAuthController::class, 'register']);
    Route::post('/doRegister', [AdminAuthController::class, 'doRegsiter']);
    Route::get('/logout', [AdminAuthController::class, 'logout']);
});


Route::prefix('/admin')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index']);

    Route::resource('/mapel', AdminMapelController::class);
    Route::resource('/kelas', AdminKelasController::class);
    Route::resource('/siswa', AdminSiswaController::class);
    Route::resource('/guru', AdminGuruController::class);


    Route::get('/ta/user/change', [AdminTaController::class, 'changeTa']);
    Route::resource('/ta', AdminTaController::class);
    Route::resource('/user', AdminUserController::class);

    Route::get('/sekolah', [AdminSekolahController::class, 'index']);
    Route::put('/sekolah/update', [AdminSekolahController::class, 'update']);


    Route::get('/konfigurasi', [AdminConfigurationController::class, 'index']);
    Route::put('/konfigurasi/update', [AdminConfigurationController::class, 'update']);

    Route::resource('/banner', AdminBannerController::class);


    Route::prefix('/posts')->group(function () {
        Route::resource('/post', AdminPostController::class);
        Route::resource('/kategori', AdminCategoryPostController::class);
    });
});

Route::prefix('/guru')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index']);

    Route::resource('/desc', AdminDescController::class);

    Route::get('/profile/{id}', [AdminGuruController::class, 'edit']);

    Route::get('/nilai', [AdminNilaiController::class, 'index']);
    Route::get('/nilai/save', [AdminNilaiController::class, 'simpanNilai']);
    Route::get('/nilai/update', [AdminNilaiController::class, 'update']);
    Route::get('/nilai/create', [AdminNilaiController::class, 'create']);

    Route::resource('/ekskul', AdminEkskulController::class);

    Route::get('/raport/kehadiran/update', [AdminRaportController::class, 'kehadiran']);
    Route::get('/raport/cetak', [AdminRaportController::class, 'cetak']);
    Route::get('/raport', [AdminRaportController::class, 'index']);
});

Route::prefix('/wali')->group(function () {
});

Route::prefix('/home')->group(function () {
    // Route::resource('/mitra', HomeMitraController::class);;
    // Route::resource('/layanan', HomeLayananController::class);;
});

Route::get('/get-kelas/{ta_id?}', [AdminNilaiController::class, 'getKelas']);
