<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/users",
     *     summary="Crear un nuevo usuario",
     *     tags={"Usuarios"},
     *     description="Crea un nuevo usuario y devuelve un token de acceso.",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="name",
     *                 type="string",
     *                 description="Nombre del usuario",
     *                 example="John Doe"
     *             ),
     *             @OA\Property(
     *                 property="email",
     *                 type="string",
     *                 format="email",
     *                 description="Correo electrónico único del usuario",
     *                 example="johndoe@example.com"
     *             ),
     *             @OA\Property(
     *                 property="password",
     *                 type="string",
     *                 format="password",
     *                 description="Contraseña del usuario",
     *                 example="securepassword123"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Usuario creado exitosamente",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="token",
     *                 type="string",
     *                 description="Token de acceso generado para el usuario",
     *                 example="eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9..."
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Datos de entrada inválidos",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example= "The name field is required. (and 2 more errors)"
     *             ),
     *             @OA\Property(
     *                 property="errors",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(
     *                         property="name",
     *                         type="string",
     *                         example= "The name field is required"
     *                     ),
     *                     @OA\Property(
     *                         property="email",
     *                         type="string",
     *                         example= "The email field is required"
     *                     ),
     *                     @OA\Property(
     *                         property="password",
     *                         type="string",
     *                         example= "The email field is required"
     *                     )
     *                 )
     *             )
     *         )
     *     )
     * )
     */

    public function createUser(UserRequest $request)
    {
        $user = User::create($request->all());
        $token = $user->createToken("TOKEN_NAME")->plainTextToken;

        return response()->json(["token" => $token], 201);
    }
}
