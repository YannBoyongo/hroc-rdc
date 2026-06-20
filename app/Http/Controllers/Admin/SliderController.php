<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SliderRequest;
use App\Models\Slider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class SliderController extends Controller
{
    public function index(): View
    {
        $sliders = Slider::latest()->paginate(15);

        return view('admin.sliders.index', compact('sliders'));
    }

    public function create(): View
    {
        return view('admin.sliders.create');
    }

    public function store(SliderRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('sliders', 'public');
            $validated['image'] = $imagePath;
        }

        Slider::create($validated);

        return redirect()->route('admin.sliders.index')->with('success', 'Slider créé avec succès.');
    }

    public function edit(Slider $slider): View
    {
        return view('admin.sliders.edit', compact('slider'));
    }

    public function update(SliderRequest $request, Slider $slider): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            // Delete old image
            if ($slider->image && Storage::disk('public')->exists($slider->image)) {
                Storage::disk('public')->delete($slider->image);
            }

            // Store new image
            $image = $request->file('image');
            $imagePath = $image->store('sliders', 'public');
            $validated['image'] = $imagePath;
        } else {
            // Keep existing image
            unset($validated['image']);
        }

        $slider->update($validated);

        return redirect()->route('admin.sliders.index')->with('success', 'Slider mis à jour avec succès.');
    }

    public function destroy(Slider $slider): RedirectResponse
    {
        // Delete image file
        if ($slider->image && Storage::disk('public')->exists($slider->image)) {
            Storage::disk('public')->delete($slider->image);
        }

        $slider->delete();

        return redirect()->route('admin.sliders.index')->with('success', 'Slider supprimé avec succès.');
    }
}
