<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Services\AuthService;
use App\Http\Resources\AgencyResource;
use Illuminate\Support\Facades\DB;
use App\Models\Agency;
use App\Services\UserEntityService;
use App\Http\Requests\StoreAgencyRequest;
use App\Http\Requests\UpdateAgencyRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AgencyController extends Controller
{
    protected $userEntityService;
    protected $authService;

    public function __construct(UserEntityService $userEntityService, AuthService $authService)
    {
        $this->userEntityService = $userEntityService;
        $this->authService = $authService;
    }

    public function index()
    {
        $agencies = Agency::all();

        return AgencyResource::collection($agencies)->additional([
            'status_code' => 200,
            'status_message' => 'Agencies retrieved successfully',
        ]);
    }

    public function store(StoreAgencyRequest $request)
    {
        DB::beginTransaction();

        try {
            $user = $this->userEntityService->createUserEntity(
                $request->all(),
                'agency',
                Agency::class,
                [
                    'agencyName' => $request->agencyName,
                    'agencyResponsibleName' => $request->agencyResponsibleName,
                ]
            );

            DB::commit();

            $resource = (new AgencyResource($user->agency))->toArray($request);

            $response = [
                'status_code' => '201',
                'status_message' => 'Agency created successfully',
                //'data' => $resource,
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
