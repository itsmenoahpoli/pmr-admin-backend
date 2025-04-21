<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRoles\CreateUserRoleRequest;
use App\Http\Requests\UserRoles\UpdateUserRoleRequest;
use App\Http\Requests\UserRoles\AssignRoleToUserRequest;
use App\Services\UserRolesService;
use App\Traits\ParamsHelper;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UserRolesController extends Controller
{
    use ParamsHelper;

    public function __construct(
        public readonly UserRolesService $userRolesService
    )
    {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) : JsonResponse
    {
        $queryParams = $this->createPaginationParams($request->query());
        $result = $this->userRolesService->getList($queryParams, $queryParams->paginated);


        return response()->json($result, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateUserRoleRequest $request) : JsonResponse
    {
        $result = $this->userRolesService->create($request->validated());

        return response()->json($result, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $result = $this->userRolesService->getById($id);

        return response()->json($result, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRoleRequest $request, string $id)
    {
        $result = $this->userRolesService->updateById($id, $request->validated());

        return response()->json($result, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $result = $this->userRolesService->deleteById($id);

        return response()->json($result, Response::HTTP_NO_CONTENT);
    }

    /**
     * Assign role to user account
     */
    public function assignRoleToUser(AssignRoleToUserRequest $request)
    {
        $result = $this->userRolesService->assignRoleToUser((object) $request->validated());

        return response()->json($result, Response::HTTP_OK);
    }
}
