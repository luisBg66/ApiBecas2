<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Http\Resources\DireccionResource;

use App\Http\Requests\StoreDireccionRequest;
use App\Http\Requests\UpdateDireccionRequest;

use App\Models\Direccion;


class DireccionController extends Controller
{
    use AuthorizesRequests;
    //Metodo  de vita de todos los registros
    public function index()
    {
        $this->authorize('Ver registros');
        $direcciones = Direccion::with('estudiante:id,nombre,apellido_paterno,apellido_materno')->get();
        return response()->json($direcciones);
       // $direcciones = Direccion::all();
       // return DireccionResource::collection($direcciones);
    }
   // Crear un nuevo registro
    public function store(StoreDireccionRequest $request)
    {   
        $this->authorize('CrearEliminar');
        $direccion = Direccion::create($request->validated());
        return response()->json($direccion, 201);
    }

    //ver un registro espesifico
    public function show($id)
    {    $this->authorize('Ver registros');   
        $direccion = Direccion::findOrFail($id);
        return response()->json($direccion);
        // return new DireccionResource($direccion);
    }

    //actualisr un registro
    public function update(UpdateDireccionRequest $request, string $id)
    {
        $this->authorize('Modificar registros');
        $direccion = Direccion::findOrFail($id);
        $direccion->update($request->validated());
        return response()->json($direccion);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Direccion $direccion)
    {   
        $this->authorize('CrearEliminar');
        $direccion->delete();
        return response()->json(['message' => 'Dirección eliminada correctamente.'], 200);
    }
}
