<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Excursion;
use App\Models\Agency;
use App\Http\Requests\StoreExcursionRequest;
use App\Http\Requests\UpdateExcursionRequest;
use App\Http\Resources\ExcursionResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ExcursionController extends Controller
{
   
    public function index()
    {
        try {
            $user = Auth::user();
    
            if (!$user) {
                return response()->json(['message' => 'User not authenticated.'], 401);
            }
    
            if ($user->role === 'agency') {
                $excursions = $user->agency->excursions()->get();
            } elseif ($user->role === 'tourist') {
                $excursions = Excursion::where('status', 1)->get(); 
            } else {
                return response()->json(['message' => 'User role not authorized to view excursions.'], 403);
            }
    
            return response()->json([
                'status_code' => 200,
                'status_message' => 'Excursions retrieved successfully',
                'data' => ExcursionResource::collection($excursions),
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error retrieving excursions', ['exception' => $e->getMessage()]);
    
            return response()->json([
                'status_code' => 500,
                'status_message' => 'An error occurred while retrieving the excursions',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function store(StoreExcursionRequest $request)
    {
        try {
            $validated = $request->validated();
    
            $statusMapping = [
                'active' => 1,
                'inactive' => 0,
            ];
    
            $status = $statusMapping[$request->input('status')] ?? 0;
    
            $user = Auth::user();
    
            if (!$user || !$user->agency) {
                return response()->json(['message' => 'Agency not found for the authenticated user.'], 404);
            }
    
            $excursion = $user->agency->excursions()->create(array_merge($validated, [
                'status' => $status,
            ]));
    
            return response()->json([
                'status_code' => 201,
                'status_message' => 'Excursion created successfully',
                'data' => new ExcursionResource($excursion)
            ], 201);
        } catch (\Exception $e) {
            Log::error('Error creating excursion', ['exception' => $e->getMessage()]);
    
            return response()->json([
                'status_code' => 500,
                'status_message' => 'An error occurred while creating the excursion',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    

    
    public function show(Excursion $excursion)
    {
        return new ExcursionResource($excursion->load('agency'));
    }

   
    public function update(UpdateExcursionRequest $request, Excursion $excursion)
    {
        $validated = $request->validate([
            'excursionName' => 'sometimes|required|string|max:255',
            'excursionDescription' => 'sometimes|required|string',
            'excursionDate' => 'sometimes|required|date',
            'excursionTime' => 'sometimes|required|date_format:H:i',
            'excursionPlace' => 'sometimes|required|string|max:255',
            'excursionPrice' => 'sometimes|required|numeric',
            'excursionMaxParticipants' => 'sometimes|required|integer',
            'status' => 'sometimes|required|integer',
            'agency_id' => 'sometimes|required|exists:agencies,id',
        ]);

        $excursion->update($validated);

        return new ExcursionResource($excursion);
    }

    
    public function destroy(Excursion $excursion)
    {
        $excursion->delete();

        return response()->noContent();
    }
}
