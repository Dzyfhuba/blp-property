<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $data = Category::all();
        return inertia('Projects', [
            'data' => $data,
        ]);
    }
}
