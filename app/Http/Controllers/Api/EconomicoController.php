<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Requests\StoreEconomicoRequest;
use App\Http\Requests\UpdateEconomicoRequest;
use App\Http\Resources\EconomicoResource;
use App\Models\Economia;
//use Illuminate\Http\Request;

class EconomicoController extends Controller
{
    use AuthorizesRequests;
    //Vista todos los datos
    public function index()
    {   
        $this->authorize('Ver registros');
        $economico = Economia::all();
        return EconomicoResource::collection($economico);
    }

    //Crear un nuevo registro
    public function store(StoreEconomicoRequest $request)
    {   
        $this->authorize('CrearEliminar');
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
        $this->authorize('Ver registros');
        return new EconomicoResource($economico);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEconomicoRequest $request, Economia $economico)
    {   
        $this->authorize('Modificar registros');
        $economico->update($request->validated());
        return new EconomicoResource($economico);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {   
        $this->authorize('CrearEliminar');
        $economia = Economia::findOrFail($id);
        $economia->delete();
        return response()->json(['message' => 'Registro eliminado correctamente']);
    }
}
