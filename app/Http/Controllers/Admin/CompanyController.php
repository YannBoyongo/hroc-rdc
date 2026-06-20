<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CompanyRequest;
use App\Models\Company;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CompanyController extends Controller
{
    /**
     * Display the company form.
     */
    public function index(): View
    {
        $company = Company::getInstance();

        return view('admin.company.index', compact('company'));
    }

    /**
     * Update the company.
     */
    public function update(CompanyRequest $request): RedirectResponse
    {
        $company = Company::getInstance();

        $company->update($request->validated());

        return redirect()->route('admin.company.index')->with('success', 'Les informations de l\'entreprise ont été mises à jour avec succès.');
    }
}
