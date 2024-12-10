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
{

 
 
    use AuthorizesRequests;
    /**
 * @OA\Info(
 *     title="Carreras",
 *     version="1.0.0"
 * ),
 * @OA\PathItem(
 *     path="/api/carreras"
 * )
 
   
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
 * @OA\Post(
 *     path="/api/carreras",
 *     summary="Crear una nueva carrera",
 *     tags={"Carreras"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"nombre_carrera"},
 *             @OA\Property(property="nombre_carrera", type="string", example="Ingeniería en Sistemas")
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Carrera creada exitosamente",
 *         @OA\JsonContent(
 *             @OA\Property(property="id", type="integer", example=1),
 *             @OA\Property(property="nombre_carrera", type="string", example="Ingeniería en Sistemas")
 *         )
 *     ),
 *     @OA\Response(
 *         response=403,
 *         description="No autorizado"
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Error de validación"
 *     )
 * )
 */
    public function index()
    {  

      //  $this->authorize('Ver registros');
        $carreras = Carrera::all();
        return CarreraResource::collection($carreras);
    }


    
    public function store(StoreCarreraRequest $request)
    { 
        $this->authorize('CrearEliminar');
        $carrera = Carrera::create($request->validated());
        return new CarreraResource($carrera);
    }
    /**
 * @OA\Get(
 *     path="/api/carreras/{id}",
 *     summary="Obtener una carrera específica",
 *     tags={"Carreras"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID de la carrera",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Carrera encontrada exitosamente",
 *         @OA\JsonContent(
 *             @OA\Property(property="id", type="integer", example=1),
 *             @OA\Property(property="nombre_carrera", type="string", example="Ingeniería en Sistemas")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Carrera no encontrada"
 *     )
 * )
 */

        //ver registro por id
    public function show(Carrera $carrera)
    {
        $this->authorize('Ver registros');
        return new CarreraResource($carrera);
    }

     /**
 * @OA\Put(
 *     path="/api/carreras/{id}",
 *     summary="Actualizar una carrera existente",
 *     tags={"Carreras"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID de la carrera a actualizar",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"nombre_carrera"},
 *             @OA\Property(property="nombre_carrera", type="string", example="Ingeniería en Software")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Carrera actualizada exitosamente"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Carrera no encontrada"
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Error de validación"
 *     )
 * )
 */
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
/**
 * @OA\Delete(
 *     path="/api/carreras/{id}",
 *     summary="Eliminar una carrera",
 *     tags={"Carreras"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID de la carrera a eliminar",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Carrera eliminada exitosamente"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Carrera no encontrada"
 *     ),
 *     @OA\Response(
 *         response=403,
 *         description="No autorizado"
 *     )
 * )
 */
    //Eliminar registro
    public function destroy(Carrera $carrera)
    {   $this->authorize('CrearEliminar');
        $carrera->delete();
        return response()->json(['message' => 'Carrera eliminada'], 200);
    }
}
