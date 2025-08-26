<?php

use App\Http\Controllers\Api\LocationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', function() {return redirect()->route('locations.index');});

Route::resource('locations', LocationController::class);
