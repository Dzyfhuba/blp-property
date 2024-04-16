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
}
