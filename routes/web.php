<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin')->middleware(['role:admin'])->group( function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.adminDashboard');
    })->name('admin.dashboard');
    Route::get('/admin/services', function () {
        return view('admin.addServices');
    })->name('admin.service');
    Route::get('/admin/stylist', function () {
        return view('admin.addStylists');
    })->name('admin.stylist');
    Route::get('/admin/review', function () {
        return view('admin.reviews');
    })->name('admin.review');
    Route::get('/admin/report', function () {
        return view('admin.report');
    })->name('admin.report');
});

Route::middleware(['role:user'])->group( function () {
    Route::get('/Home', function () {
        return view('user.home');
    })->name('user.home');
    Route::get('/Service', function () {
        return view('user.services');
    })->name('user.service');
    Route::get('/Stylist', function () {
        return view('user.stylist');
    })->name('user.stylist');
    Route::get('/Appointment', function () {
        return view('user.appointment');
    })->name('user.appointment');
    Route::get('/Suggestion', function () {
        return view('user.suggestion');
    })->name('user.suggestion');
});


require __DIR__.'/auth.php';
