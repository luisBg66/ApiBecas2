<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSociaRequest;
use App\Http\Requests\UpdateEscolarRequest;
use App\Http\Resources\EscolarResource;
use App\Models\Escolar;
use Illuminate\Http\Request;

class EscolarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $escolar=Escolar::all();
        return EscolarResource::collection($escolar);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSociaRequest $request )
    {
        $escolar= Escolar::created($request->validate());
        return new EscolarResource($escolar);


    }

    /**
     * Display the specified resource.
     */
    public function show(Escolar $escolar)
    {
        return new EscolarResource($escolar);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEscolarRequest $request, Escolar $escolar )
    {
   
        $escolar->update($request->validated());
        return new EscolarResource($escolar);

    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
