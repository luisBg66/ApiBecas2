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

/**
 * @OA\SecurityScheme(
 *     securityScheme="bearerAuth",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT"
 * )
 */

/**
 * @OA\Get(
 *     path="/api/direcciones",
 *     summary="Obtener lista de direcciones",
 *     tags={"Direcciones"},
 * security={{"bearerAuth":{}}},
 *     @OA\Response(
 *         response=200,
 *         description="Lista de direcciones recuperada exitosamente",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/DireccionResource")
 *         )
 *     ),
 *     @OA\Response(
 *         response=403,
 *         description="No autorizado"
 *     )
 * )
 */

    public function index()
    {
        $this->authorize('Ver registros');
        $direcciones = Direccion::with('estudiante:id,nombre,apellido_paterno,apellido_materno')->get();
        return response()->json($direcciones);
       // $direcciones = Direccion::all();
       // return DireccionResource::collection($direcciones);
    }
    /**
 * @OA\Post(
 *     path="/api/direcciones",
 *     summary="Crear una nueva dirección",
 *     tags={"Direcciones"},
 * security={{"bearer_token":{}}},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"id_estudiante", "municipio", "colonia", "calle", "numero"},
 *             @OA\Property(property="id_estudiante", type="integer", example=1),
 *             @OA\Property(property="municipio", type="string", example="Guadalajara"),
 *             @OA\Property(property="colonia", type="string", example="Centro"),
 *             @OA\Property(property="calle", type="string", example="Av. Principal"),
 *             @OA\Property(property="numero", type="integer", example=123)
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Dirección creada exitosamente",
 *         @OA\JsonContent(ref="#/components/schemas/DireccionResource")
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Error de validación"
 *     ),
 *     @OA\Response(
 *         response=403,
 *         description="No autorizado"
 *     )
 * )
 */
   // Crear un nuevo registro
    public function store(StoreDireccionRequest $request)
    {   
        $this->authorize('CrearEliminar');
        $direccion = Direccion::create($request->validated());
        return response()->json($direccion, 201);
    }
/**
 * @OA\Get(
 *     path="/api/direcciones/{id}",
 *     summary="Obtener una dirección específica",
 *     tags={"Direcciones"},
 * security={{"bearerAuth":{}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID de la dirección",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Dirección encontrada exitosamente",
 *         @OA\JsonContent(ref="#/components/schemas/DireccionResource")
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Dirección no encontrada"
 *     ),
 *     @OA\Response(
 *         response=403,
 *         description="No autorizado"
 *     )
 * )
 */

    //ver un registro espesifico
    public function show($id)
    {    $this->authorize('Ver registros');   
        $direccion = Direccion::findOrFail($id);
        return response()->json($direccion);
      
    }
/**
 * @OA\Put(
 *     path="/api/direcciones/{id}",
 *     summary="Actualizar una dirección existente",
 *     tags={"Direcciones"},
 * security={{"bearerAuth":{}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID de la dirección a actualizar",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="id_estudiante", type="integer", example=1),
 *             @OA\Property(property="municipio", type="string", example="Guadalajara"),
 *             @OA\Property(property="colonia", type="string", example="Centro"),
 *             @OA\Property(property="calle", type="string", example="Av. Principal"),
 *             @OA\Property(property="numero", type="integer", example=123)
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Dirección actualizada exitosamente",
 *         @OA\JsonContent(ref="#/components/schemas/DireccionResource")
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Dirección no encontrada"
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Error de validación"
 *     ),
 *     @OA\Response(
 *         response=403,
 *         description="No autorizado"
 *     )
 * )
 */

    //actualisr un registro
    public function update(UpdateDireccionRequest $request, string $id)
    {
        $this->authorize('Modificar registros');
        $direccion = Direccion::findOrFail($id);
        $direccion->update($request->validated());
        return response()->json($direccion);
    }
/**
 * @OA\Delete(
 *     path="/api/direcciones/{id}",
 *     summary="Eliminar una dirección",
 *     tags={"Direcciones"},
 * security={{"bearerAuth":{}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID de la dirección a eliminar",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Dirección eliminada exitosamente",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Dirección eliminada correctamente.")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Dirección no encontrada"
 *     ),
 *     @OA\Response(
 *         response=403,
 *         description="No autorizado"
 *     )
 * )
 */
/**
 * @OA\Schema(
 *     schema="DireccionResource",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="id_estudiante", type="integer", example=1),
 *     @OA\Property(property="municipio", type="string", example="Guadalajara"),
 *     @OA\Property(property="colonia", type="string", example="Centro"),
 *     @OA\Property(property="calle", type="string", example="Av. Principal"),
 *     @OA\Property(property="numero", type="integer", example=123)
 * )
 */
    public function destroy(Direccion $direccion)
    {   
        $this->authorize('CrearEliminar');
        $direccion->delete();
        return response()->json(['message' => 'Dirección eliminada correctamente.'], 200);
    }


}
