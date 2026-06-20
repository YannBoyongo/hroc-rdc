<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactFormRequest;
use App\Mail\ContactMail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class PageController extends Controller
{
    public function home(): View
    {
        $sliders = \App\Models\Slider::latest()->get();
        $company = \App\Models\Company::getInstance();
        $approaches = \App\Models\Approach::latest()->limit(6)->get();
        $blogPosts = \App\Models\BlogPost::published()->ordered()->limit(3)->get();
        $partners = \App\Models\Partner::latest()->get();

        return view('pages.home', compact('sliders', 'company', 'approaches', 'blogPosts', 'partners'));
    }

    public function quiSommesNous(): View
    {
        $company = \App\Models\Company::getInstance();

        return view('pages.about.qui-sommes-nous', compact('company'));
    }

    public function notreMission(): View
    {
        $company = \App\Models\Company::getInstance();

        return view('pages.about.notre-mission', compact('company'));
    }

    public function notreVision(): View
    {
        $company = \App\Models\Company::getInstance();

        return view('pages.about.notre-vision', compact('company'));
    }

    public function nosObjectifs(): View
    {
        $objectives = \App\Models\Objective::latest()->get();

        return view('pages.about.nos-objectifs', compact('objectives'));
    }

    public function domainesIntervention(): View
    {
        $domains = \App\Models\Domain::latest()->get();

        return view('pages.actions.domaines-intervention', compact('domains'));
    }

    public function nosApproches(): View
    {
        $approaches = \App\Models\Approach::latest()->get();

        return view('pages.actions.nos-approches', compact('approaches'));
    }

    public function nosRealisations(): View
    {
        $realisations = \App\Models\Realisation::published()->ordered()->get();

        return view('pages.actions.nos-realisations', compact('realisations'));
    }

    public function nosRapports(): View
    {
        $reports = \App\Models\Report::latest()->get();

        return view('pages.actions.nos-rapports', compact('reports'));
    }

    public function contact(): View
    {
        return view('pages.contact');
    }

    public function sendContact(ContactFormRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        Mail::to(config('mail.from.address'))->send(
            new ContactMail(
                $validated['name'],
                $validated['email'],
                $validated['subject'],
                $validated['message']
            )
        );

        return redirect()->route('contact')->with('success', 'Votre message a été envoyé avec succès. Nous vous répondrons dans les plus brefs délais.');
    }

    public function blog(): View
    {
        $posts = \App\Models\BlogPost::published()->ordered()->paginate(12);

        return view('pages.blog', compact('posts'));
    }

    public function blogPost(string $slug): View
    {
        $post = \App\Models\BlogPost::published()->where('slug', $slug)->firstOrFail();
        $recentPosts = \App\Models\BlogPost::published()->where('id', '!=', $post->id)->ordered()->limit(4)->get();

        return view('pages.blog-post', compact('post', 'recentPosts'));
    }

    public function gallery(): View
    {
        $images = \App\Models\GalleryImage::published()->ordered()->get();

        return view('pages.gallery', compact('images'));
    }

    public function donation(): View
    {
        return view('pages.donation');
    }
}
