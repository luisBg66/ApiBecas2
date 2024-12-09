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
/**
 * @OA\Info(
 *     title="API Documentation",
 *     version="1.0.0",
 * )
 */

class CarreraController extends Controller
{
    use AuthorizesRequests;
    /**
     * @OA\Get(
     *     path="/api/example",
     *     summary="Obtiene una lista de ejemplos",
     *     @OA\Response(
     *         response=200,
     *         description="Lista de ejemplos"
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
    {
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
