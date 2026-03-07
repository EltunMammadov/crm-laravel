<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService
{
    public function __construct(
        private UserRepository $userRepository
    ){}

    public function getUserByEmail(string $email)
    {
        return $this->userRepository->getUserByEmail($email);
    }
}