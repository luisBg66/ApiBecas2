<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDireccionRequest;
use App\Http\Requests\UpdateDireccionRequest;
use App\Http\Resources\DireccionResource;
use App\Models\Direccion;
use Illuminate\Http\Request;

class DirecionController extends Controller
{
    //Direcion vista tods los registros 
    public function index()
    {
        $direcciones = Direccion::all();
        return DireccionResource::collection($direcciones);
    }

    //metod de creacion de una nueva direcion
    public function store(StoreDireccionRequest $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDireccionRequest $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $direccion = Direccion::findOrFail($id);
        $direccion->delete();
        return response()->json(['message' => 'Dirección eliminada correctamente']);
    }
}
