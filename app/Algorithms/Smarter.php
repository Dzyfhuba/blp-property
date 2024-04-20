<?php

namespace App\Algorithms;

use App\Models\Model;
use App\Models\Product;
use App\Models\SearchLog;
use App\Models\Setting;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class Smarter
{

    public static function single(array $criterion)
    {
        $log = [
            'user_ip' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'model_batch' => Setting::first()->batch,
            'criterion' => $criterion,
        ];

        $latestSameSearchIn10Minutes = SearchLog::query()
            ->where(array_diff_key($log, ['criterion' => '']))
            ->whereJsonContains('criterion', $criterion)
            // ->whereDate('updated_at', '>=', now()->subMinutes(10))
            ->latest()->first();

        if ($latestSameSearchIn10Minutes && $latestSameSearchIn10Minutes->updated_at->greaterThanOrEqualTo(now()->subMinutes(10))) {
            $latestSameSearchIn10Minutes->updateTimestamps();
            $latestSameSearchIn10Minutes->save();
            return $latestSameSearchIn10Minutes;
        }

        $weights = Setting::first()->model->pairwise_comparison_priority;
        // dd($weights->model->pairwise_comparison_priority);

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

        $utilities = collect([
            'price' => self::normalizedUtility(
                $weights['price'],
                $criterion['price'],
                $points['price']['min'],
                $points['price']['max'],
            ),
            'bedrooms' => self::normalizedUtility(
                $weights['bedrooms'],
                $criterion['bedrooms'],
                $points['bedrooms']['min'],
                $points['bedrooms']['max'],
            ),
            'bathrooms' => self::normalizedUtility(
                $weights['bathrooms'],
                $criterion['bathrooms'],
                $points['bathrooms']['min'],
                $points['bathrooms']['max'],
            ),
            'floors' => self::normalizedUtility(
                $weights['floors'],
                $criterion['floors'],
                $points['floors']['min'],
                $points['floors']['max'],
            ),
            'facility' => self::normalizedUtility(
                $weights['facility'],
                $criterion['facility'],
                $points['facility']['min'],
                $points['facility']['max'],
            ),
            'public_facility' => self::normalizedUtility(
                $weights['public_facility'],
                $criterion['public_facility'],
                $points['public_facility']['min'],
                $points['public_facility']['max'],
            ),
            'land_size' => self::normalizedUtility(
                $weights['land_size'],
                $criterion['land_size'],
                $points['land_size']['min'],
                $points['land_size']['max'],
            ),
            'building_size' => self::normalizedUtility(
                $weights['building_size'],
                $criterion['building_size'],
                $points['building_size']['min'],
                $points['building_size']['max'],
            ),
            'location' => self::normalizedUtility(
                $weights['location'],
                $criterion['location'],
                $points['location']['min'],
                $points['location']['max'],
            ),
            'design' => self::normalizedUtility(
                $weights['design'],
                $criterion['design'],
                $points['design']['min'],
                $points['design']['max'],
            ),
        ]);

        $log = array_merge(
            $log,
            ['total' => $utilities->sum()]
        );

        $searchLog = SearchLog::create($log);

        return $searchLog;
    }

    public static function getClosestProductQuery(Builder $productQuery, $search)
    {
        ['id' => $searchId, 'total' => $total] = Smarter::single($search);

        $query = $productQuery
            ->join('models', 'models.product_id', '=', 'products.id')
            ->where('models.batch', Setting::first()->batch)
            ->select(['products.*'])
            ->selectRaw('(ABS(models.total - ?)) as total_delta', [$total])
            ->withCasts([
                'total_delta' => 'float'
            ])
            ->orderByRaw('(ABS(models.total - ?))', [$total]);
        return ['query' => $query, 'search_id' => $searchId];
    }

    public static function generateWeights(array $weights)
    {
        $products = Product::all();

        // $weights = Setting::first()->weight_product_criterion;

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

        $productsWithCriterion = $products->map(function ($product) use ($points, $weights) {
            return [
                'product_id' => $product->id,
                'criterion' => collect([
                    'price' => self::normalizedUtility(
                        $weights['price'],
                        self::priceCriteria($product->price),
                        $points['price']['min'],
                        $points['price']['max'],
                    ),
                    'bedrooms' => self::normalizedUtility(
                        $weights['bedrooms'],
                        self::bedroomsCriteria($product->bedrooms),
                        $points['bedrooms']['min'],
                        $points['bedrooms']['max'],
                    ),
                    'bathrooms' => self::normalizedUtility(
                        $weights['bathrooms'],
                        self::bathroomsCriteria($product->bathrooms),
                        $points['bathrooms']['min'],
                        $points['bathrooms']['max'],
                    ),
                    'floors' => self::normalizedUtility(
                        $weights['floors'],
                        self::floorsCriteria($product->floors),
                        $points['floors']['min'],
                        $points['floors']['max'],
                    ),
                    'facility' => self::normalizedUtility(
                        $weights['facility'],
                        $product->facility_option_id,
                        $points['facility']['min'],
                        $points['facility']['max'],
                    ),
                    'public_facility' => self::normalizedUtility(
                        $weights['public_facility'],
                        $product->public_facility_option_id,
                        $points['public_facility']['min'],
                        $points['public_facility']['max'],
                    ),
                    'land_size' => self::normalizedUtility(
                        $weights['land_size'],
                        self::landSizeCriteria($product->land_size),
                        $points['land_size']['min'],
                        $points['land_size']['max'],
                    ),
                    'building_size' => self::normalizedUtility(
                        $weights['building_size'],
                        self::buildingSizeCriteria($product->building_size),
                        $points['building_size']['min'],
                        $points['building_size']['max'],
                    ),
                    'location' => self::normalizedUtility(
                        $weights['location'],
                        $product->location_option_id,
                        $points['location']['min'],
                        $points['location']['max'],
                    ),
                    'design' => self::normalizedUtility(
                        $weights['design'],
                        $product->design_option_id,
                        $points['design']['min'],
                        $points['design']['max'],
                    ),
                ])
            ];
        });
        // $modelLatest = Model::query()->orderBy('id', 'desc');
        // // dd($modelLatest->first()->batch);
        // $model = $productsWithCriterion->map(function ($product) use ($modelLatest) {
        //     return [
        //         'product_id' => $product['id'],
        //         'batch' => ($modelLatest->count() ? $modelLatest->first()->batch : 0) + 1,
        //         'criterion' => $product['criterion']->toArray(),
        //         'total' => $product['criterion']->sum()
        //     ];
        // });

        return $productsWithCriterion;
    }

    public static function normalizedUtility(float $weight, float $value, int $min = 1, int $max = 3)
    {
        return $weight * 100 * (
            ($value - $min) /
            ($max - $min)
        );
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

    // public static function locationSizeCriteria(int $buildingSize)
    // {
    //     return $buildingSize < 2 ? 3 : (
    //         $buildingSize <= 5 ? 2 : 1
    //     );
    // }
}
