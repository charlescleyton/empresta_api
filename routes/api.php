<?php

use App\Http\Controllers\SimulationController;
use Illuminate\Support\Facades\Route;

Route::get('/instituicoes', [SimulationController::class, 'getInstituicoes']);
Route::get('/convenios', [SimulationController::class, 'getConvenios']);
Route::post('/simular', [SimulationController::class, 'simulate']);
