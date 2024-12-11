<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Requests\StoreEstudianteRequest;
//use App\Http\Requests\StoreEstudianteRequest;
use App\Http\Requests\UpdateEstudianteRequest;
use App\Http\Resources\EstudianteResource;
use App\Models\Estudiante;
use App\Models\Requeremientos;
use Illuminate\Http\Request;

class EstudianteController extends Controller
{
    use AuthorizesRequests;


/**
 * @OA\Get(
 *     path="/api/estudiantes",
 *     summary="Obtener lista de estudiantes",
 *     tags={"Estudiantes"},
 *     security={{"bearerAuth":{}}},
 *     @OA\Response(
 *         response=200,
 *         description="Lista de estudiantes recuperada exitosamente",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="numero_control", type="string", example="19141142"),
 *                 @OA\Property(property="nombre", type="string", example="Juan"),
 *                 @OA\Property(property="apellido_paterno", type="string", example="Pérez"),
 *                 @OA\Property(property="apellido_materno", type="string", example="García"),
 *                 @OA\Property(property="id_carrera", type="integer", example=1),
 *                 @OA\Property(property="carrera", type="string", example="Ingeniería en Sistemas"),
 *                 @OA\Property(property="correo", type="string", example="juan.perez@ejemplo.com")
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=403,
 *         description="No autorizado - Requiere permiso 'Ver registros'"
 *     )
 * )
 */
    public function index()
    {   
        $this->authorize('Ver registros');
        $estudiante = Estudiante::all();
        return EstudianteResource::collection($estudiante);
        
    }

/**
 * @OA\Post(
 *     path="/api/estudiantes",
 *     summary="Crear un nuevo estudiante",
 *     tags={"Estudiantes"},
 *     security={{"bearerAuth":{}}},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="numero_control", type="string", example="19141142"),
 *             @OA\Property(property="nombre", type="string", example="Juan"),
 *             @OA\Property(property="apellido_paterno", type="string", example="Pérez"),
 *             @OA\Property(property="apellido_materno", type="string", example="García"),
 *             @OA\Property(property="id_carrera", type="integer", example=1),
 *             @OA\Property(property="correo", type="string", example="juan.perez@ejemplo.com")
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Estudiante creado exitosamente",
 *         @OA\JsonContent(
 *             @OA\Property(property="id", type="integer", example=1),
 *             @OA\Property(property="numero_control", type="string", example="19141142"),
 *             @OA\Property(property="nombre", type="string", example="Juan"),
 *             @OA\Property(property="apellido_paterno", type="string", example="Pérez"),
 *             @OA\Property(property="apellido_materno", type="string", example="García"),
 *             @OA\Property(property="id_carrera", type="integer", example=1),
 *             @OA\Property(property="correo", type="string", example="juan.perez@ejemplo.com")
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
    public function store(StoreEstudianteRequest $request)
    {      
        $this->authorize('CrearEliminar');
      /*  $validatedData = $request->validate([
            'numero_control' => 'required|string|unique:estudiantes,numero_control',
            'nombre' => 'required|string|max:255',
            'apellido_paterno' => 'nullable|string|max:255',
            'apellido_materno' => 'required|string|max:255',
            'id_carrera' => 'required|exists:carreras,id',
            'correo' => 'required|email|unique:estudiantes,correo',
        ]);

        $estudiante = Estudiante::create($validatedData);

        return response()->json($estudiante, 201);*/

