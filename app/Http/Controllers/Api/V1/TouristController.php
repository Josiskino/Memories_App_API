<?php

namespace App\Http\Controllers\Api\V1;

use App\Actions\Tourist\CreateTouristAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\tourist\StoreTouristRequest;
use App\Http\Requests\tourist\UpdateTouristRequest;
use App\Http\Resources\TouristResource;
use App\Models\Tourist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TouristController extends Controller
{

    public function index()
    {
        $tourists = Tourist::all();

        return TouristResource::collection($tourists)->additional([
            'status_code' => 200,
            'status_message' => 'Tourists retrieved successfully',
        ]);
    }

    public function store(StoreTouristRequest $request, CreateTouristAction $createTouristAction)
    {
        try {
            $result = $createTouristAction->execute(
                $request->only(['email', 'password']),
                $request->validated()
            );

            return response()->json([
                'status_code' => 201,
                'message' => 'Tourist created successfully',
                'tourist' => new TouristResource($result['tourist']),
            ], 201);
        } catch (\Exception $e) {
            Log::error('Tourist creation error', ['exception' => $e->getMessage()]);

            return response()->json([
                'status_code' => 500,
                'message' => 'An error occurred during tourist creation',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function me()
    {
        $user = Auth::user()->tourist;

        if ($user) {
            return response()->json([
                'tourist' => new TouristResource($user),
                'status_code' => 200
            ]);
        }

        return response()->json(['message' => 'User not authenticated'], 401);
    }
}
