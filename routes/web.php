<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuruController;

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
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');

        Route::get('/users', [UserController::class, 'index'])
            ->name('admin.users');
    });

    Route::middleware('role:petugas')->prefix('petugas')->group(function () {
        Route::get('dashboard', function () {
            return view('petugas.dashboard');
        })->name('petugas.dashboard');
    });
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/users', [UserController::class, 'index'])
    ->name('users.index');

Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
    ->name('admin.dashboard');

Route::get('/guru/dashboard', [AdminController::class, 'dashboard'])
    ->name('guru.dashboard');