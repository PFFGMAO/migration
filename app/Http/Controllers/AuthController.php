<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // NAZAIRE SALOMON SAGNA 03 SEPTEMBRE
    // LE CODE CI DESSOUS REPRESENTE L'AUTHENTIFICATION

    public function register (Request $request) {
        $data = $request->validate([
            'prenom' => 'required|max:255',
            'nom' => 'required|max:255',
            'telephone' => 'required|max:20',
            'adresse' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ]);

        $user = User::create($data);

        $token = $user->createToken($request->email);

        return [
            'user' => $user,
            'token' => $token->plainTextToken
        ];
    }

    public function login (Request $request) {

        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return [
                'errors' => [
                    'email' => [
                        "Les informations d'identification ne correspondent pas"
                    ]
                ]
            ];
        }

        $token = $user->createToken($user->email);

        return [
            'user' => $user,
            'token' => $token->plainTextToken
        ];
    }

    public function logout (Request $request) {

        $user = $request->user();
        if ($user) {
            $user->tokens()->delete();
            return response()->json(['message' => 'Déconnecté....']);
        }

        return response()->json(['message' => 'Pas de user connecté'], 401);
    }

}
