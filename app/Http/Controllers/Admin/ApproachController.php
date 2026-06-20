<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ApproachRequest;
use App\Models\Approach;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ApproachController extends Controller
{
    public function index(): View
    {
        $approaches = Approach::latest()->paginate(15);

        return view('admin.approaches.index', compact('approaches'));
    }

    public function create(): View
    {
        return view('admin.approaches.create');
    }

    public function store(ApproachRequest $request): RedirectResponse
    {
        Approach::create($request->validated());

        return redirect()->route('admin.approaches.index')->with('success', 'Approche créée avec succès.');
    }

    public function edit(Approach $approach): View
    {
        return view('admin.approaches.edit', compact('approach'));
    }

    public function update(ApproachRequest $request, Approach $approach): RedirectResponse
    {
        $approach->update($request->validated());

        return redirect()->route('admin.approaches.index')->with('success', 'Approche mise à jour avec succès.');
    }

    public function destroy(Approach $approach): RedirectResponse
    {
        $approach->delete();

        return redirect()->route('admin.approaches.index')->with('success', 'Approche supprimée avec succès.');
    }
}
