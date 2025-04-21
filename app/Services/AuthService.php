<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use App\Services\UserSessionsService;

class AuthService
{
    public function __construct(
        private readonly UserSessionsService $userSessionsService
    )
    {}

    public function authenticateCredentials($credentials, $ipAddress)
    {
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $session = $this->userSessionsService->startSession([
                'user_id'       => $user->id,
                'ip_address'    => $ipAddress,
            ]);

            /**
             * @var \App\Models\User::class $user
             */
            $user->load('user_role');
            $tokenExpiresAt = now()->addHours(24); // 1 day
            $token = $user->createToken(
                time(), ['*'], $tokenExpiresAt
            )->plainTextToken;

            if (!$user->is_enabled)
            {
                return [
                    'account_enabled'   => boolval($user->is_enabled)
                ];
            }

            return [
                'account_enabled'   => boolval($user->is_enabled),
                'session'           => $session,
                'user'              => $user,
                'token'             => $token,
                'token_expires_at'  => $tokenExpiresAt->timestamp
            ];
        }

        throw new UnauthorizedHttpException('Bearer', 'Invalid credentials provided');
    }

    public function unauthenticateCredentials($user, $sessionId)
    {
        $user->currentAccessToken()->delete();
        $this->userSessionsService->endSession($sessionId);

        return true;
    }

    public function mySessions($userId)
    {
        $sessions = $this->userSessionsService->getByUserId($userId);

        return $sessions;
    }
}
