<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DomainRequest;
use App\Models\Domain;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DomainController extends Controller
{
    public function index(): View
    {
        $domains = Domain::latest()->paginate(15);

        return view('admin.domains.index', compact('domains'));
    }

    public function create(): View
    {
        return view('admin.domains.create');
    }

    public function store(DomainRequest $request): RedirectResponse
    {
        Domain::create($request->validated());

        return redirect()->route('admin.domains.index')->with('success', 'Domaine créé avec succès.');
    }

    public function edit(Domain $domain): View
    {
        return view('admin.domains.edit', compact('domain'));
    }

    public function update(DomainRequest $request, Domain $domain): RedirectResponse
    {
        $domain->update($request->validated());

        return redirect()->route('admin.domains.index')->with('success', 'Domaine mis à jour avec succès.');
    }

    public function destroy(Domain $domain): RedirectResponse
    {
        $domain->delete();

        return redirect()->route('admin.domains.index')->with('success', 'Domaine supprimé avec succès.');
    }
}
