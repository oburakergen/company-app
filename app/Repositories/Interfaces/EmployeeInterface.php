<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\JsonResponse;

interface EmployeeInterface
{
    public function create(array $credentials): JsonResponse;
    public function update(int $employeeId, array $credentials): JsonResponse;
    public function delete(int $employeeId): JsonResponse;
    public function show(int $employeeId): JsonResponse;
}
