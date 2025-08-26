<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocationController;

// Rota principal - redireciona para lista de locais
Route::get('/', function () {
    return redirect()->route('locations.index');
});

// Rotas de recursos para locations (CRUD completo)
Route::resource('locations', LocationController::class);