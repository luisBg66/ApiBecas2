<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{


    /**
     * Mostrar todos los usuarios.
     */
    public function index()
    {
        $usuarios = User::all();
        return response()->json($usuarios, 200);
    }

    /**
     * Mostrar un usuario específico.
     */
    public function show($id)
    {
        $usuario = User::find($id);

        if (!$usuario) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        return response()->json($usuario, 200);
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido_paterno' => 'required|string|max:255',
            'apellido_materno' => 'nullable|string|max:255',
            'rango' => 'required|string|max:255',
            'email' => 'required|email|unique:usuarios',
            'password' => 'required|string|min:6',
        ]);

        $usuario = User::create([
            'nombre' => $validated['nombre'],
            'apellido_paterno' => $validated['apellido_paterno'],
            'apellido_materno' => $validated['apellido_materno'],
            'rango' => $validated['rango'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        return response()->json(['message' => 'Usuario creado correctamente', 'usuario' => $usuario], 201);
    }

    /**
     * Actualizar un usuario existente.
     */
    public function update(Request $request, $id)
    {
        $usuario = User::find($id);

        if (!$usuario) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        $validated = $request->validate([
            'nombre' => 'sometimes|required|string|max:255',
            'apellido_paterno' => 'sometimes|required|string|max:255',
            'apellido_materno' => 'nullable|string|max:255',
            'rango' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:usuarios,email,' . $id,
            'password' => 'nullable|string|min:6',
        ]);

        $usuario->update([
            'nombre' => $validated['nombre'] ?? $usuario->nombre,
            'apellido_paterno' => $validated['apellido_paterno'] ?? $usuario->apellido_paterno,
            'apellido_materno' => $validated['apellido_materno'] ?? $usuario->apellido_materno,
            'rango' => $validated['rango'] ?? $usuario->rango,
            'email' => $validated['email'] ?? $usuario->email,
            'password' => isset($validated['password']) ? Hash::make($validated['password']) : $usuario->password,
        ]);

        return response()->json(['message' => 'Usuario actualizado correctamente', 'usuario' => $usuario], 200);
    }

    /**
     * Eliminar un usuario.
     */
    public function destroy($id)
    {
        $usuario = User::find($id);

        if (!$usuario) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        $usuario->delete();
        return response()->json(['message' => 'Usuario eliminado correctamente'], 200);
    }
}


