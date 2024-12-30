<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', fn () => Inertia::render('Dashboard'))
        ->middleware('verified')
        ->name('dashboard');

    Route::group([
        'controller' => \App\Http\Controllers\AppController::class,
        'middleware' => 'verified',
    ], function () {
        Route::get('/about', 'about')->name('about');
    });

    Route::group([
        'controller' => ProfileController::class,
        'as' => 'profile.',
        'middleware' => 'verified',
    ], function () {
        Route::get('/profile', 'edit')->name('edit');
        Route::patch('/profile/update', 'update')->name('update');
        Route::delete('/profile', 'destroy')->name('destroy');
    });
});

require __DIR__.'/auth.php';
require __DIR__.'/entity.php';
