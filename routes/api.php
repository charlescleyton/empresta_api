<?php

use App\Http\Controllers\SimulationController;
use Illuminate\Support\Facades\Route;

Route::get('/instituicoes', [SimulationController::class, 'getInstitutions']);
Route::get('/convenios', [SimulationController::class, 'getAgreements']);
Route::post('/simular', [SimulationController::class, 'simulate']);
