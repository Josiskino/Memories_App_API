<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Services\AuthService;
use App\Http\Resources\TouristResource;
use Illuminate\Support\Facades\DB;
use App\Models\Tourist;
use App\Services\UserEntityService;
use App\Http\Requests\StoreTouristRequest;
use App\Http\Requests\UpdateTouristRequest;
use Illuminate\Http\Request;
use App\Models\User;


class TouristController extends Controller
{
    protected $authService;
    protected $userEntityService;

    public function __construct(UserEntityService $userEntityService, AuthService $authService)
    {
        $this->authService = $authService;
        $this->userEntityService = $userEntityService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tourists = Tourist::all();

        return TouristResource::collection($tourists)->additional([
            'status_code' => 200,
            'status_message' => 'Tourists retrieved successfully',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTouristRequest $request)
    {
        DB::beginTransaction();

        try {
            $user = $this->userEntityService->createUserEntity(
                $request->all(),
                'tourist',
                Tourist::class,
                ['touristName' => $request->touristName]
            );

            DB::commit();

            $resource = (new TouristResource($user->tourist))->toArray($request);

            $response = [
                'status_code' => '201',
                'status_message' => 'Tourist created successfully',
                'data' => $resource,
            ];

            return response()->json($response, 201);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status_code' => '500',
                'status_message' => 'An error occurred',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $response = $this->authService->loginWithRole($request->email, $request->password, 'tourist');

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
