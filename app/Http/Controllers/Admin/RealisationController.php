<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RealisationRequest;
use App\Models\Realisation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class RealisationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $realisations = Realisation::ordered()->paginate(15);

        return view('admin.realisations.index', compact('realisations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.realisations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RealisationRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $validated['is_published'] = $request->has('is_published');
        $validated['order'] = $validated['order'] ?? 0;
        $validated['description'] = $validated['description'] ?? '';
        $validated['tags'] = $validated['tags'] ?? [];

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('realisations', 'public');
            $validated['image'] = $imagePath;
        }

        $realisation = Realisation::create($validated);

        return redirect()->route('admin.realisations.edit', $realisation)->with('success', 'Réalisation créée avec succès. Vous pouvez maintenant ajouter les détails.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Realisation $realisation): View
    {
        return view('admin.realisations.edit', compact('realisation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RealisationRequest $request, Realisation $realisation): RedirectResponse
    {
        $validated = $request->validated();
        $validated['is_published'] = $request->has('is_published');
        $validated['order'] = $validated['order'] ?? 0;

        if ($request->hasFile('image')) {
            // Delete old image
            if ($realisation->image && Storage::disk('public')->exists($realisation->image)) {
                Storage::disk('public')->delete($realisation->image);
            }

            // Store new image
            $image = $request->file('image');
            $imagePath = $image->store('realisations', 'public');
            $validated['image'] = $imagePath;
        } else {
            // Keep existing image
            unset($validated['image']);
        }

        $realisation->update($validated);

        return redirect()->route('admin.realisations.index')->with('success', 'Réalisation mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Realisation $realisation): RedirectResponse
    {
        // Delete image file
        if ($realisation->image && Storage::disk('public')->exists($realisation->image)) {
            Storage::disk('public')->delete($realisation->image);
        }

        $realisation->delete();

        return redirect()->route('admin.realisations.index')->with('success', 'Réalisation supprimée avec succès.');
    }
}
