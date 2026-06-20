<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PartnerRequest;
use App\Models\Partner;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PartnerController extends Controller
{
    public function index(): View
    {
        $partners = Partner::latest()->paginate(15);

        return view('admin.partners.index', compact('partners'));
    }

    public function create(): View
    {
        return view('admin.partners.create');
    }

    public function store(PartnerRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('partners', 'public');
            $validated['image'] = $imagePath;
        }

        Partner::create($validated);

        return redirect()->route('admin.partners.index')->with('success', 'Partenaire créé avec succès.');
    }

    public function edit(Partner $partner): View
    {
        return view('admin.partners.edit', compact('partner'));
    }

    public function update(PartnerRequest $request, Partner $partner): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            // Delete old image
            if ($partner->image && Storage::disk('public')->exists($partner->image)) {
                Storage::disk('public')->delete($partner->image);
            }

            // Store new image
            $image = $request->file('image');
            $imagePath = $image->store('partners', 'public');
            $validated['image'] = $imagePath;
        } else {
            // Keep existing image
            unset($validated['image']);
        }

        $partner->update($validated);

        return redirect()->route('admin.partners.index')->with('success', 'Partenaire mis à jour avec succès.');
    }

    public function destroy(Partner $partner): RedirectResponse
    {
        // Delete image file
        if ($partner->image && Storage::disk('public')->exists($partner->image)) {
            Storage::disk('public')->delete($partner->image);
        }

        $partner->delete();

        return redirect()->route('admin.partners.index')->with('success', 'Partenaire supprimé avec succès.');
    }
}
