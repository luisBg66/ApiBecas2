<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
//use App\Http\Requests\StoreEscolarRequest;
use App\Http\Requests\UpdateEscolarRequest;
use App\Http\Resources\EscolarResource;
use App\Models\Escolar;
use Illuminate\Http\Request;

class EscolarController extends Controller
{
    //Vista todos los registros
    public function index()
    {
        $escolar=Escolar::all();
        return EscolarResource::collection($escolar);
    }

    //Crear un nuevo registro
    public function store(Request $request)
    {
       //$escolar= Escolar::created($request->validate());
      // return new EscolarResource($escolar);

      $request->validate([
        'id_estudiante' => 'required|exists:estudiantes,id',
        'promedio' => 'required|numeric|between:0,100',
        'materia_en_repeticion' => 'boolean',
    ]);

    $escolar = Escolar::create($request->all());
    return response()->json($escolar, 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(Escolar $escolar)
    {
      // $escolar = $escolar = load('permission:Ver registros');
        return new EscolarResource($escolar);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEscolarRequest $request, $id)
    {
   
        $escolar = Escolar::findOrFail($id);
        $escolar->update($request->validated());
        return response()->json($escolar);

    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $escolar = Escolar::findOrFail($id);
        $escolar->delete();
        return response()->json(['message' => 'Registro eliminado correctamente']);
    }
}
