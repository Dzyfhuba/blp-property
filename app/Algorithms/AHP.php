<?php

namespace App\Algorithms;

use App\Models\Setting;
use Illuminate\Support\Collection;


class AHP
{
    protected static float $randomConsistency = 1.49;

    public static function calculatePairwiseComparison()
    {
        $pairwiseComparison = Setting::first()->pairwise_comparison;

        // dd($pairwiseComparison);
        $normalized = self::normalizeEachCriterion($pairwiseComparison);

        $priority = self::getPriority($normalized);

        $lineQuality = self::getLineQuality($normalized, $priority);

        $consistencyRatio = self::getConsistencyRatio($lineQuality, $priority);

        return [
            'normalized' => $normalized,
            'priority' => $priority,
            'line_quality' => $lineQuality,
            'consistency_ratio' => $consistencyRatio,
        ];
    }

    public static function getConsistencyRatio(Collection $lineQuality, Collection $priority)
    {
        $total = $lineQuality->map(function ($item, $key) use ($priority) {
            return $item * $priority[$key];
        })->sum();

        $n = count(Variables::$criterion);

        $consistencyIndex = ($total - $n) / ($n - 1);

        return $consistencyIndex / self::$randomConsistency;
    }

    public static function getLineQuality(Collection $normalized, Collection $priority)
    {
        return collect($normalized)->map(function ($row, $key1) use ($priority) {
            return collect($row)->map(function ($item) use ($key1, $priority) {
                return $item * $priority[$key1];
            })->sum();
        });
    }

    public static function normalizeEachCriterion(array $data)
    {
        // $criterion = Variables::$criterion;
        $normalized = [];

        foreach ($data as $key1 => $criterion) {
            foreach ($criterion as $key2 => $criteria) {
                $normalized[$key1][$key2] = $criteria / self::getBySubarray($data, $key2)->sum();
            }
        }
        // dd(collect($normalized)->map(fn($e) => self::getBySubarray($normalized, 'price')->sum()));

        return collect($normalized);
    }

    public static function getPriority(Collection $normalized)
    {
        return collect($normalized)->map(fn($e) => array_sum($e) / count(Variables::$criterion));
    }

    public static function getBySubarray(array $data, string $key)
    {
        return collect($data)->map(fn($value) => $value[$key]);
    }
}
