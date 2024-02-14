<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class CompanyController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, int $id): Response
    {
        $company = Company::where('id', $id)->firstOrFail();

        return Inertia::render('Company/Home',[
            'status' => Auth::check(),
            'company' => $company,
        ]);
    }
}
