<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\RoleMenuController;

// halaman login untuk pengguna yang belum login
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.process');
});

// halaman yang hanya bisa diakses setelah login
Route::middleware('auth')->group(function () {

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    // Dashboard Admin
    Route::middleware('role:admin')->prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])
            ->name('admin.dashboard');

        Route::get('/users', [UserController::class, 'index'])
            ->name('admin.users');

        Route::post('/guru-kelas', [AdminController::class, 'assignGuruKelas'])
            ->name('admin.guru-kelas');

        Route::put('/hak-akses/{role}', [RoleMenuController::class, 'update'])
            ->name('admin.hak-akses.update');
    });

    // Dashboard Guru
    Route::middleware('role:guru')->prefix('guru')->group(function () {

        Route::get('/dashboard', [GuruController::class, 'dashboard'])
            ->name('guru.dashboard');

        Route::get('/kelas/{id}/absensi', [GuruController::class, 'absensi'])
            ->name('guru.absensi');

        Route::post('/kelas/{id}/absensi', [GuruController::class, 'simpanAbsensi'])
            ->name('guru.absensi.simpan');
    });
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/users', [UserController::class, 'index'])
    ->name('users.index');

Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
    ->name('admin.dashboard');

Route::post('/admin/guru-kelas', [AdminController::class, 'assignGuruKelas'])
    ->name('admin.guru-kelas');
