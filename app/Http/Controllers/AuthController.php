<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginReqquest;
use App\Services\AuthService;
use App\Services\UserService;

class AuthController extends Controller
{
    public function __construct(
        private UserService $userService,
        private AuthService $authService
    ){}

    public function login(LoginReqquest $request)
    {
        $user = $this->userService->getUserByEmail($request->email);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'E-poçt ünvanı və ya şifr yanlışdır'
            ], 400);
        }

        $attempt = $this->authService->attempt($request->password, $user->password);

        if (!$attempt) {
            return response()->json([
                'success' => false,
                'message' => 'E-poçt ünvanı və ya şifr yanlışdır'
            ], 400);
        }
        // dd($user);
        $token = $this->authService->createToken($user);

        return response()->json([
            'success' => true,
            'message' => 'Ugurlu netice',
            'data' => [
                'token' => sprintf("Bearer %s", $token)
            ]
        ]);
        // dd($token);
    }
}
