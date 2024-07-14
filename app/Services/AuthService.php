<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function loginWithRole($email, $password, $role)
    {
        $user = User::where('email', $email)->first();

        if (!$user || !Hash::check($password, $user->password) || $user->role !== $role) {
            return ['status' => 401, 'message' => 'Authentication failed'];
        }

        $token = $user->createToken($email)->plainTextToken;

        return ['status' => 200, 'message' => 'Successful authentication', 'token' => $token, 'role' => $user->role];
    }

    public function createUser($data, $role)
    {
        //dd($data, $role);
        return User::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $role,
        ]);
  
    }   
}
