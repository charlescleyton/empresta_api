<?php

use App\Http\Controllers\SimulationController;
use Illuminate\Support\Facades\Route;

Route::get('/instituicoes', [SimulationController::class, 'getInstitutions']);
