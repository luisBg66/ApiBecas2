<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEconomicoRequest;
use App\Http\Requests\UpdateEconomicoRequest;
use App\Http\Resources\EconomicoResource;
use App\Models\Economia;
//use Illuminate\Http\Request;

class EconomicoController extends Controller
{
    //Vista todos los datos
    public function index()
    {
        $economico = Economia::all();
        return EconomicoResource::collection($economico);
    }

    //Crear un nuevo registro
    public function store(StoreEconomicoRequest $request)
    {
        $economia = Economia::create($request->validated());
        return response()->json($economia, 201);
       return new EconomicoResource($economia);
        // return new CarreraResource($carrera);
    }

    /**
     * Display the specified resource.
     */
    public function show(Economia $economico)
    {
        return new EconomicoResource($economico);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEconomicoRequest $request, Economia $economico)
    {
        $economico->update($request->validated());
        return new EconomicoResource($economico);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $economia = Economia::findOrFail($id);
        $economia->delete();
        return response()->json(['message' => 'Registro eliminado correctamente']);
    }
}
