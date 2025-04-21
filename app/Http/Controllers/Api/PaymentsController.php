<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Payments\CreatePaymentRequest;
use App\Services\PaymentsService;
use App\Traits\ParamsHelper;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class PaymentsController extends Controller
{
    use ParamsHelper;

    public function __construct(
        public readonly PaymentsService $paymentsService
    )
    {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) : JsonResponse
    {
        $queryParams = $this->createPaginationParams($request->query());
        $result = $this->paymentsService->getList($queryParams, $queryParams->paginated);


        return response()->json($result, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreatePaymentRequest $request) : JsonResponse
    {
        $result = $this->paymentsService->create(
            $request->validated()
        );

        return response()->json($result, Response::HTTP_OK);
    }
}
