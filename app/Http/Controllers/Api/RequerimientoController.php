<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Estudiante;
use App\Models\Requeremientos;
use Illuminate\Http\Request;

class RequerimientoController extends Controller
{
    use AuthorizesRequests;
    public function index()
    {
       
    $this->authorize('Ver registros');
    $requerimientos = Requeremientos::all(); // Obtiene todos los registros
    return response()->json($requerimientos, 200); // Devuelve la respuesta en JSON con código HTTP 200


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function consultarRequerimientos()
    {
        $requerimientos = \App\Models\Requeremientos::with('estudiante')->get();
    
        return response()->json([
            'data' => $requerimientos,
        ]);
    }
    
}

