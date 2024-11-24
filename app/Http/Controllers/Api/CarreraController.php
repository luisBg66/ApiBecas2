<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCarreraRequest;
use App\Http\Requests\UpdateCarreraRequest;
use App\Http\Resources\CarreraCollection;
use App\Http\Resources\CarreraResource;
use App\Models\Carrera;
use Illuminate\Http\Request;

class CarreraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carreras = Carrera::all();
        return CarreraResource::collection($carreras);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCarreraRequest $request)
    {
        $carrera = Carrera::create($request->validated());
        return new CarreraResource($carrera);
    }

    /**
     * Display the specified resource.
     */
    public function show(Carrera $carrera)
    {
   

        return new CarreraResource($carrera);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCarreraRequest $request,$id)
    {
        $carrera = Carrera::find($id);

        if (!$carrera) {
            return response()->json(['error' => 'Carrera no encontrada'], 404);
        }
    
        $carrera->update($request->validated());
        return new CarreraResource($carrera);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Carrera $carrera)
    {
        $carrera->delete();
        return response()->json(['message' => 'Carrera eliminada'], 200);
    }
}
