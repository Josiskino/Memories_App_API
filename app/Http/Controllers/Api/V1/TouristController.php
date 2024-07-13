<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Services\AuthService;
use Illuminate\Support\Facades\DB;
use App\Models\Tourist;
use App\Http\Requests\StoreTouristRequest;
use App\Http\Requests\UpdateTouristRequest;
use Illuminate\Http\Request;
use App\Models\User;


class TouristController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
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
    public function store(StoreTouristRequest $request)
    {
        DB::beginTransaction();

        try {
            
            $user = $this->authService->createUser($request->all(), 'tourist');
    
            $tourist = Tourist::create([
                'user_id' => $user->id,
                'touristName' => $request->touristName,
            ]);
    
            DB::commit();
    
            return response()->json([
                'status_code' => '201',
                'status_message' => 'Tourist created successfully',
                'data' => $tourist,
            ], 201);
    
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status_code' => '500',
                'status_message' => 'An error occurred',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function login(Request $request){

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $response = $this->authService->login($request->email, $request->password);

        if ($response['status'] == 200 && !User::where('email', $request->email)->first()->tourist) {
            $response = ['status' => 401, 'message' => 'Authentication failed'];
        }

        return response()->json([
            'status_code' => (string)$response['status'],
            'status_message' => $response['message'],
            'token' => $response['token'] ?? null,
            'role' => $response['role'] ?? null,
        ], $response['status']);
    }

    public function me(Request $request){

        $user = Auth::user();

        if ($user) {
            return response()->json(['user' => $user]);
        }

        return response()->json(['message' => 'User not authenticated'], 401);
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
     * Display the specified resource.
     */
    public function show(Tourist $tourist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTouristRequest $request, Tourist $tourist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tourist $tourist)
    {
        //
    }
}
