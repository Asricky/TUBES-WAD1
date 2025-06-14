<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\AttachmentController;
use App\Http\Controllers\PelangganController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.register');
});
Route::get('/pelanggan/home', function () {
    return view('pelanggan.home');
})->middleware(['auth'])->name('pelanggan.home');

//ROUTE ADMIN
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Client routes
    Route::resource('clients', ClientController::class);
    
    // Schedule routes
    Route::resource('schedules', ScheduleController::class);
    
    // Session routes
    Route::resource('sessions', SessionController::class);
    
    // Topic routes
    Route::resource('topics', TopicController::class);
    
    // Attachment routes
    Route::resource('attachments', AttachmentController::class);
});
//ROUTE PELANGGAN
Route::middleware(['auth', 'pelanggan'])->group(function () {
    Route::get('/dashboard/pelanggan', [PelangganController::class, 'index'])->name('pelanggan.dashboard');
    Route::get('/status-konsultasi', [PelangganController::class, 'status'])->name('pelanggan.status');
    Route::get('/jadwal-konsultasi', [PelangganController::class, 'jadwal'])->name('pelanggan.jadwal');
});

require __DIR__.'/auth.php';
