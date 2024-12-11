<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller

{
  
    /**
 * @OA\Post(
 *     path="/api/login",
 *     summary="Iniciar sesión de usuario",
 *     description="Autenticar usuario y obtener token de acceso",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"email","password"},
 *             @OA\Property(property="email", type="string", format="email", example="milly12@asmin.com"),
 *             @OA\Property(property="password", type="string", format="password", example="password")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Inicio de sesión exitoso",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Inicio de sesión exitoso"),
 *             @OA\Property(property="access_token", type="string", example="eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9..."),
 *             @OA\Property(property="token_type", type="string", example="Bearer"),
 *             @OA\Property(
 *                 property="user",
 *                 type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="nombre", type="string", example="Milly"),
 *                 @OA\Property(property="apellido_paterno", type="string", example="castañeda"),
 *                 @OA\Property(property="apellido_materno", type="string", example="Alcantar"),
 *                 @OA\Property(property="rango", type="string", example="Presisndete"),
 *                 @OA\Property(property="email", type="string", example="milly12@asmin.com")
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Credenciales incorrectas",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Credenciales incorrectas")
 *         )
 *     )
 * )
 */



    public function login(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Buscar el usuario por email
        $user = User::where('email', $request->email)->first();

        // Verificar si las credenciales son correctas
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Credenciales incorrectas'
            ], 401);
        }

       // Generar un token para el usuario
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Inicio de sesión exitoso',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user
        ]);
    }

    /**
     * Logout del usuario.
     */
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Sesión cerrada correctamente'
        ]);
    }

    /**
     * Obtener los datos del usuario autenticado.
     */
    public function userProfile(Request $request)
    {
        return response()->json([
            'user' => $request->user()
        ]);
    }


}
