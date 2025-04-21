<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Controller;
use App\Services\UserSessionsService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UserSessionsController extends Controller
{
    public function __construct(
        public readonly UserSessionsService $userSessionsService
    )
    {}

    public function index() : JsonResponse
    {
        $result = $this->userSessionsService->getList();

        return response()->json($result, Response::HTTP_OK);
    }

    public function user($userId) : JsonResponse
    {
        $result = $this->userSessionsService->getByUserId($userId);

        return response()->json($result, Response::HTTP_OK);
    }
}
