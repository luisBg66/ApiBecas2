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
    /**
 * @OA\Info(
 *     title="API de Economía",
 *     version="1.0.0",
 *     description="API para gestionar la información económica de estudiantes"
 * )
 */
/**
 * @OA\Get(
 *     path="/api/economico",
 *     summary="Obtener lista de registros económicos",
 *     tags={"Economía"},
 *     security={{"bearerAuth":{}}},
 *     @OA\Response(
 *         response=200,
 *         description="Lista de registros económicos recuperada exitosamente",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="id_estudiante", type="integer", example=1),
 *                 @OA\Property(property="ingresos", type="number", format="float", example=5000.00)
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=403,
 *         description="No autorizado - Requiere permiso 'Ver registros'"
 *     )
 * )
 */
    //Vista todos los datos
    public function index()
    {   
        $this->authorize('Ver registros');
        $economico = Economia::all();
        return EconomicoResource::collection($economico);
    }
/**
 * @OA\Post(
 *     path="/api/economico",
 *     summary="Crear un nuevo registro económico",
 *     tags={"Economía"},
 *     security={{"bearerAuth":{}}},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"id_estudiante"},
 *             @OA\Property(property="id_estudiante", type="integer", example=1),
 *             @OA\Property(property="ingresos", type="number", format="float", example=5000.00)
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Registro económico creado exitosamente",
 *         @OA\JsonContent(
 *             @OA\Property(property="id", type="integer", example=1),
 *             @OA\Property(property="id_estudiante", type="integer", example=1),
 *             @OA\Property(property="ingresos", type="number", format="float", example=5000.00)
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
 * @OA\Get(
 *     path="/api/economico/{id}",
 *     summary="Obtener un registro económico específico",
 *     tags={"Economía"},
 *     security={{"bearerAuth":{}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID del registro económico",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Registro económico encontrado exitosamente",
 *         @OA\JsonContent(
 *             @OA\Property(property="id", type="integer", example=1),
 *             @OA\Property(property="id_estudiante", type="integer", example=1),
 *             @OA\Property(property="ingresos", type="number", format="float", example=5000.00)
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Registro no encontrado"
 *     ),
 *     @OA\Response(
 *         response=403,
 *         description="No autorizado - Requiere permiso 'Ver registros'"
 *     )
 * )
 */
 
    public function show(Economia $economico)
    {   
        $this->authorize('Ver registros');
        return new EconomicoResource($economico);
    }

   /**
 * @OA\Put(
 *     path="/api/economico/{id}",
 *     summary="Actualizar un registro económico existente",
 *     tags={"Economía"},
 *     security={{"bearerAuth":{}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID del registro económico a actualizar",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="ingresos", type="number", format="float", example=6000.00)
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Registro económico actualizado exitosamente",
 *         @OA\JsonContent(
 *             @OA\Property(property="id", type="integer", example=1),
 *             @OA\Property(property="id_estudiante", type="integer", example=1),
 *             @OA\Property(property="ingresos", type="number", format="float", example=6000.00)
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
    public function update(UpdateEconomicoRequest $request, Economia $economico)
    {   
        $this->authorize('Modificar registros');
        $economico->update($request->validated());
        return new EconomicoResource($economico);
    }

/**
 * @OA\Delete(
 *     path="/api/economico/{id}",
 *     summary="Eliminar un registro económico",
 *     tags={"Economía"},
 *     security={{"bearerAuth":{}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID del registro económico a eliminar",
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
        $economia = Economia::findOrFail($id);
        $economia->delete();
        return response()->json(['message' => 'Registro eliminado correctamente']);
    }
}
