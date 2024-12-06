<?php

namespace App\Actions\User;

use Illuminate\Http\Request;

class LogoutUserAction
{
     /**
     * Execute user logout.
     *
     * @param  Request  $request
     * @return array
     */

    public function execute(Request $request)
    {
        // Supprimer le token courant
        $request->user()->currentAccessToken()->delete();

        return [
            'status_code' => 200,
            'status_message' => 'Déconnexion réussie'
        ];
    }
}