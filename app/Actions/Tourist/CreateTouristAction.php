<?php

namespace App\Actions\Tourist;

use App\Models\Tourist;
use App\Actions\User\CreateUserAction;
use Illuminate\Support\Facades\DB;

class CreateTouristAction
{
    /**
     * Execute the action.
     *
     * @param  array  $data
     * @return mixed
     */
    protected $createUserAction;

    public function __construct(CreateUserAction $createUserAction)
    {
        $this->createUserAction = $createUserAction;
    }

    public function execute(array $userData, array $touristData)
    {
        return DB::transaction(function () use ($userData, $touristData) {

            $userData['role'] = 'tourist';
            $user = $this->createUserAction->execute($userData);

            $tourist = Tourist::create(array_merge([
                'user_id' => $user->id,
                'touristName' => $touristData['touristName'] ?? null
            ], $touristData));

            // Forcer le rechargement
            //$tourist = $tourist->refresh();

            return [
                'user' => $user,
                'tourist' => $tourist
            ];
        });
    }
}
