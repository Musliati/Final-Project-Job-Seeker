<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Home;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index']);

// Route::get('/kategori', [KategoriController::class,'index']);

Route::controller(AdminController::class)->group(function () {
    Route::get('admin', 'index');
    Route::get('admin/kategori', 'kategori');
    Route::get('admin/tambahkategori', 'tambahkategori');
    Route::post('admin/simpankategori', 'simpankategori');
    Route::get('admin/ubahkategori/{id}', 'ubahkategori');
    Route::post('admin/updatekategori/{id}', 'updatekategori');
    Route::get('admin/hapuskategori/{id}', 'hapuskategori');

    Route::get('admin/loker', 'loker'); 
    Route::get('admin/tambahloker', 'tambahloker');
    Route::post('admin/simpanloker', 'simpanloker');
    Route::get('admin/ubahloker/{id}', 'ubahloker');
    Route::post('admin/updateloker/{id}', 'updateloker');
    Route::get('admin/hapusloker/{id}', 'hapusloker');

    Route::get('admin/pelamar', 'pelamar');
    Route::get('admin/tambahpelamar', 'tambahpelamar');
    Route::post('admin/simpanpelamar', 'simpanpelamar');
    Route::get('admin/detailpelamar/{id}', 'detailpelamar');
    Route::post('admin/updatestatus/{id}', 'updatestatus');
    Route::get('admin/hapuspelamar/{id}', 'hapuspelamar');

    Route::get('admin/profile', 'profile');
    Route::post('admin/updateprofile/{id}', 'updateprofile');

    Route::get('admin/pengguna', 'pengguna');
    Route::get('admin/tambahpengguna', 'tambahpengguna');
    Route::post('admin/simpanpengguna', 'simpanpengguna');
    Route::get('admin/ubahpengguna/{id}', 'ubahpengguna');
    Route::post('admin/updatepengguna/{id}', 'updatepengguna');
    Route::get('admin/hapuspengguna/{id}', 'hapuspengguna');

    Route::get('admin/employer', 'employer');
    Route::get('admin/tambahemployer', 'tambahemployer');
    Route::post('admin/simpanemployer', 'simpanemployer');
    Route::get('admin/ubahemployer/{id}', 'ubahemployer');
    Route::post('admin/updateemployer/{id}', 'updateemployer');
    Route::get('admin/hapusemployer/{id}', 'hapusemployer');

    Route::get('admin/logout', 'logout');

});

Route::controller(HomeController::class)->group(function () {
    Route::get('home', 'index');
    Route::get('home/lokerdaftar', 'lokerdaftar');
    Route::get('home/kategori', 'kategori');
    Route::get('home/kategori/{id}', 'kategoriloker');
    Route::get('home/kategorifilter', 'kategorifilter');
    Route::get('home/detail/{id}', 'detail');

    Route::get('home/login', 'login');
    Route::post('home/dologin', 'dologin');
    Route::get('home/daftar', 'daftar');
    Route::post('home/dodaftar', 'dodaftar');
    Route::get('home/daftaremployer', 'daftaremployer');
    Route::post('home/dodaftaremployer', 'dodaftaremployer');
    Route:: post('home/lamar', 'lamar');
   
    Route::get('home/akun', 'akun');
    Route::post('home/ubahakun/{id}', 'ubahakun');
    Route::get('home/riwayat', 'riwayat');
    Route::get('home/logout', 'logout');


});
