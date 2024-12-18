<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\StylistsController;
use App\Http\Controllers\ReviewsController;
use App\Http\Controllers\AppointmentsController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\SuggestionsController;
use App\Http\Controllers\UserServiceController;
use App\Http\Controllers\UserStylistsController;
use App\Http\Controllers\UserSuggestionsController;
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
    Route::resource('dashboard', AdminDashboardController::class)->names('admin.dashboard');

    Route::resource('services', ServicesController::class)->names('admin.services');

    Route::resource('stylists', StylistsController::class)->names('admin.stylists');

    Route::resource('reviews', ReviewsController::class)->names('admin.reviews');

    Route::resource('suggestions', SuggestionsController::class)->names('admin.suggestions');
    
    Route::resource('reports', ReportsController::class)->names('admin.reports');

    Route::get('/search/reports/', [ReportsController::class, 'search'])->name('admin.reports.search');
    Route::get('/search/suggestion/', [SuggestionsController::class, 'search'])->name('admin.suggestions.search');
});

Route::prefix('user')->middleware(['role:user'])->group( function () {
    Route::get('/home', function () {
        return view('user.home');
    })->name('user.home');

    Route::resource('services', UserServiceController::class)->names('user.services');

    Route::resource('stylists', UserStylistsController::class)->names('user.stylists');
    
    Route::resource('appointment', AppointmentsController::class)->names('user.appointment');

    Route::resource('suggestions', UserSuggestionsController::class)->names('user.suggestions');
});


require __DIR__.'/auth.php';
