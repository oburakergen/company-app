<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\JsonResponse;

interface CompanyInterface
{
    public function create(array $credentials): JsonResponse;
    public function update(int $companyId, array $credentials): JsonResponse;
    public function delete(int $companyId): JsonResponse;
    public function show(int $companyId): JsonResponse;
}
