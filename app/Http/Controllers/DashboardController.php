<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\GalleryImage;
use App\Models\Realisation;
use App\Models\Slider;
use App\Models\Partner;
use App\Models\Report;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $stats = [
            'blog_posts' => BlogPost::count(),
            'blog_posts_published' => BlogPost::published()->count(),
            'realisations' => Realisation::count(),
            'gallery_images' => GalleryImage::count(),
            'sliders' => Slider::count(),
            'partners' => Partner::count(),
            'reports' => Report::count(),
        ];

        $recentPosts = BlogPost::with('author')
            ->ordered()
            ->limit(5)
            ->get();

        return view('dashboard', compact('stats', 'recentPosts'));
    }
}
