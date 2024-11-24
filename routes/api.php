<?php

use App\Http\Controllers\Api\CarreraController;
use App\Http\Controllers\Api\DireccionController;
use App\Http\Controllers\Api\DirecionController;
use App\Http\Controllers\Api\EconomicoController;
use App\Http\Controllers\Api\EscolarController;
use App\Http\Controllers\Api\EstudianteController;
use App\Http\Controllers\Api\RequerimientoController;
use App\Http\Controllers\Api\SocialController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
// En routes/api.php
Route::apiResource('estudiantes', EstudianteController::class);//1

// En routes/api.php
Route::apiResource('escolar', EscolarController::class);

// En routes/api.php
Route::apiResource('carreras', CarreraController::class); //1

// En routes/api.php
Route::apiResource('social', SocialController::class);

Route::apiResource('economico', EconomicoController::class);


Route::apiResource('direcciones', DireccionController::class);

Route::get('requerimientos', [RequerimientoController::class, 'index']);


//Route::post('/filtrar-requerimientos', [EstudianteController::class, 'filtrarYAgregarRequerimientos']);
//Route::get('/consultar-requerimientos', [EstudianteController::class, 'consultarRequerimientos']);

Route::get('/requerimientos', [RequerimientoController::class, 'index']);


