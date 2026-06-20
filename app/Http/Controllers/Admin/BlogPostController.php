<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BlogPostRequest;
use App\Models\BlogPost;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class BlogPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $posts = BlogPost::with('author')->ordered()->paginate(15);

        return view('admin.blog-posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.blog-posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogPostRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $validated['is_published'] = $request->has('is_published');
        $validated['author_id'] = $validated['author_id'] ?? Auth::id();
        $validated['published_at'] = $validated['is_published'] ? now() : null;

        if ($request->hasFile('featured_image')) {
            $image = $request->file('featured_image');
            $imagePath = $image->store('blog-posts', 'public');
            $validated['featured_image'] = $imagePath;
        }

        $imagePaths = [];
        foreach ($request->file('images') ?? [] as $file) {
            $imagePaths[] = $file->store('blog-posts/gallery', 'public');
        }
        $validated['images'] = $imagePaths;

        BlogPost::create($validated);

        return redirect()->route('admin.blog-posts.index')->with('success', 'Article de blog créé avec succès.');
    }

    /**
     * Preview the post as it will appear on the public blog.
     */
    public function preview(BlogPost $blogPost): View
    {
        $post = $blogPost;
        $recentPosts = BlogPost::published()->where('id', '!=', $post->id)->ordered()->limit(4)->get();

        return view('pages.blog-post', compact('post', 'recentPosts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BlogPost $blogPost): View
    {
        return view('admin.blog-posts.edit', compact('blogPost'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogPostRequest $request, BlogPost $blogPost): RedirectResponse
    {
        $validated = $request->validated();
        $validated['is_published'] = $request->has('is_published');
        $validated['published_at'] = $validated['is_published'] ? now() : null;

        if ($request->hasFile('featured_image')) {
            // Delete old image
            if ($blogPost->featured_image && Storage::disk('public')->exists($blogPost->featured_image)) {
                Storage::disk('public')->delete($blogPost->featured_image);
            }

            // Store new image
            $image = $request->file('featured_image');
            $imagePath = $image->store('blog-posts', 'public');
            $validated['featured_image'] = $imagePath;
        } else {
            // Keep existing image
            unset($validated['featured_image']);
        }

        $currentImages = $blogPost->images ?? [];
        $removePaths = $request->input('remove_images', []);
        $keptImages = array_values(array_diff($currentImages, $removePaths));
        foreach ($removePaths as $path) {
            if ($path && Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
        }
        foreach ($request->file('new_images') ?? [] as $file) {
            $keptImages[] = $file->store('blog-posts/gallery', 'public');
        }
        $validated['images'] = $keptImages;

        $blogPost->update($validated);

        return redirect()->route('admin.blog-posts.index')->with('success', 'Article de blog mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BlogPost $blogPost): RedirectResponse
    {
        // Delete featured image
        if ($blogPost->featured_image && Storage::disk('public')->exists($blogPost->featured_image)) {
            Storage::disk('public')->delete($blogPost->featured_image);
        }
        // Delete gallery images
        foreach ($blogPost->images ?? [] as $path) {
            if ($path && Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
        }

        $blogPost->delete();

        return redirect()->route('admin.blog-posts.index')->with('success', 'Article de blog supprimé avec succès.');
    }
}