      $estudiante = Estudiante::create($request->validated());
      return response()->json($estudiante, 201);
    }

  /**
 * @OA\Get(
 *     path="/api/estudiantes/{id}",
 *     summary="Obtener un estudiante específico",
 *     tags={"Estudiantes"},
 *     security={{"bearerAuth":{}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID del estudiante",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Estudiante encontrado exitosamente",
 *         @OA\JsonContent(
 *             @OA\Property(property="id", type="integer", example=1),
 *             @OA\Property(property="numero_control", type="string", example="19141142"),
 *             @OA\Property(property="nombre", type="string", example="Juan"),
 *             @OA\Property(property="apellido_paterno", type="string", example="Pérez"),
 *             @OA\Property(property="apellido_materno", type="string", example="García"),
 *             @OA\Property(property="id_carrera", type="integer", example=1),
 *             @OA\Property(property="carrera", type="string", example="Ingeniería en Sistemas"),
 *             @OA\Property(property="correo", type="string", example="juan.perez@ejemplo.com")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Estudiante no encontrado"
 *     ),
 *     @OA\Response(
 *         response=403,
 *         description="No autorizado - Requiere permiso 'Ver registros'"
 *     )
 * )
 */
    public function show(Estudiante $estudiante)
    {
        $this->authorize('Ver registros');   
        return new EstudianteResource($estudiante);
    }

    /**
 * @OA\Put(
 *     path="/api/estudiantes/{id}",
 *     summary="Actualizar un estudiante existente",
 *     tags={"Estudiantes"},
 *     security={{"bearerAuth":{}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID del estudiante a actualizar",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="nombre", type="string", example="Juan Carlos"),
 *             @OA\Property(property="apellido_paterno", type="string", example="Pérez"),
 *             @OA\Property(property="apellido_materno", type="string", example="García"),
 *             @OA\Property(property="id_carrera", type="integer", example=2),
 *             @OA\Property(property="correo", type="string", example="juan.perez.nuevo@ejemplo.com")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Estudiante actualizado exitosamente",
 *         @OA\JsonContent(
 *             @OA\Property(property="id", type="integer", example=1),
 *             @OA\Property(property="numero_control", type="string", example="19141142"),
 *             @OA\Property(property="nombre", type="string", example="Juan Carlos"),
 *             @OA\Property(property="apellido_paterno", type="string", example="Pérez"),
 *             @OA\Property(property="apellido_materno", type="string", example="García"),
 *             @OA\Property(property="id_carrera", type="integer", example=2),
 *             @OA\Property(property="correo", type="string", example="juan.perez.nuevo@ejemplo.com")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Estudiante no encontrado"
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
    public function update(UpdateEstudianteRequest $request,  $id)
    {
        $this->authorize('Modificar registros');
       // $estudiante = Estudiante::findOrFail($id);
        //$estudiante->update($request->validated());
        //return response()->json($estudiante);

       // $estudiante->update($request->validated());
       // return new EstudianteResource($estudiante);


        $estudiante= Estudiante::find($id);

        if (!$estudiante) {
            return response()->json(['error' => 'Carrera estudiante no encontrado'], 404);
        }
    
        $estudiante->update($request->validated());
        return new EstudianteResource($estudiante);
        
    }
/**
 * @OA\Delete(
 *     path="/api/estudiantes/{id}",
 *     summary="Eliminar un estudiante",
 *     tags={"Estudiantes"},
 *     security={{"bearerAuth":{}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID del estudiante a eliminar",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Estudiante eliminado exitosamente",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Estudiante eliminado correctamente.")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Estudiante no encontrado"
 *     ),
 *     @OA\Response(
 *         response=403,
 *         description="No autorizado - Requiere permiso 'CrearEliminar'"
 *     )
 * )
 */
    public function destroy(Estudiante $estudiante)
    {
        $this->authorize('CrearEliminar');
        $estudiante->delete();
        return response()->json(['message' => 'Estudiante eliminado correctamente.'], 200);
    }



public function index_selecion()
{
    //$this->authorize('Ver registros');
    // Consultar los estudiantes y sus datos relacionados
    $resultados = DB::table('estudiantes')
        ->join('carreras', 'estudiantes.id_carrera', '=', 'carreras.id')
        ->join('direcciones', 'estudiantes.id', '=', 'direcciones.id_estudiante')
        ->join('economia', 'estudiantes.id', '=', 'economia.id_estudiante')
        ->join('social', 'estudiantes.id', '=', 'social.id_estudiante')
        ->join('escolar', 'estudiantes.id', '=', 'escolar.id_estudiante')
        ->where('escolar.materia_en_repeticion', '=', 0) // Excluir materias en repetición
        ->where('escolar.promedio', '>', 8.5) // Filtrar por promedio
        ->orderBy('economia.ingresos', 'asc') // Ordenar por ingresos
        ->select(
            'estudiantes.id AS id_estudiante',
            'estudiantes.numero_control',
            'estudiantes.nombre',
            'estudiantes.apellido_paterno',
            'estudiantes.apellido_materno',
            'estudiantes.correo',
            'carreras.nombre_carrera',
            'direcciones.municipio',
            'direcciones.colonia',
            'direcciones.calle',
            'direcciones.numero',
            'economia.ingresos',
            'social.integrantes_familia',
            'escolar.promedio',
            'escolar.materia_en_repeticion'
        )
        ->get();

    // Insertar los datos en la tabla requerimientos
    foreach ($resultados as $estudiante) {
        DB::table('requerimientos')->insert([
            'id_estudiante' => $estudiante->id_estudiante,
            'nombre_requerimiento' => "Estudiante con ID {$estudiante->id_estudiante}",
            'materia_en_repeticion' => $estudiante->materia_en_repeticion,
            'promedio' => $estudiante->promedio,
            'ingresos' => $estudiante->ingresos,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    // Retornar los resultados en formato JSON
    return response()->json($resultados);
}

    
}
