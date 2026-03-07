<?php

namespace App\Services;

use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthService
{
    public function attempt(string $password, string $hashed_password)
    {
        return Hash::check($password, $hashed_password);
        // dd($check);
    }

    public function createToken(User $user)
    {
        return $user->createToken(
            date('His')
        )->plainTextToken;
    }
}