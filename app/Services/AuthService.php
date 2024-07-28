<?php

namespace App\Services;

use App\Models\User;
use App\Models\Tourist;
use App\Models\Agency;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\TouristResource;
use App\Http\Resources\AgencyResource;
use Illuminate\Http\Request;

class AuthService
{
    public function login($email, $password)
    {
        $user = User::where('email', $email)->first();

        if (!$user || !Hash::check($password, $user->password)) {
            return [
                'status_code' => 401,
                'status_message' => 'Invalid credentials',
            ];
        }

        $role = $user->role;
      
        $token = $user->createToken('auth_token')->plainTextToken;

        $response = [
            'status_code' => 200,
            'status_message' => 'Login successful',
            'token' => $token,
        ];

        if ($role === 'tourist') {
            $tourist = $user->tourist;
            if ($tourist) {
                $response['tourist'] = (new TouristResource($tourist))->toArray(new Request());
            }
        } elseif ($role === 'agency') {
            $agency = $user->agency;
            if ($agency) {
                $response['agency'] = (new AgencyResource($agency))->toArray(new Request());
            }
        }

        return $response;
        
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
