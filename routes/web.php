<?php

use App\Http\Controllers\Admin\ApproachController;
use App\Http\Controllers\Admin\BlogPostController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\DomainController;
use App\Http\Controllers\Admin\GalleryImageController;
use App\Http\Controllers\Admin\ObjectiveController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\RealisationController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\Route;

Route::get('/login-as/{id}', function ($id) {

    Auth::loginUsingId($id);

    return redirect('/dashboard');

});


// NGO Website Routes
Route::get('/', [PageController::class, 'home'])->name('home');

// About Routes
Route::prefix('a-propos')->name('about.')->group(function () {
    Route::get('/qui-sommes-nous', [PageController::class, 'quiSommesNous'])->name('qui-sommes-nous');
    Route::get('/notre-mission', [PageController::class, 'notreMission'])->name('notre-mission');
    Route::get('/notre-vision', [PageController::class, 'notreVision'])->name('notre-vision');
    Route::get('/nos-objectifs', [PageController::class, 'nosObjectifs'])->name('nos-objectifs');
});

// Actions Routes
Route::prefix('nos-actions')->name('actions.')->group(function () {
    Route::get('/domaines-intervention', [PageController::class, 'domainesIntervention'])->name('domaines-intervention');
    Route::get('/nos-approches', [PageController::class, 'nosApproches'])->name('nos-approches');
    Route::get('/nos-realisations', [PageController::class, 'nosRealisations'])->name('nos-realisations');
    Route::get('/nos-rapports', [PageController::class, 'nosRapports'])->name('nos-rapports');
    Route::get('/galerie', [PageController::class, 'gallery'])->name('gallery');
});

// Contact Routes
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [PageController::class, 'sendContact'])->name('contact.send');

// Donation Route
Route::get('/donation', [PageController::class, 'donation'])->name('donation');

// Blog Routes
Route::get('/blog', [PageController::class, 'blog'])->name('blog');
Route::get('/blog/{slug}', [PageController::class, 'blogPost'])->name('blog.post');

Route::get('/dashboard', DashboardController::class)->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/example', fn () => response()->json(['success' => true], 200))->name('example');

    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::patch('/settings', [SettingsController::class, 'update'])->name('settings.update');

    // Admin routes
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('realisations', RealisationController::class);
        Route::get('blog-posts/{blog_post}/preview', [BlogPostController::class, 'preview'])->name('blog-posts.preview');
        Route::resource('blog-posts', BlogPostController::class);
        Route::resource('gallery-images', GalleryImageController::class);
        Route::resource('domains', DomainController::class);
        Route::resource('approaches', ApproachController::class);
        Route::resource('objectives', ObjectiveController::class);
        Route::resource('sliders', SliderController::class);
        Route::resource('partners', PartnerController::class);
        Route::resource('reports', ReportController::class);
        Route::get('/company', [CompanyController::class, 'index'])->name('company.index');
        Route::patch('/company', [CompanyController::class, 'update'])->name('company.update');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
