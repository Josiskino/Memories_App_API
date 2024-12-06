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
                'agencyResponsibleName' => $agencyData['agencyResponsibleName'] ?? null,
                'agencyAttestation' => $agencyData['agencyAttestation'] ?? null,
                'agencyAddress' => $agencyData['agencyAddress'] ?? null,
                'agencyPhone' => $agencyData['agencyPhone'] ?? null,
                'agencyLogo' => $agencyData['agencyLogo'] ?? null,
                'status' => $agencyData['status'] ?? 0,
            ], $agencyData));

            return [
                'user' => $user,
                'agency' => $agency
            ];
        });
    }
}