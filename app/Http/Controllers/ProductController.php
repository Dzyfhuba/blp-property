<?php

namespace App\Http\Controllers;

use App\Algorithms\Smarter;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
  protected $columns = [
    'price',
    'bedrooms',
    'bathrooms',
    'floors',
    'facility',
    'public_facility',
    'land_size',
    'building_size',
    'location',
    'design',
  ];

  public function index(Request $request)
  {
    $search = $request->query('search');
    if ($this->checkIfAllColumnsInSearch($search)) {
        ['total' => $total] = Smarter::single($search);
        dd($total);
    }

    $query = Product::query();

    $query->with('category');
    return inertia('Products', [
      'data' => $query->get()
    ]);
  }

  function checkIfAllColumnsInSearch(array $search): bool
  {
    foreach ($search as $key => $string) {
      if (in_array($key, $this->columns)) {
        return true;
      }
    }
    return false;
  }
}
