<?php

use App\Http\Controllers\Entity\EntityAssignmentController;
use App\Http\Controllers\Entity\EntityController;
use App\Http\Controllers\Entity\NewEntityController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => ['auth:web', 'verified'],
    'prefix' => 'entity',
    'as' => 'entity.',
], function () {
    Route::group([
        'controller' => NewEntityController::class,
    ], function () {
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
    });

    Route::group([
        'controller' => EntityController::class,
    ], function () {
        Route::get('edit', 'edit')->name('edit');
        Route::patch('update', 'update')->name('update');
        Route::patch('switch/{entity}', 'switch')->name('switch');
    });

    Route::group([
        'controller' => EntityAssignmentController::class,
    ], function () {
        Route::get('assign', 'create')->name('assign');
    });
});
