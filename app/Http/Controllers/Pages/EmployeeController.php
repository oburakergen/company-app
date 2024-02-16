<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return Inertia::render('Employee/Form/Create', [
            'title' => 'Create Company',
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id): Response
    {
        return Inertia::render('Employee/Form/Update', [
            'title' => 'Edit Employee',
            'employeeId' => $id,
        ]);
    }
}
