<?php

use Illuminate\Support\Facades\Route;
use HRis\Core\Http\Controllers\StatusController;
use HRis\PIM\Http\Controllers\EmployeeFieldController;

// guest
Route::group(['middleware' => 'guest:api'], function () {
    //
});

// auth
Route::group(['middleware' => ['auth:api']], function () {

    // api/departments
    Route::get('departments', [EmployeeFieldController::class, 'index'])->name('department.index');                                                          // postman
    Route::get('departments/{department}', [EmployeeFieldController::class, 'show'])->name('department.show');                                               // postman
    Route::post('departments', [EmployeeFieldController::class, 'store'])->name('department.store');                                                         // postman
    Route::patch('departments/{department}', [EmployeeFieldController::class, 'update'])->name('department.update');                                         // postman
    Route::delete('departments/{department}', [EmployeeFieldController::class, 'destroy'])->name('department.destroy');                                      // postman
    Route::patch('departments/{department}/restore', [EmployeeFieldController::class, 'restore'])->name('department.restore');                               // postman

    // api/locations
    Route::get('locations', [EmployeeFieldController::class, 'index'])->name('location.index');                                                              // postman
    Route::get('locations/{location}', [EmployeeFieldController::class, 'show'])->name('location.show');                                                     // postman
    Route::post('locations', [EmployeeFieldController::class, 'store'])->name('location.store');                                                             // postman
    Route::patch('locations/{location}', [EmployeeFieldController::class, 'update'])->name('location.update');                                               // postman
    Route::delete('locations/{location}', [EmployeeFieldController::class, 'destroy'])->name('location.destroy');                                            // postman
    Route::patch('locations/{location}/restore', [EmployeeFieldController::class, 'restore'])->name('location.restore');                                     // postman

    // api/employment-statuses
    Route::get('employment-statuses', [StatusController::class, 'index'])->name('employment-status.index');                                                  // postman
    Route::get('employment-statuses/{employmentStatus}', [StatusController::class, 'show'])->name('employment-status.show');                                 // postman
    Route::post('employment-statuses', [StatusController::class, 'store'])->name('employment-status.store');                                                 // postman
    Route::patch('employment-statuses/{employmentStatus}', [StatusController::class, 'update'])->name('employment-status.update');                           // postman
    Route::delete('employment-statuses/{employmentStatus}', [StatusController::class, 'destroy'])->name('employment-status.destroy');                        // postman
    Route::patch('employment-statuses/{employmentStatus}/restore', [StatusController::class, 'restore'])->name('employment-status.restore');                 // postman

    // api/job-titles
    Route::get('job-titles', [EmployeeFieldController::class, 'index'])->name('job-title.index');                                                            // postman
    Route::get('job-titles/{jobTitle}', [EmployeeFieldController::class, 'show'])->name('job-title.show');                                                   // postman
    Route::post('job-titles', [EmployeeFieldController::class, 'store'])->name('job-title.store');                                                           // postman
    Route::patch('job-titles/{jobTitle}', [EmployeeFieldController::class, 'update'])->name('job-title.update');                                             // postman
    Route::delete('job-titles/{jobTitle}', [EmployeeFieldController::class, 'destroy'])->name('job-title.destroy');                                          // postman
    Route::patch('job-titles/{jobTitle}/restore', [EmployeeFieldController::class, 'restore'])->name('job-title.restore');                                   // postman

    // api/marital-statuses
    Route::get('marital-statuses', [StatusController::class, 'index'])->name('marital-status.index');                                                        // postman
    Route::get('marital-statuses/{maritalStatus}', [StatusController::class, 'show'])->name('marital-status.show');                                          // postman
    Route::post('marital-statuses', [StatusController::class, 'store'])->name('marital-status.store');                                                       // postman
    Route::patch('marital-statuses/{maritalStatus}', [StatusController::class, 'update'])->name('marital-status.update');                                    // postman
    Route::delete('marital-statuses/{maritalStatus}', [StatusController::class, 'destroy'])->name('marital-status.destroy');                                 // postman
    Route::patch('marital-statuses/{maritalStatus}/restore', [StatusController::class, 'restore'])->name('marital-status.restore');                          // postman

    // api/termination-reasons
    Route::get('termination-reasons', [EmployeeFieldController::class, 'index'])->name('termination-reason.index');                                          // postman
    Route::get('termination-reasons/{terminationReason}', [EmployeeFieldController::class, 'show'])->name('termination-reason.show');                        // postman
    Route::post('termination-reasons', [EmployeeFieldController::class, 'store'])->name('termination-reason.store');                                         // postman
    Route::patch('termination-reasons/{terminationReason}', [EmployeeFieldController::class, 'update'])->name('termination-reason.update');                  // postman
    Route::delete('termination-reasons/{terminationReason}', [EmployeeFieldController::class, 'destroy'])->name('termination-reason.destroy');               // postman
    Route::patch('termination-reasons/{terminationReason}/restore', [EmployeeFieldController::class, 'restore'])->name('termination-reason.restore');        // postman

    // api/divisions
    Route::get('divisions', [EmployeeFieldController::class, 'index'])->name('division.index');                                                              // postman
    Route::get('divisions/{division}', [EmployeeFieldController::class, 'show'])->name('division.show');                                                     // postman
    Route::post('divisions', [EmployeeFieldController::class, 'store'])->name('division.store');                                                             // postman
    Route::patch('divisions/{division}', [EmployeeFieldController::class, 'update'])->name('division.update');                                               // postman
    Route::delete('divisions/{division}', [EmployeeFieldController::class, 'destroy'])->name('division.destroy');                                            // postman
    Route::patch('divisions/{division}/restore', [EmployeeFieldController::class, 'restore'])->name('division.restore');                                     // postman

    // api/pay-periods
    Route::get('pay-periods', [EmployeeFieldController::class, 'index'])->name('pay-period.index');                                                          // postman
    Route::get('pay-periods/{payPeriod}', [EmployeeFieldController::class, 'show'])->name('pay-period.show');                                                // postman
    Route::post('pay-periods', [EmployeeFieldController::class, 'store'])->name('pay-period.store');                                                         // postman
    Route::patch('pay-periods/{payPeriod}', [EmployeeFieldController::class, 'update'])->name('pay-period.update');                                          // postman
    Route::delete('pay-periods/{payPeriod}', [EmployeeFieldController::class, 'destroy'])->name('pay-period.destroy');                                       // postman
    Route::patch('pay-periods/{payPeriod}/restore', [EmployeeFieldController::class, 'restore'])->name('pay-period.restore');                                // postman

    // api/pay-types
    Route::get('pay-types', [EmployeeFieldController::class, 'index'])->name('pay-type.index');                                                              // postman
    Route::get('pay-types/{payType}', [EmployeeFieldController::class, 'show'])->name('pay-type.show');                                                      // postman
    Route::post('pay-types', [EmployeeFieldController::class, 'store'])->name('pay-type.store');                                                             // postman
    Route::patch('pay-types/{payType}', [EmployeeFieldController::class, 'update'])->name('pay-type.update');                                                // postman
    Route::delete('pay-types/{payType}', [EmployeeFieldController::class, 'destroy'])->name('pay-type.destroy');                                             // postman
    Route::patch('pay-types/{payType}/restore', [EmployeeFieldController::class, 'restore'])->name('pay-type.resetore');                                    // postman

    // api/relationships
    Route::get('relationships', [EmployeeFieldController::class, 'index'])->name('relationship.index');                                                      // postman
    Route::get('relationships/{relationship}', [EmployeeFieldController::class, 'show'])->name('relationship.show');                                         // postman
    Route::post('relationships', [EmployeeFieldController::class, 'store'])->name('relationship.store');                                                     // postman
    Route::patch('relationships/{relationship}', [EmployeeFieldController::class, 'update'])->name('relationship.update');                                   // postman
    Route::delete('relationships/{relationship}', [EmployeeFieldController::class, 'destroy'])->name('relationship.destroy');                                // postman
    Route::patch('relationships/{relationship}/restore', [EmployeeFieldController::class, 'restore'])->name('relationship.restore');                         // postman
});
