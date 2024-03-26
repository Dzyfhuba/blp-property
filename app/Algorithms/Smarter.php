<?php

namespace App\Algorithms;

use App\Models\Model;
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

        $modelLatest = Model::latest();

        $productsWithCriterion = $products->map(function ($product) use ($points, $weights) {
            return [
                'id' => $product->id,
                'criterion' => collect([
                    'price' => $weights['price'] * 100 * (
                        (self::priceCriteria($product->price) - $points['price']['min']) /
                        ($points['price']['max'] - $points['price']['min'])),
                    'bedrooms' => $weights['bedrooms'] * 100 * (
                        (self::bedroomsCriteria($product->bedrooms) - $points['bedrooms']['min']) /
                        ($points['bedrooms']['max'] - $points['bedrooms']['min'])),
                    'bathrooms' => $weights['bathrooms'] * 100 * (
                        (self::bathroomsCriteria($product->bathrooms) - $points['bathrooms']['min']) /
                        ($points['bathrooms']['max'] - $points['bathrooms']['min'])),
                    'floors' => $weights['floors'] * 100 * (
                        (self::floorsCriteria($product->floors) - $points['floors']['min']) /
                        ($points['floors']['max'] - $points['floors']['min'])),
                    'facility' => $weights['facility'] * 100 * (
                        ($product->facility->value - $points['facility']['min']) /
                        ($points['facility']['max'] - $points['facility']['min'])),
                    'public_facility' => $weights['public_facility'] * 100 * (
                        ($product->publicFacility->value - $points['public_facility']['min']) /
                        ($points['public_facility']['max'] - $points['public_facility']['min'])),
                    'land_size' => $weights['land_size'] * 100 * (
                        (self::landSizeCriteria($product->land_size) - $points['land_size']['min']) /
                        ($points['land_size']['max'] - $points['land_size']['min'])),
                    'building_size' => $weights['building_size'] * 100 * (
                        (self::buildingSizeCriteria($product->building_size) - $points['building_size']['min']) /
                        ($points['building_size']['max'] - $points['building_size']['min'])),
                    'location' => $weights['location'] * 100 * (
                        ($product->location->value - $points['location']['min']) /
                        ($points['location']['max'] - $points['location']['min'])),
                    'design' => $weights['design'] * 100 * (
                        ($product->design->value - $points['design']['min']) /
                        ($points['design']['max'] - $points['design']['min'])),
                ])
            ];
        });
        $model = $productsWithCriterion->map(function($product) use ($modelLatest) {
            return [
                'product_id' => $product['id'],
                'batch' => ($modelLatest->count() ? $modelLatest->batch : 0) + 1,
                'criterion' => $product['criterion']->toArray(),
                'total' => $product['criterion']->sum()
            ];
        });

        return $model->toArray();
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
