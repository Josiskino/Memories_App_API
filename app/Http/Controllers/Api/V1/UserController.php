<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Actions\User\LoginUserAction;
use App\Actions\User\LogoutUserAction;

class UserController extends Controller
{
    protected $userLoginAction;
    protected $userLogoutAction;

    public function __construct(LoginUserAction $userLoginAction, LogoutUserAction $userLogoutAction)
    {
        $this->userLoginAction = $userLoginAction;
        $this->userLogoutAction = $userLogoutAction;
    }

    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            $response = $this->userLoginAction->execute($request->only(['email', 'password']));

            return response()->json($response, $response['status_code']);
        } catch (\Exception $e) {
            Log::error('Erreur de connexion', ['exception' => $e->getMessage()]);

            return response()->json([
                'status_code' => 500,
                'status_message' => 'Une erreur est survenue lors de la connexion',
            ], 500);
        }
    }

    public function logout(Request $request)
    {
        try {
            $response = $this->userLogoutAction->execute($request);

            return response()->json($response, $response['status_code']);
        } catch (\Exception $e) {
            Log::error('Erreur de déconnexion', ['exception' => $e->getMessage()]);

            return response()->json([
                'status_code' => 500,
                'status_message' => 'Une erreur est survenue lors de la déconnexion',
            ], 500);
        }
    }

    // Les autres méthodes restent inchangées
    public function index()
    {
        //
    }

    public function show(string $id)
    {
        //
    }
}