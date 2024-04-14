<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return inertia('Dashboard', [
            'categories' => $categories
        ]);
    }

    public function paper()
    {
        return inertia('Paper');
    }
}
