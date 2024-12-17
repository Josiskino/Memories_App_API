<?php

namespace App\Actions\User;

use App\Models\User;
use App\Models\Tourist;
use App\Models\Agency;
use Illuminate\Support\Facades\Hash;
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

        // Charger la ressource spécifique basée sur le rôle
        $specificResource = null;
        switch ($user->role) {
            case 'tourist':
                $specificResource = Tourist::where('user_id', $user->id)
                    //->with('user') // Optionnel : si vous voulez inclure les données de l'utilisateur
                    ->first();
                break;
            case 'agency':
                $specificResource = Agency::where('user_id', $user->id)
                    //->with('user') // Optionnel : si vous voulez inclure les données de l'utilisateur
                    ->first();
                break;
        }

        $userData = $specificResource->toArray();
        $userData['email'] = $user->email;

        return [
            'status_code' => 200,
            'status_message' => 'Connexion réussie',
            'token' => $token,
            'user' => $userData,
        ];
    }
}
