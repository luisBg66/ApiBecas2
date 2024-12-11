<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Requests\StoreEscolarRequest;
use App\Http\Requests\UpdateEscolarRequest;
use App\Http\Resources\EscolarResource;
use App\Models\Escolar;
use Illuminate\Http\Request;

class EscolarController extends Controller
{

/**
 * @OA\Get(
 *     path="/api/escolar",
 *     summary="Obtener lista de registros escolares",
 *     tags={"Escolar"},
 *    security={{"sanctum":{}}},
 *     @OA\Response(
 *         response=200,
 *         description="Lista de registros escolares recuperada exitosamente",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="id_estudiante", type="integer", example=1),
 *                 @OA\Property(property="promedio", type="number", format="float", example=85.5),
 *                 @OA\Property(property="materias_reprobadas", type="boolean", example=false)
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=403,
 *         description="No autorizado - Requiere permiso 'CrearEliminar'"
 *     )
 * )
 */
    use AuthorizesRequests;
    //Vista todos los registros
    public function index()
    {   
        $this->authorize('CrearEliminar');
        $escolar=Escolar::all();
        return EscolarResource::collection($escolar);
    }
/**
 * @OA\Post(
 *     path="/api/escolar",
 *     summary="Crear un nuevo registro escolar",
 *     tags={"Escolar"},
 *    security={{"sanctum":{}}},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"id_estudiante", "promedio"},
 *             @OA\Property(property="id_estudiante", type="integer", example=1),
 *             @OA\Property(property="promedio", type="number", format="float", example=85.5),
 *             @OA\Property(property="materia_en_repeticion", type="boolean", example=false)
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Registro escolar creado exitosamente",
 *         @OA\JsonContent(
 *             @OA\Property(property="id", type="integer", example=1),
 *             @OA\Property(property="id_estudiante", type="integer", example=1),
 *             @OA\Property(property="promedio", type="number", format="float", example=85.5),
 *             @OA\Property(property="materias_reprobadas", type="boolean", example=false)
 *         )
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
    //Crear un nuevo registro
    public function store(Request $request)
    {
       //$escolar= Escolar::created($request->validate());
      // return new EscolarResource($escolar);
      $this->authorize('Modificar registros');
      $request->validate([
        'id_estudiante' => 'required|exists:estudiantes,id',
        'promedio' => 'required|numeric|between:0,100',
        'materia_en_repeticion' => 'boolean',
    ]);

    $escolar = Escolar::create($request->all());
    return response()->json($escolar, 201);

    }
/**
 * @OA\Get(
 *     path="/api/escolar/{id}",
 *     summary="Obtener un registro escolar específico",
 *     tags={"Escolar"},
 *    security={{"sanctum":{}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID del registro escolar",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Registro escolar encontrado exitosamente",
 *         @OA\JsonContent(
 *             @OA\Property(property="id", type="integer", example=1),
 *             @OA\Property(property="id_estudiante", type="integer", example=1),
 *             @OA\Property(property="promedio", type="number", format="float", example=85.5),
 *             @OA\Property(property="materias_reprobadas", type="boolean", example=false)
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
    public function show(Escolar $escolar)
    {
        $this->authorize('Modificar registros');
        return new EscolarResource($escolar);
    }

    /**
 * @OA\Put(
 *     path="/api/escolar/{id}",
 *     summary="Actualizar un registro escolar existente",
 *     tags={"Escolar"},
 *    security={{"sanctum":{}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID del registro escolar a actualizar",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="promedio", type="number", format="float", example=90.0),
 *             @OA\Property(property="materia_en_repeticion", type="boolean", example=true)
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Registro escolar actualizado exitosamente",
 *         @OA\JsonContent(
 *             @OA\Property(property="id", type="integer", example=1),
 *             @OA\Property(property="id_estudiante", type="integer", example=1),
 *             @OA\Property(property="promedio", type="number", format="float", example=90.0),
 *             @OA\Property(property="materias_reprobadas", type="boolean", example=true)
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Registro no encontrado"
 *     ),
 *     @OA\Response(
 *         response=403,
 *         description="No autorizado - Requiere permiso 'Ver registros'"
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Error de validación"
 *     )
 * )
 */
    public function update(UpdateEscolarRequest $request, $id)
    {
        $this->authorize('Ver registros');
        $escolar = Escolar::findOrFail($id);
        $escolar->update($request->validated());
        return response()->json($escolar);

    
    }
/**
 * @OA\Delete(
 *     path="/api/escolar/{id}",
 *     summary="Eliminar un registro escolar",
 *     tags={"Escolar"},
 *    security={{"sanctum":{}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID del registro escolar a eliminar",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Registro eliminado exitosamente",
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
        $this->authorize('CrearEliminar');
        $escolar = Escolar::findOrFail($id);
        $escolar->delete();
        return response()->json(['message' => 'Registro eliminado correctamente']);
    }
}
