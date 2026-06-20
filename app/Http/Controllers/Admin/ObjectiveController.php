<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ObjectiveRequest;
use App\Models\Objective;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ObjectiveController extends Controller
{
    public function index(): View
    {
        $objectives = Objective::latest()->paginate(15);

        return view('admin.objectives.index', compact('objectives'));
    }

    public function create(): View
    {
        return view('admin.objectives.create');
    }

    public function store(ObjectiveRequest $request): RedirectResponse
    {
        Objective::create($request->validated());

        return redirect()->route('admin.objectives.index')->with('success', 'Objectif créé avec succès.');
    }

    public function edit(Objective $objective): View
    {
        return view('admin.objectives.edit', compact('objective'));
    }

    public function update(ObjectiveRequest $request, Objective $objective): RedirectResponse
    {
        $objective->update($request->validated());

        return redirect()->route('admin.objectives.index')->with('success', 'Objectif mis à jour avec succès.');
    }

    public function destroy(Objective $objective): RedirectResponse
    {
        $objective->delete();

        return redirect()->route('admin.objectives.index')->with('success', 'Objectif supprimé avec succès.');
    }
}
