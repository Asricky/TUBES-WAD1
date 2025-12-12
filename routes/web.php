<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\JadwalController as UserJadwalController;
use App\Http\Controllers\User\RiwayatController as UserRiwayatController;
use App\Http\Controllers\User\BookingController as UserBookingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/pelanggan/home', function () {
    return view('pelanggan.home');
})->middleware(['auth'])->name('pelanggan.home');

// Profile routes (accessible by all authenticated users)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ADMIN ROUTES
Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    // Client management
    Route::resource('clients', ClientController::class);
    
    // Schedule management
    Route::resource('schedules', ScheduleController::class);
    
    // Session management
    Route::resource('sessions', SessionController::class);
    
    // Topic management
    Route::resource('topics', TopicController::class);
    
});

// USER (MAHASISWA) ROUTES
Route::middleware(['auth', 'pelanggan'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
    Route::get('/jadwal', [UserJadwalController::class, 'index'])->name('jadwal');
    Route::get('/riwayat', [UserRiwayatController::class, 'index'])->name('riwayat');
    Route::get('/riwayat/{session}', [UserRiwayatController::class, 'show'])->name('riwayat.show');
    Route::get('/booking/{schedule}', [UserBookingController::class, 'create'])->name('booking.create');
    Route::post('/booking/{schedule}', [UserBookingController::class, 'store'])->name('booking.store');
    Route::post('/booking/{session}/cancel', [UserBookingController::class, 'cancel'])->name('booking.cancel');
});
//ROUTE PELANGGAN
Route::middleware(['auth', 'pelanggan'])->group(function () {
    Route::get('/dashboard/pelanggan', [PelangganController::class, 'index'])->name('pelanggan.dashboard');
    Route::get('/status-konsultasi', [PelangganController::class, 'status'])->name('pelanggan.status');
    Route::get('/jadwal-konsultasi', [PelangganController::class, 'jadwal'])->name('pelanggan.jadwal');
});

require __DIR__.'/auth.php';
