<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
  public function index(Request $request)
  {
    // dd($request->query('search'));

    $query = Product::query();

    $query->with('category');
    return inertia('Products', [
      'data' => $query->get()
    ]);
  }
}
