<?php

use Illuminate\Support\Facades\Route;
use HRis\PIM\Http\Controllers\EmployeeController;

// guest
Route::group(['middleware' => 'guest:api'], function () {
    //
});

// auth
Route::group(['middleware' => ['auth:api']], function () {
    Route::get('employees', [EmployeeController::class, 'index'])->name('employee.index');
    Route::get('employees/{employee}', [EmployeeController::class, 'show'])->name('employee.show');
    Route::post('employees', [EmployeeController::class, 'store'])->name('employee.store');
    Route::patch('employees/{employee}', [EmployeeController::class, 'update'])->name('employee.update');
    Route::delete('employees/{employee}', [EmployeeController::class, 'destroy'])->name('employee.destroy');
});
