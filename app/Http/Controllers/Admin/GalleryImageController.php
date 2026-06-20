<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GalleryImageRequest;
use App\Models\GalleryImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class GalleryImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $images = GalleryImage::ordered()->paginate(20);

        return view('admin.gallery-images.index', compact('images'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.gallery-images.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GalleryImageRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $validated['is_published'] = $request->has('is_published');
        $validated['order'] = $validated['order'] ?? 0;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('gallery-images', 'public');
            $validated['image_path'] = $imagePath;
        }

        GalleryImage::create($validated);

        return redirect()->route('admin.gallery-images.index')->with('success', 'Image de galerie ajoutée avec succès.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GalleryImage $galleryImage): View
    {
        return view('admin.gallery-images.edit', compact('galleryImage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GalleryImageRequest $request, GalleryImage $galleryImage): RedirectResponse
    {
        $validated = $request->validated();
        $validated['is_published'] = $request->has('is_published');
        $validated['order'] = $validated['order'] ?? 0;

        if ($request->hasFile('image')) {
            // Delete old image
            if ($galleryImage->image_path && Storage::disk('public')->exists($galleryImage->image_path)) {
                Storage::disk('public')->delete($galleryImage->image_path);
            }

            // Store new image
            $image = $request->file('image');
            $imagePath = $image->store('gallery-images', 'public');
            $validated['image_path'] = $imagePath;
        } else {
            // Keep existing image
            unset($validated['image_path']);
        }

        $galleryImage->update($validated);

        return redirect()->route('admin.gallery-images.index')->with('success', 'Image de galerie mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GalleryImage $galleryImage): RedirectResponse
    {
        // Delete image file
        if ($galleryImage->image_path && Storage::disk('public')->exists($galleryImage->image_path)) {
            Storage::disk('public')->delete($galleryImage->image_path);
        }

        $galleryImage->delete();

        return redirect()->route('admin.gallery-images.index')->with('success', 'Image de galerie supprimée avec succès.');
    }
}
