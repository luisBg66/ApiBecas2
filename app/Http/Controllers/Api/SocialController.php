<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Requests\StoreSociaRequest;
use App\Http\Requests\UpdateSocialRequest;
use App\Http\Resources\SocialResource;
use App\Models\Social;
//use Illuminate\Http\Request;

class SocialController extends Controller
{    /*
     @OA\Get(
     *     path="/api/escolar",
     *     summary="Obtener todas las escolaridades",
     *     @OA\Response(
     *         response=200,
     *         description="Lista de escolaridades",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Escolar"))
    */
    use AuthorizesRequests;
    public function index()
    {   
        $this->authorize('Modificar registros');
        $socials = Social::all();
        return SocialResource::collection($socials);
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(StoreSociaRequest $request)
    {
        $this->authorize('CrearEliminar');
       $request = Social::create($request->validated());
        return new SocialResource($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Social $social)
    {
        $this->authorize('Modificar registros');
        return new SocialResource($social);
    }

    public function update(UpdateSocialRequest $request, Social $social)
    {   
        $this->authorize('Modificar registros');
        $social->update($request->validated());
        return new SocialResource($social);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {   
        
        $social = Social::findOrFail($id);
        $social->delete();
        return response()->json(['message' => 'Registro eliminado correctamente']);
    
    }
}
