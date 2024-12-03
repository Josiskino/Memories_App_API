<?php

namespace App\Actions\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateUserAction
{
    /**
     * Execute the action.
     *
     * @param  array  $data
     * @return mixed
     */
    public function execute(array $userData): User
    {
        return User::create([
            'email' => $userData['email'],
            'password' => Hash::make($userData['password']),
            'status' => 1,
            'role' => $userData['role']
        ]);
    }
}