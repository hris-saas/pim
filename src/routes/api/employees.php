<?php

use Illuminate\Support\Facades\Route;
use HRis\PIM\Http\Controllers\Employee\JobController;
use HRis\PIM\Http\Controllers\Employee\AddressController;
use HRis\PIM\Http\Controllers\Employee\CompensationController;
use HRis\PIM\Http\Controllers\Employee\EmergencyContactController;
use HRis\PIM\Http\Controllers\Employee\EmploymentStatusController;
use HRis\PIM\Http\Controllers\Employee\Controller as EmployeeController;

// guest
Route::group(['middleware' => 'guest:api'], function () {
    //
});

// auth
Route::group(['middleware' => ['auth:api'], 'prefix' => 'employees'], function () {
    
    // api/employees
    Route::get('', [EmployeeController::class, 'index'])->name('employee.index');                                                                            // postman
    Route::get('{employee}', [EmployeeController::class, 'show'])->name('employee.show');                                                                    // postman
    Route::post('', [EmployeeController::class, 'store'])->name('employee.store');                                                                           // postman
    Route::patch('{employee}', [EmployeeController::class, 'update'])->name('employee.update');                                                              // postman
    Route::delete('{employee}', [EmployeeController::class, 'destroy'])->name('employee.destroy');                                                           // postman

    Route::group(['prefix' => '{employee}', 'as' => 'employee.'], function () {

        // api/employees/{employee}/addresses
        Route::get('addresses', [AddressController::class, 'index'])->name('address.index');                                                                 // postman
        Route::get('addresses/{address:id}', [AddressController::class, 'show'])->name('address.show');                                                      // postman
        Route::post('addresses', [AddressController::class, 'store'])->name('address.store');                                                                // postman
        Route::patch('addresses/{address:id}', [AddressController::class, 'update'])->name('address.update');                                                // postman
        Route::delete('addresses/{address:id}', [AddressController::class, 'destroy'])->name('address.destroy');                                             // postman
        
        // api/employees/{employee}/employment-statuses
        Route::get('employment-statuses', [EmploymentStatusController::class, 'index'])->name('employment-status.index');                                    // postman
        Route::get('employment-statuses/{employmentStatus:id}', [EmploymentStatusController::class, 'show'])->name('employment-status.show');                // postman
        Route::post('employment-statuses', [EmploymentStatusController::class, 'store'])->name('employment-status.store');                                   // postman
        Route::patch('employment-statuses/{employmentStatus:id}', [EmploymentStatusController::class, 'update'])->name('employment-status.update');          // postman
        Route::delete('employment-statuses/{employmentStatus:id}', [EmploymentStatusController::class, 'destroy'])->name('employment-status.destroy');       // postman

        // api/employees/{employee}/jobs
        Route::get('jobs', [JobController::class, 'index'])->name('job.index');                                                                              // postman
        Route::get('jobs/{job:id}', [JobController::class, 'show'])->name('job.show');                                                                       // postman
        Route::post('jobs', [JobController::class, 'store'])->name('job.store');                                                                             // postman
        Route::patch('jobs/{job:id}', [JobController::class, 'update'])->name('job.update');                                                                 // postman
        Route::delete('jobs/{job:id}', [JobController::class, 'destroy'])->name('job.destroy');                                                              // postman

        // api/employees/{employee}/emergency-contacts
        Route::get('emergency-contacts', [EmergencyContactController::class, 'index'])->name('emergency-contact.index');                                     // postman
        Route::get('emergency-contacts/{emergencyContact:id}', [EmergencyContactController::class, 'show'])->name('emergency-contact.show');                 // postman
        Route::post('emergency-contacts', [EmergencyContactController::class, 'store'])->name('emergency-contact.store');                                    // postman
        Route::patch('emergency-contacts/{emergencyContact:id}', [EmergencyContactController::class, 'update'])->name('emergency-contact.update');           // postman
        Route::delete('emergency-contacts/{emergencyContact:id}', [EmergencyContactController::class, 'destroy'])->name('emergency-contact.destroy');        // postman

        // api/employees/{employee}/compensations
        Route::get('compensations', [CompensationController::class, 'index'])->name('compensation.index');                                                    // postman
        Route::get('compensations/{compensation:id}', [CompensationController::class, 'show'])->name('compensation.show');                                    // postman
        Route::post('compensations', [CompensationController::class, 'store'])->name('compensation.store');                                                   // postman
        Route::patch('compensations/{compensation:id}', [CompensationController::class, 'update'])->name('compensation.update');                              // postman
        Route::delete('compensations/{compensation:id}', [CompensationController::class, 'destroy'])->name('compensation.destroy');                           // postman
    });
});
