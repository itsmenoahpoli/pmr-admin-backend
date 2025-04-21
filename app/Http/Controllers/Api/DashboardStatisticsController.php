<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\DashboardStatisticsService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class DashboardStatisticsController extends Controller
{
    public function __construct(
        private readonly DashboardStatisticsService $dashboardStatisticsService
    )
    {}

    public function getOverallStatistics() : JsonResponse
    {
        $result = $this->dashboardStatisticsService->getOverallStatistics();

        return response()->json($result, Response::HTTP_OK);
    }
}
