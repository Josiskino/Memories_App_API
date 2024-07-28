<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Hash;
use Throwable;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Services\AuthService;


class UserController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(Request $request)
    {
        try {
            
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            // Appel du service d'authentification
            $response = $this->authService->login($request->email, $request->password);

            return response()->json($response, $response['status_code']);
        } catch (\Exception $e) {
            // Log de l'exception pour débogage
            Log::error('An error occurred', ['exception' => $e->getMessage()]);

            // Retourner une réponse d'erreur générique
            return response()->json([
                'status_code' => '500',
                'status_message' => 'An error occurred',
            ], 500);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status_code' => '200',
            'status_message' => 'Successfully logged out',
        ], 200);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
