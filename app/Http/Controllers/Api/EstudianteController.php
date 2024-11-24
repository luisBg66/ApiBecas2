<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEstudianteRequest;
use App\Http\Requests\UpdateEstudianteRequest;
use App\Http\Resources\EstudianteResource;
use App\Models\Estudiante;
use App\Models\Requeremientos;
use Illuminate\Http\Request;

class EstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $estudiante = Estudiante::all();
        return EstudianteResource::collection($estudiante);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEstudianteRequest $request)
    {
        $estudiante = Estudiante::create($request->validated());
        return new EstudianteResource($estudiante);
    }

    /**
     * Display the specified resource.
     */
    public function show(Estudiante $estudiante)
    {
        return new EstudianteResource($estudiante);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEstudianteRequest $request,  $id)
    {
        $estudiante= Estudiante::find($id);

        if (!$estudiante) {
            return response()->json(['error' => 'Carrera estudiante no encontrado'], 404);
        }
    
        $estudiante->update($request->validated());
        return new EstudianteResource($estudiante);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Estudiante $estudiante)
    {
        $estudiante->delete();
        return response()->json(['message' => 'Estudiante eliminado correctamente.'], 200);
    }


    
    
}
