<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Http\Request;
use App\Repositories\AuthRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AuthLoginRequest;

class AuthRepository{

    public function register (AuthLoginRequest $request){

        try {

            $validated = $request->validated();
            $validated['role'] = 'Citoyen';
            $validated['is_active'] = true;
            $validated['password'] = Hash::make($validated['password']);

            $user = User::create($validated);
            return response()->json([
                'message' => 'Utilisateur créé avec succès',
                'user' => $user,
                'status' => 'success',
                'code' => 'Utilisateur créé'
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Une erreur est survenue lors du traitement de la requête',
                'error' => $e->getMessage(),
                'status' => 'error',
                'code' => 'Erreur de traitement'
            ], 500);
        }
        
    }

    public function Login(Request $request){

        try {

            $request->validate([
                'email' => 'required|email',
                'password' => 'required|string|min:6',
            ]);

            $credentials = $request->only('email','password');

            if(Auth::attempt($credentials)){

                $user = Auth::User();
                $token = $user->createToken('MobileAuthToken')->plainTextToken;

                return response()->json([
                    'message' => 'Connexion réussie',
                    'user' => $user,
                    'token' => $token,
                    'status' => 'success',
                    'code' => 'Utilisateur connecté',
                    'token_type' => 'Bearer',
                ], 200);

            }else {

                return response()->json([
                    'message' => 'Email ou Mot de passe incorrect',
                    'status' => 'error',
                    'code' => 'Erreur d\'authentification'
                ], 401);

            }

        } catch (\Throwable $th) {
            
            return response()->json([
                'message' => 'Une erreur est survenue lors de la connexion',
                'error' => $th->getMessage(),
                'status' => 'error',
                'code' => 'Erreur de connexion'
            ], 500);
        }
    }


    public function logout(Request $request){

        try {
            
            $request->user()->currentAccessToken()->delete();
            return response()->json(['message' => 'Déconnexion réussie'],200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Une erreur est survenue lors de la déconnexion',
                'error' => $e->getMessage(),
                'status' => 'error',
                'code' => 'Erreur de déconnexion'
            ], 500);
            
        }
        
    }
}