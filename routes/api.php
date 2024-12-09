<?php

use App\Http\Controllers\Api\CarreraController;
use App\Http\Controllers\Api\DireccionController;
use App\Http\Controllers\Api\DirecionController;
use App\Http\Controllers\Api\EconomicoController;
use App\Http\Controllers\Api\EscolarController;
use App\Http\Controllers\Api\EstudianteController;
use App\Http\Controllers\Api\RequerimientoController;
use App\Http\Controllers\Api\SocialController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->group(function(){

// En routes/api.php
Route::apiResource('carreras', CarreraController::class); //1

// En routes/api.php
Route::apiResource('estudiantes', EstudianteController::class);//1

// En routes/api.php
Route::apiResource('escolar', EscolarController::class);

//
Route::apiResource('direcciones', DireccionController::class);
// En routes/api.php
Route::apiResource('social', SocialController::class);

Route::apiResource('economico', EconomicoController::class);




Route::get('requerimientos', [RequerimientoController::class, 'index']);


//Route::post('/filtrar-requerimientos', [EstudianteController::class, 'filtrarYAgregarRequerimientos']);
//Route::get('/consultar-requerimientos', [EstudianteController::class, 'consultarRequerimientos']);



//Route::get('Selecion', [EstudianteController::class, 'index_selecion']);



Route::get('/users', [UsuarioController::class, 'index']);         // Mostrar todos los usuarios
Route::get('/users/{id}', [UsuarioController::class, 'show']);     // Mostrar un usuario por ID
Route::post('/users', [UsuarioController::class, 'store']);        // Crear un nuevo usuario
Route::post('/users/{id}/assign-role', [UsuarioController::class, 'assignRole']); // Asignar un rol a un usuario






Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
Route::middleware('auth:sanctum')->get('/user-profile', [AuthController::class, 'userProfile']);

});
Route::post('/login', [AuthController::class, 'login']);
