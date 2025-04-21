<?php

namespace App\Http\Controllers\Api\Staffs;

use App\Http\Controllers\Controller;
use App\Http\Requests\Staffs\CreateStaffRequest;
use App\Http\Requests\Staffs\UpdateStaffRequest;
use App\Services\StaffsService;
use App\Traits\ParamsHelper;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class StaffsController extends Controller
{
    use ParamsHelper;

    public function __construct(
        public readonly StaffsService $staffsService
    )
    {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) : JsonResponse
    {
        $queryParams = $this->createPaginationParams($request->query());
        $result = $this->staffsService->getList($queryParams, $queryParams->paginated);


        return response()->json($result, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateStaffRequest $request) : JsonResponse
    {
        $result = $this->staffsService->create($request->validated());

        return response()->json($result, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $result = $this->staffsService->getById($id);

        return response()->json($result, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStaffRequest $request, string $id)
    {
        $result = $this->staffsService->updateById($id, $request->validated());

        return response()->json($result, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $result = $this->staffsService->deleteById($id);

        return response()->json($result, Response::HTTP_NO_CONTENT);
    }
}
