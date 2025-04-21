<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class SystemController extends Controller
{
    public function healthcheck() : JsonResponse
    {
        return response()->json([
            'status' => 'OK'
        ], Response::HTTP_OK);
    }
}
