<?php

namespace App\Actions\Agency;

use App\Models\Agency;
use App\Actions\User\CreateUserAction;
use Illuminate\Support\Facades\DB;

class CreateAgencyAction
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

    public function execute(array $userData, array $agencyData)
    {
        return DB::transaction(function () use ($userData, $agencyData) {

            $userData['role'] = 'agency';
            $user = $this->createUserAction->execute($userData);

            $agency = Agency::create(array_merge([
                'user_id' => $user->id,
                'agencyName' => $agencyData['agencyName'] ?? null,
                'status' => $agencyData['status'] ?? 'pending'
            ], $agencyData));

            return [
                'user' => $user,
                'agency' => $agency
            ];
        });
    }
}