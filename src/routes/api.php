<?php

use Illuminate\Support\Facades\Route;

// guest
Route::group(['middleware' => 'guest:api'], function () {
    //
});

// auth
Route::group(['middleware' => ['auth:api']], function () {
    //
});

// include employee fields
include(__DIR__.'/employee-fields.php');
