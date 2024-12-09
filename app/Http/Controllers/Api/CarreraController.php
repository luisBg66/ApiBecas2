<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Http\Resources\CarreraResource;

use App\Http\Requests\StoreCarreraRequest;
use App\Http\Requests\UpdateCarreraRequest;
//use App\Http\Resources\CarreraCollection;

use App\Models\Carrera;


class CarreraController extends Controller
{ /**
    * @OA\Info(
    *     title="API de Carreras",
    *     version="1.0.0",
    *     description="API para gestionar las carreras académicas"
    * )
    */
    use AuthorizesRequests;

/**
 * @OA\Get(
 *     path="/api/carreras",
 *     summary="Obtener lista de carreras",
 *     tags={"Carreras"},
 *     @OA\Response(
 *         response=200,
 *         description="Lista de carreras recuperada exitosamente",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="nombre_carrera", type="string", example="Ingeniería en Sistemas")
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=403,
 *         description="No autorizado"
 *     )
 * )
 */

    public function index()
    {  
      //  $this->authorize('Ver registros');
        $carreras = Carrera::all();
        return CarreraResource::collection($carreras);
    }


    //Funcio crear carrera 
    public function store(StoreCarreraRequest $request)
    { /* @OA\Post(
        *     path="/api/carreras",
        *     summary="Crear una nueva carrera",
        *     tags={"Carreras"},
        *     @OA\RequestBody(
        *         required=true,
        *         @OA\JsonContent(
        *             required={"nombre"},
        *             @OA\Property(property="nombre", type="string", example="Ingeniería en Sistemas"),
        *         )
        *     ),
        *     @OA\Response(
        *         response=201,
        *         description="Carrera creada exitosamente"
        *     ),
        *     @OA\Response(
        *         response=403,
        *         description="No autorizado"
        *     )
        * )
        */
        $this->authorize('CrearEliminar');
        $carrera = Carrera::create($request->validated());
        return new CarreraResource($carrera);
    }

        //ver registro por id
    public function show(Carrera $carrera)
    {
        $this->authorize('Ver registros');
        return new CarreraResource($carrera);
    }

     //Actualisar registro
    public function update(UpdateCarreraRequest $request,$id)
    {
        $this->authorize('Modificar registros');

        $carrera = Carrera::find($id);

        if (!$carrera) {
            return response()->json(['error' => 'Carrera no encontrada'], 404);
        }
    
        $carrera->update($request->validated());
        return new CarreraResource($carrera);
    }

    //Eliminar registro
    public function destroy(Carrera $carrera)
    {   $this->authorize('CrearEliminar');
        $carrera->delete();
        return response()->json(['message' => 'Carrera eliminada'], 200);
    }
}
