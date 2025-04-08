<?php

namespace App\Http\Controllers\Auth\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Api\LoginRequest;
use App\Http\Requests\Auth\Api\RegisterUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        // VERIFICAR CORREO Y CONTRASEÑA
        if( !Auth::attempt($credentials) )
        {
            return response()->json([
                "message" => "Credenciales incorrectas"
            ], 401);
        }

        $user = User::find( Auth::user()["id"] );

        $token = $user->createToken("token")->plainTextToken;

        return response()->json([
            "message" => "Usuario autenticado",
            "user" => $user,
            "token" => $token
        ]);

    }

    public function logout(Request $request)
    {
        $user = $request->user();

        $user->currentAccessToken()->delete();

        return response()->json([
            "message" => "Sesión cerrada"
        ]);
    }

    public function validateToken()
    {
        
    }

    public function register(RegisterUserRequest $request)
    {
        $user = $request->validated();

        $password = Hash::make( $user['password']);
        $user['password'] = $password;

        $newUser = User::create($user);

        return response()->json([
            "message" => "Usuario registrado",
            "user" => $newUser
        ]);

    }
}
