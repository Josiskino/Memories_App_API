<?php

namespace App\Http\Controllers\Api\V1;

use App\Actions\Agency\CreateAgencyAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\agency\StoreAgencyRequest;
use App\Http\Requests\agency\UpdateAgencyRequest;
use App\Services\AuthService;
use App\Http\Resources\AgencyResource;
use Illuminate\Support\Facades\DB;
use App\Models\Agency;
use App\Services\UserEntityService;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AgencyController extends Controller
{

    public function index()
    {
        $agencies = Agency::all();

        return AgencyResource::collection($agencies)->additional([
            'status_code' => 200,
            'status_message' => 'Agencies retrieved successfully',
        ]);
    }

    public function store(StoreAgencyRequest $request, CreateAgencyAction $createAgencyAction)
    {
        try {
            $result = $createAgencyAction->execute(
                $request->only(['email', 'password']),
                $request->validated()
            );

            return response()->json([
                'status_code' => 201,
                'message' => 'Agency created successfully',
                'agency' => new AgencyResource($result['agency']),
            ], 201);
        } catch (\Exception $e) {
            Log::error('Agency creation error', ['exception' => $e->getMessage()]);

            return response()->json([
                'status_code' => 500,
                'message' => 'An error occurred during agency creation',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function me(Request $request)
    {
        $user = Auth::user();

        if ($user) {
            return response()->json(['user' => $user]);
        }

        return response()->json(['message' => 'User not authenticated'], 401);
    }

    public function show(Agency $agency)
    {
        //
    }

    public function update(UpdateAgencyRequest $request, Agency $agency)
    {
        //
    }

    public function destroy(Agency $agency)
    {
        //
    }
}
