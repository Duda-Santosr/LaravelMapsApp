<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LocationController;

// Rotas da API para locations (CRUD JSON)
Route::apiResource('locations', LocationController::class);