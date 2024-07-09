<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Hash;
use Throwable;
use App\Models\User;

class UserController extends Controller
{

    /**
     * Log Users
     */
    public function login(Request $request){

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json([
                'status_code' => '401',
                'status_message' => 'Authentication failed',
            ], 401);
        }

        $token = $user->createToken($request->email)->plainTextToken;

        return response()->json([
            'status_code' => '200',
            'status_message' => 'Successful authentication',
            'token' => $token,
        ], 200);
    }


    /**
     * Logout Users
     */
     public function logout(Request $request){

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
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request){
       
            $user = User::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'name' => $request->name,
            ]);
    
            return response()->json([
                'status_code' => '201',
                'status_message' => 'User created successfully',
                'user' => $user,
            ], 201);
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
