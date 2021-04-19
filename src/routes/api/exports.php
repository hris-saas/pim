<?php

use Illuminate\Support\Facades\Route;
use HRis\PIM\Http\Controllers\ExportController;

// auth
Route::group(['middleware' => ['auth:api'], 'prefix' => 'export'], function () {
    Route::get('employees', [ExportController::class, 'export'])->name('export.employees');     // postman
});
