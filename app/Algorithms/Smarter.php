<?php

namespace App\Algorithms;

use App\Models\Product;
use App\Models\Setting;

class Smarter
{
    public static function generateModel()
    {
        $products = Product::all();

        $weights = Setting::first()->weight_product_criterion;

        $points = collect([
            'price' => ['min' => 1, 'max' => 3],
            'bedrooms' => ['min' => 1, 'max' => 3],
            'bathrooms' => ['min' => 1, 'max' => 2],
            'floors' => ['min' => 1, 'max' => 2],
            'facility' => ['min' => 1, 'max' => 3],
            'public_facility' => ['min' => 1, 'max' => 3],
            'land_size' => ['min' => 1, 'max' => 3],
            'building_size' => ['min' => 1, 'max' => 3],
            'location' => ['min' => 1, 'max' => 3],
            'design' => ['min' => 1, 'max' => 3],
        ]);

        $criterion = $products->map(function ($product, $idx) {
            return [
                'price' => self::priceCriteria($product->price),
                'bedrooms' => self::bedroomsCriteria($product->bedrooms),
                'bathrooms' => self::bathroomsCriteria($product->bathrooms),
                'floors' => self::floorsCriteria($product->floors),
                'facility' => $product->facility->value,
                'public_facility' => $product->publicFacility->value,
                'land_size' => self::landSizeCriteria($product->land_size),
                'building_size' => self::buildingSizeCriteria($product->building_size),
                'location' => $product->location->value,
                'design' => $product->design->value,
            ];
        });

        return $criterion;
    }

    public static function priceCriteria(int $price)
    {
        if ($price <= 300) {
            return 1;
        } else if ($price < 1000) {
            return 2;
        } else {
            return 3;
        }
    }

    public static function bedroomsCriteria(int $bedrooms)
    {
        if ($bedrooms <= 1) {
            return 1;
        } else if ($bedrooms <= 2) {
            return 2;
        } else {
            return 3;
        }
    }

    public static function bathroomsCriteria(int $bathrooms)
    {
        if ($bathrooms <= 1) {
            return 1;
        } else {
            return 2;
        }
    }

    public static function floorsCriteria(int $floors)
    {
        if ($floors <= 1) {
            return 1;
        } else {
            return 2;
        }
    }

    public static function landSizeCriteria(int $landSize)
    {
        if ($landSize < 60) {
            return 1;
        } else if ($landSize <= 90) {
            return 2;
        } else {
            return 3;
        }
    }

    public static function buildingSizeCriteria(int $buildingSize)
    {
        return $buildingSize <= 30 ? 1 : (
            $buildingSize < 50 ? 2 : 3
        );
    }
}
