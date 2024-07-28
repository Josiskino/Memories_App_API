<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Participation;
use App\Models\Excursion;
use App\Http\Requests\StoreParticipationRequest;
use App\Http\Requests\UpdateParticipationRequest;
use App\Http\Resources\ParticipationResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParticipationController extends Controller
{
    
    public function index()
    {
        $participations = Participation::paginate(10);
        return ParticipationResource::collection($participations);
    }

    
    public function store(StoreParticipationRequest $request, Excursion $excursion)
    {
        $user = Auth::user();
    
        if ($user->role !== 'tourist') {
            return response()->json(['message' => 'Only tourists can participate in excursions.'], 403);
        }
    
        if ($excursion->participants()->count() >= $excursion->excursionMaxParticipants) {
            return response()->json(['message' => 'The maximum number of participants has been reached.'], 403);
        }
    
        $existingParticipation = Participation::where('tourist_id', $user->id)
                                              ->where('excursion_id', $excursion->id)
                                              ->first();
    
        if ($existingParticipation) {
            return response()->json(['message' => 'You are already participating in this excursion.'], 409);
        }
    
        $statusMapping = [
            'pending' => 0,
            'validated' => 1,
            'canceled' => 2,
        ];
    
        $status = $statusMapping[$request->input('status', 'pending')] ?? 0;
    
        $participation = new Participation([
            'tourist_id' => $user->id,
            'excursion_id' => $excursion->id,
            'status' => $status, 
        ]);
    
        $participation->save();
    
        return response()->json(['message' => 'Participation added successfully.'], 201);
    }
    
    public function show(Participation $participation)
    {
        return new ParticipationResource($participation);
    }

    public function cancel($excursionId, $participationId)
    {
        $user = Auth::user();

        if ($user->role !== 'tourist') {
            return response()->json(['message' => 'Only tourists can cancel their participation.'], 403);
        }

        $participation = Participation::where('id', $participationId)
                                    ->where('excursion_id', $excursionId)
                                    ->where('tourist_id', $user->id)
                                    ->first();

        if (!$participation) {
            return response()->json(['message' => 'Participation not found or you do not have permission to cancel this participation.'], 404);
        }

        $participation->status = 2; //Je dois modifier le status code après
        $participation->save();

        return response()->json(['message' => 'Participation canceled successfully.'], 200);
    }

    public function update(UpdateParticipationRequest $request, Participation $participation)
    {
        $validated = $request->validate([
            'tourist_id' => 'sometimes|required|exists:tourists,id',
            'excursion_id' => 'sometimes|required|exists:excursions,id',
            'status' => 'sometimes|required|integer',
        ]);

        $participation->update($validated);

        return new ParticipationResource($participation);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Participation $participation)
    {
        $participation->delete();

        return response()->noContent();
    }
}
