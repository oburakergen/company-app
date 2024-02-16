<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $companies = Company::paginate(15);
        return Inertia::render('Company/Home',[
            'companies' => $companies,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Company/Form/Create', [
            'title' => 'Create Company',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): Response
    {
        $company = Company::find($id);
        return Inertia::render('Company/Show',[
            'company' => $company,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id): Response
    {
        return Inertia::render('Company/Form/Update', [
            'title' => 'Edit Company',
            'companyId' => $id,
        ]);
    }
}
