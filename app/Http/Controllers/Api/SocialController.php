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
{  
    use AuthorizesRequests;
        /**
    * @OA\Info(
    *     title="API de Social",
    *     version="1.0.0",
    *     description="API para gestionar información de estudiantes"
    * )
    */
    /**
 * @OA\Get(
 *     path="/api/social",
 *     summary="Obtener lista de registros sociales",
 *     tags={"Social"},
 *     security={{"bearerAuth":{}}},
 *     @OA\Response(
 *         response=200,
 *         description="Lista de registros sociales recuperada exitosamente",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="id_estudiante", type="integer", example=1),
 *                 @OA\Property(property="integrantes_familia", type="integer", example=4)
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=403,
 *         description="No autorizado - Requiere permiso 'Modificar registros'"
 *     )
 * )
 */

    public function index()
    {   
        $this->authorize('Modificar registros');
        $socials = Social::all();
        return SocialResource::collection($socials);
    }
/**
 * @OA\Post(
 *     path="/api/social",
 *     summary="Crear un nuevo registro social",
 *     tags={"Social"},
 *     security={{"bearerAuth":{}}},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="id_estudiante", type="integer", example=1),
 *             @OA\Property(property="integrantes_familia", type="integer", example=4)
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Registro social creado exitosamente",
 *         @OA\JsonContent(
 *             @OA\Property(property="id", type="integer", example=1),
 *             @OA\Property(property="id_estudiante", type="integer", example=1),
 *             @OA\Property(property="integrantes_familia", type="integer", example=4)
 *         )
 *     ),
 *     @OA\Response(
 *         response=403,
 *         description="No autorizado - Requiere permiso 'CrearEliminar'"
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Error de validación"
 *     )
 * )
 */
   public function store(StoreSociaRequest $request)
    {
        $this->authorize('CrearEliminar');
       $request = Social::create($request->validated());
        return new SocialResource($request);
    }

 /**
 * @OA\Get(
 *     path="/api/social/{id}",
 *     summary="Obtener un registro social específico",
 *     tags={"Social"},
 *     security={{"bearerAuth":{}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID del registro social",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Registro social encontrado exitosamente",
 *         @OA\JsonContent(
 *             @OA\Property(property="id", type="integer", example=1),
 *             @OA\Property(property="id_estudiante", type="integer", example=1),
 *             @OA\Property(property="integrantes_familia", type="integer", example=4)
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Registro no encontrado"
 *     ),
 *     @OA\Response(
 *         response=403,
 *         description="No autorizado - Requiere permiso 'Modificar registros'"
 *     )
 * )
 */
    public function show(Social $social)
    {
        $this->authorize('Modificar registros');
        return new SocialResource($social);
    }
/**
 * @OA\Put(
 *     path="/api/social/{id}",
 *     summary="Actualizar un registro social existente",
 *     tags={"Social"},
 *     security={{"bearerAuth":{}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID del registro social a actualizar",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="integrantes_familia", type="integer", example=5)
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Registro social actualizado exitosamente",
 *         @OA\JsonContent(
 *             @OA\Property(property="id", type="integer", example=1),
 *             @OA\Property(property="id_estudiante", type="integer", example=1),
 *             @OA\Property(property="integrantes_familia", type="integer", example=5)
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Registro no encontrado"
 *     ),
 *     @OA\Response(
 *         response=403,
 *         description="No autorizado - Requiere permiso 'Modificar registros'"
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Error de validación"
 *     )
 * )
 */
    public function update(UpdateSocialRequest $request, Social $social)
    {   
        $this->authorize('Modificar registros');
        $social->update($request->validated());
        return new SocialResource($social);

    }

/**
 * @OA\Delete(
 *     path="/api/social/{id}",
 *     summary="Eliminar un registro social",
 *     tags={"Social"},
 *     security={{"bearerAuth":{}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID del registro social a eliminar",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Registro social eliminado exitosamente",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Registro eliminado correctamente")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Registro no encontrado"
 *     ),
 *     @OA\Response(
 *         response=403,
 *         description="No autorizado - Requiere permiso 'CrearEliminar'"
 *     )
 * )
 */
    public function destroy(string $id)
    {   
        
        $social = Social::findOrFail($id);
        $social->delete();
        return response()->json(['message' => 'Registro eliminado correctamente']);
    
    }
}
