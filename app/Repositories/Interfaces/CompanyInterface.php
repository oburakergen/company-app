<?php

namespace App\Repositories\Interfaces;

use App\Http\Resources\CompanyCollection;
use App\Http\Resources\CompanyResource;

interface CompanyInterface
{
    public function create(array $credentials): CompanyCollection;
    public function update(int $companyId, array $credentials): CompanyCollection;
    public function delete(int $companyId): CompanyCollection;
    public function show(int $companyId): CompanyResource;
}
