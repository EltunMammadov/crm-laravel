<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function __construct(
        private User $user
    ){}

    public function getUserByEmail(string $email)
    {
        return $this->user->select([
            'id',
            'email',
            'password'
        ])->where('email', $email)->first();
    }
}