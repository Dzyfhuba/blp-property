<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $data = Blog::all();

        return inertia('Blogs/Index', [
            'data' => $data
        ]);
    }

    public function show(Blog $blog)
    {
        $otherBlogs = Blog::query()
            ->whereNot('id', $blog->id)
            ->inRandomOrder(now()->day)
            ->limit(5)
            ->get();
        return inertia('Blogs/Show', [
            'item' => $blog,
            'other_blogs' => $otherBlogs,
        ]);
    }
}
