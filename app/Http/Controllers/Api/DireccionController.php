<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDireccionRequest;
use App\Http\Requests\UpdateDireccionRequest;
use App\Http\Resources\DireccionResource;
use App\Models\Direccion;
use Illuminate\Http\Request;

class DireccionController extends Controller
{
    //Metodo  de vita de todos los registros
    public function index()
    {
        $direcciones = Direccion::all();
        return DireccionResource::collection($direcciones);
    }
   // Crear un nuevo registro
    public function store(StoreDireccionRequest $request)
    {
        $direccion = Direccion::create($request->validated());
        return response()->json($direccion, 201);
    }

    //ver un registro espesifico
    public function show($id)
    {      
        $direccion = Direccion::findOrFail($id);
        return response()->json($direccion);
        // return new DireccionResource($direccion);
    }

    //actualisr un registro
    public function update(UpdateDireccionRequest $request, string $id)
    {
        $direccion = Direccion::findOrFail($id);
        $direccion->update($request->validated());
        return response()->json($direccion);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Direccion $direccion)
    {
        $direccion->delete();
        return response()->json(['message' => 'Dirección eliminada correctamente.'], 200);
    }
}
