<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Hero;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $heroes = Hero::query()
            ->inRandomOrder(now()->day)
            ->get();
        return inertia('Dashboard', [
            'categories' => $categories,
            'heroes' => $heroes,
        ]);
    }

    public function paper()
    {
        return inertia('Paper');
    }
}
