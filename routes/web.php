<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\StylistsController;
use App\Http\Controllers\ReviewsController;
use App\Http\Controllers\AppointmentsController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\UserServiceController;
use App\Http\Controllers\UserStylistsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/PageNotFound', function () {
    return view('PageNotFount');
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
    Route::get('/dashboard', function () {
        return view('admin.adminDashboard');
    })->name('admin.dashboard');

    Route::resource('services', ServicesController::class)->names('admin.services');

    Route::resource('stylists', StylistsController::class)->names('admin.stylists');

    Route::resource('reviews', ReviewsController::class)->names('admin.reviews');
    
    Route::resource('reports', ReportsController::class)->names('admin.reports');
});

Route::prefix('user')->middleware(['role:user'])->group( function () {
    Route::get('/home', function () {
        return view('user.home');
    })->name('user.home');

    Route::resource('services', UserServiceController::class)->names('user.services');

    Route::resource('stylists', UserStylistsController::class)->names('user.stylists');
    
    Route::resource('appointment', AppointmentsController::class)->names('user.appointment');

    Route::get('/suggestion', function () {
        return view('user.suggestion');
    })->name('user.suggestion');
});


require __DIR__.'/auth.php';
