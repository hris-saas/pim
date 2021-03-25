<?php

use Illuminate\Support\Facades\Route;
use HRis\PIM\Http\Controllers\StatusController;

// guest
Route::group(['middleware' => 'guest:api'], function () {
    //
});

// auth
Route::group(['middleware' => ['auth:api']], function () {

    // api/statuses
    Route::get('statuses', [StatusController::class, 'index'])->name('status.index');                                                                        // postman
    Route::get('statuses/{status}', [StatusController::class, 'show'])->name('status.show');                                                                 // postman
    Route::post('statuses', [StatusController::class, 'store'])->name('status.store');                                                                       // postman
    Route::patch('statuses/{status}', [StatusController::class, 'update'])->name('status.update');                                                           // postman
    Route::delete('statuses/{status}', [StatusController::class, 'destroy'])->name('status.destroy');                                                        // postman
    Route::patch('statuses/{status}/restore', [StatusController::class, 'restore'])->name('status.restore');                                                 // postman

    // api/employment-statuses
    Route::get('employment-statuses', [StatusController::class, 'index'])->name('employment-status.index');                                                  // postman
    Route::get('employment-statuses/{employmentStatus}', [StatusController::class, 'show'])->name('employment-status.show');                                 // postman
    Route::post('employment-statuses', [StatusController::class, 'store'])->name('employment-status.store');                                                 // postman
    Route::patch('employment-statuses/{employmentStatus}', [StatusController::class, 'update'])->name('employment-status.update');                           // postman
    Route::delete('employment-statuses/{employmentStatus}', [StatusController::class, 'destroy'])->name('employment-status.destroy');                        // postman
    Route::patch('employment-statuses/{employmentStatus}/restore', [StatusController::class, 'restore'])->name('employment-status.restore');                 // postman

    // api/marital-statuses
    Route::get('marital-statuses', [StatusController::class, 'index'])->name('marital-status.index');                                                        // postman
    Route::get('marital-statuses/{maritalStatus}', [StatusController::class, 'show'])->name('marital-status.show');                                          // postman
    Route::post('marital-statuses', [StatusController::class, 'store'])->name('marital-status.store');                                                       // postman
    Route::patch('marital-statuses/{maritalStatus}', [StatusController::class, 'update'])->name('marital-status.update');                                    // postman
    Route::delete('marital-statuses/{maritalStatus}', [StatusController::class, 'destroy'])->name('marital-status.destroy');                                 // postman
    Route::patch('marital-statuses/{maritalStatus}/restore', [StatusController::class, 'restore'])->name('marital-status.restore');                          // postman
});
