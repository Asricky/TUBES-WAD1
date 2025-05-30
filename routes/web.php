<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\AttachmentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.register');
});

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
require __DIR__.'/auth.php';