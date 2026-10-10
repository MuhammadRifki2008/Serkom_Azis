<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileSekolahController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\EkstrakurikulerController;
use App\Http\Controllers\UserController;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');

Route::get('/', [DashboardController::class, 'publicDashboard'])->name('public.dashboard');
Route::get('/profile', [ProfileSekolahController::class, 'publicProfile'])->name('public.profile');
Route::get('/ekstrakurikuler', [EkstrakurikulerController::class, 'publicEkstrakurikuler'])->name('public.ekstrakurikuler');
Route::get('/guru', [GuruController::class, 'publicGuru'])->name('public.guru');
Route::get('siswa', [SiswaController::class, 'publicSiswa'])->name('public.siswa');
Route::get('/berita', [BeritaController::class, 'publicBerita'])->name('public.berita');
Route::get('/galeri', [GaleriController::class, 'publicGaleri'])->name('public.galeri');

Route::get('/guru/{id}', [GuruController::class, 'publicGuruDetail'])->name('public.guru.detail');
Route::get('/berita/{id}', [BeritaController::class, 'publicBeritaDetail'])->name('public.berita.detail');
Route::get('/galeri/{id}', [GaleriController::class, 'publicGaleriDetail'])->name('public.galeri.detail');
Route::get('/ekstrakurikuler/{id}', [EkstrakurikulerController::class, 'publicEkstrakurikulerDetail'])->name('public.ekstrakurikuler.detail');



Route::prefix('admin')->middleware('auth')->group(function() {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::prefix('profile')->group(function(){
        Route::get('/', [ProfileSekolahController::class, 'index'])->name('admin.profile');
        Route::get('/edit', [ProfileSekolahController::class, 'edit'])->name('admin.profile.edit');
        Route::put('/', [ProfileSekolahController::class, 'update'])->name('admin.profile.update');
    });

    Route::prefix('siswa')->group(function () {
        Route::get('/', [SiswaController::class, 'index'])->name('admin.siswa.index');
        Route::get('/add-edit/{id?}', [SiswaController::class, 'addEdit'])->name('admin.siswa.addEdit');
        Route::post('/save/{id?}', [SiswaController::class, 'save'])->name('admin.siswa.save');
        Route::delete('/{id}', [SiswaController::class, 'destroy'])->name('admin.siswa.destroy');
    });

    Route::prefix('guru')->group(function () {
            Route::get('/', [GuruController::class, 'index'])->name('admin.guru.index');
            Route::get('/add-edit/{id?}', [GuruController::class, 'addEdit'])->name('admin.guru.addEdit');
            Route::post('/save/{id?}', [GuruController::class, 'save'])->name('admin.guru.save');
            Route::delete('/{id}', [GuruController::class, 'destroy'])->name('admin.guru.destroy');
        });

    Route::prefix('galeri')->group(function () {
            Route::get('/', [GaleriController::class, 'index'])->name('admin.galeri.index');
            Route::get('/add-edit/{id?}', [GaleriController::class, 'addEdit'])->name('admin.galeri.addEdit');
            Route::post('/save/{id?}', [GaleriController::class, 'save'])->name('admin.galeri.save');
            Route::delete('/{id}', [GaleriController::class, 'destroy'])->name('admin.galeri.destroy');
        });

    Route::prefix('berita')->group(function () {
            Route::get('/', [BeritaController::class, 'index'])->name('admin.berita.index');
            Route::get('/add-edit/{id?}', [BeritaController::class, 'addEdit'])->name('admin.berita.addEdit');
            Route::post('/save/{id?}', [BeritaController::class, 'save'])->name('admin.berita.save');
            Route::delete('/{id}', [BeritaController::class, 'destroy'])->name('admin.berita.destroy');
        });

    Route::prefix('ekstrakurikuler')->group(function () {
            Route::get('/', [EkstrakurikulerController::class, 'index'])->name('admin.ekstrakurikuler.index');
            Route::get('/add-edit/{id?}', [EkstrakurikulerController::class, 'addEdit'])->name('admin.ekstrakurikuler.addEdit');
            Route::post('/save/{id?}', [EkstrakurikulerController::class, 'save'])->name('admin.ekstrakurikuler.save');
            Route::delete('/{id}', [EkstrakurikulerController::class, 'destroy'])->name('admin.ekstrakurikuler.destroy');
        });

    Route::prefix('user')->group(function() {
        Route::get('/', [UserController::class, 'index'])->name('admin.user.index');
        Route::get('/add-edit/{id?}', [UserController::class, 'addEdit'])->name('admin.user.addEdit');
        Route::post('/save/{id?}', [UserController::class, 'save'])->name('admin.user.save');
        Route::delete('/{id}', [UserController::class, 'destroy'])->name('admin.user.delete');

    });

});
