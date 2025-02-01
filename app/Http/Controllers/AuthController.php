<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistroRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function register (RegistroRequest $request) {

        try {
            // Validar el registro
            $data = $request->validated();

            // Crear usuario
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password'])
            ]);

            // Generar Token
            $token = $user->createToken('token')->plainTextToken;

            // Retornar respuesta JSON
            return response()->json([
                'success' => true,
                'message' => 'Usuario creado con éxito',
                'data' => [
                    'token' => $token,
                    'user' => $user
                ],
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error registering user',
                'error' => $e->getMessage()
            ], 500);
        }



    }

    public function login(LoginRequest $request) {
        try {
            $data = $request->validated();

            // Revisar el password
            if (!Auth::attempt($data)) {
                return response()->json([
                    'errors' => ['El email o el password son incorrectos']
                ], 422);
            }

            // authenticate user
            $user = Auth::user();

            // Generar Token
            $token = $user->createToken('token')->plainTextToken;

            // Retornar respuesta JSON
            return response()->json([
                'success' => true,
                'message' => 'Usuario creado con éxito',
                'data' => [
                    'token' => $token,
                    'user' => $user
                ],
            ], 201);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error logging in user',
                'error' => $e->getMessage()
            ]);
        }
    }
    
    public function logout(Request $request) {
        $user = $request->user();
        $user->currentAccessToken()->delete();

        return [
            'user' => null,
        ];
    }
    
}
