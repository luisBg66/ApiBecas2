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

   
    public function index()
    {  
        // $this->authorize('Ver registros');
        $carreras = Carrera::all();
        return CarreraResource::collection($carreras);
    }


    //Funcio crear carrera 
    public function store(StoreCarreraRequest $request)
    {
       // $this->authorize('Crear Rregistro/destruir');
        $carrera = Carrera::create($request->validated());
        return new CarreraResource($carrera);
    }

        //ver registro por id
    public function show(Carrera $carrera)
    {
        //$this->authorize('Ver registros');
        return new CarreraResource($carrera);
    }

     //Actualisar registro
    public function update(UpdateCarreraRequest $request,$id)
    {
        //$this->authorize('Modificar registros');

        $carrera = Carrera::find($id);

        if (!$carrera) {
            return response()->json(['error' => 'Carrera no encontrada'], 404);
        }
    
        $carrera->update($request->validated());
        return new CarreraResource($carrera);
    }

    //Eliminar registro
    public function destroy(Carrera $carrera)
    {   $this->authorize('Crear Rregistro/destruir');
        $carrera->delete();
        return response()->json(['message' => 'Carrera eliminada'], 200);
    }
}
