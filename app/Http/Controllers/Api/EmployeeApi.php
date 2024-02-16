<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Http\Requests\EmployeeRequest;
use App\Repositories\EmployeeRepository;
use Illuminate\Http\JsonResponse;

class EmployeeApi extends Controller
{
    public function __construct(protected EmployeeRepository $employeeRepository){}
    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeRequest $request): JsonResponse
    {
        $credentials = $request->validated();

        return $this->employeeRepository->create($credentials);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): JsonResponse
    {
        return $this->employeeRepository->show($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CompanyRequest $request, int $id): JsonResponse
    {
        $credentials = $request->validated();

        return $this->employeeRepository->update($id, $credentials);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): JsonResponse
    {
        return $this->employeeRepository->delete($id);
    }
}
