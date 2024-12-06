<?php

namespace App\Actions\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginUserAction
{
    /**
     * Execute user login.
     *
     * @param  array  $credentials
     * @return array
     */

     public function execute(array $credentials)
     {
         $user = User::where('email', $credentials['email'])->first();
 
         if (!$user || !Hash::check($credentials['password'], $user->password)) {
             throw ValidationException::withMessages([
                 'email' => ['Les identifiants fournis sont incorrects.'],
             ]);
         }
 
         // Supprimer tous les tokens existants
         $user->tokens()->delete();
 
         // Générer un nouveau token
         $token = $user->createToken('api_token')->plainTextToken;
 
         return [
             'status_code' => 200,
             'status_message' => 'Connexion réussie',
             'token' => $token,
             'user' => $user,
         ];
     }
}