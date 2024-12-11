<?php

namespace App\Http\Controllers;

/**
 * 
 * @OA\Info(
 *     title="Documentación para API REST de Recetas",
 *     version="1.0.0",
 *     @OA\Contact(
 *        email="eescobar@cdhidalgo.tecnm.mx"
 *    )
 * )
 * 
 * @OA\Server(
 *    url="http://localhost:8000"
 * )
 *
 * @OA\SecurityScheme(
 *     type="apiKey",
 *     in="header",
 *     securityScheme="sanctum",
 *     name="Authorization",
 *     description="Sanctum API token. Ejemplo: 'Bearer {token}'",
 * )
 */



abstract class Controller
{
    //
}
