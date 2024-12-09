<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Requests\StoreEscolarRequest;
use App\Http\Requests\UpdateEscolarRequest;
use App\Http\Resources\EscolarResource;
use App\Models\Escolar;
use Illuminate\Http\Request;

class EscolarController extends Controller
{
    use AuthorizesRequests;
    //Vista todos los registros
    public function index()
    {   
        $this->authorize('CrearEliminar');
        $escolar=Escolar::all();
        return EscolarResource::collection($escolar);
    }

    //Crear un nuevo registro
    public function store(Request $request)
    {
       //$escolar= Escolar::created($request->validate());
      // return new EscolarResource($escolar);
      $this->authorize('Modificar registros');
      $request->validate([
        'id_estudiante' => 'required|exists:estudiantes,id',
        'promedio' => 'required|numeric|between:0,100',
        'materia_en_repeticion' => 'boolean',
    ]);

    $escolar = Escolar::create($request->all());
    return response()->json($escolar, 201);

    }

    //
    public function show(Escolar $escolar)
    {
        $this->authorize('Modificar registros');
        return new EscolarResource($escolar);
    }

    
    public function update(UpdateEscolarRequest $request, $id)
    {
        $this->authorize('Ver registros');
        $escolar = Escolar::findOrFail($id);
        $escolar->update($request->validated());
        return response()->json($escolar);

    
    }

    
    public function destroy(string $id)
    {   
        $this->authorize('CrearEliminar');
        $escolar = Escolar::findOrFail($id);
        $escolar->delete();
        return response()->json(['message' => 'Registro eliminado correctamente']);
    }
}
