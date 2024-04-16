<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Category;
use App\Models\Setting;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        $about = About::first(['title']);
        $setting = Setting::first([
            'contacts',
            'marketing_executives',
            'social_medias',
            'address',
            'google_maps_url',
        ]);

        $aside = array_merge($about->toArray(), $setting->toArray());

        return inertia('Categories/Show', [
            'item' => $category,
            'aside' => $aside,
        ]);
    }
}
