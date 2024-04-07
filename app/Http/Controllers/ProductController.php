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
    $data = [];

    $query = Product::query();
    if ($search && $this->checkIfAllColumnsInSearch($search)) {
        $data = Smarter::getClosestProductQuery($query, $search);
    }

    $query->with('category');
    $data = $query->get();

    return inertia('Products', [
      'data' => $data
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
