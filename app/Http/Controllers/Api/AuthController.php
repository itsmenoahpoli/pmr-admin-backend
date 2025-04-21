<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\AuthService;
use App\Http\Requests\Auth\SigninRequest;
use App\Http\Requests\Auth\SignoutRequest;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function __construct(
        protected AuthService $authService
    ) {}

    public function signin(SigninRequest $request) : JsonResponse
    {
        $credentials = $request->validated();
        $result = $this->authService->authenticateCredentials($credentials, $request->ip());

        return response()->json($result, Response::HTTP_OK);
    }

    public function me(Request $request) : JsonResponse
    {
        $result = $request->user()->load('user_role');

        return response()->json($result, Response::HTTP_OK);
    }

    public function signout(SignoutRequest $request) : JsonResponse
    {
        $result = $this->authService->unauthenticateCredentials($request->user(), $request->validated('session'));

        return response()->json($result, Response::HTTP_OK);
    }

    public function mySessions(Request $request) : JsonResponse
    {
        $result = $this->authService->mySessions($request->user()->id);

        return response()->json($result, Response::HTTP_OK);
    }
}
