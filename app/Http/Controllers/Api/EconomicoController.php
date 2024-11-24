<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateEconomicoRequest;
use App\Http\Resources\EconomicoResource;
use App\Models\Economia;
use Illuminate\Http\Request;

class EconomicoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $economico = Economia::all();
        return EconomicoResource::collection($economico);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $economico=Economia::created($request->validated());
        return EconomicoResource::collection($economico);
       
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
        //
    }
}
