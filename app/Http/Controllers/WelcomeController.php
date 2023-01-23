<?php

namespace App\Http\Controllers;

use App\Models\FAQ;
use App\Models\Gallery;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\SiteInformation;

class WelcomeController extends Controller
{
    public function index()
    {
        $site = SiteInformation::latest()->first();
        $categories = Category::where('site_id', $site->id)->where('status', '=', 'actived')->orderBy('name', 'ASC')->get();

        $galleries = Gallery::whereHas('category', function ($query) {
            $query->where('status', 'actived');
        })->latest()->get();

        $faqs = FAQ::where('site_id', $site->id)->orderBy('created_at', 'DESC')->get();

        if ($faqs->count() >= 2) {
            $faqs = FAQ::where('site_id', $site->id)->orderBy('created_at', 'DESC')->get()->split(2)->toArray();
        }

        return view('welcome', [
            'site' => $site,
            'categories' => $categories,
            'galleries' => $galleries,
            'faqs' => $faqs
        ]);
    }
}
