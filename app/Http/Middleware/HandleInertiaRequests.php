<?php

namespace App\Http\Middleware;

use App\Models\Setting;
use App\Models\Widget;
use Illuminate\Http\Request;
use Inertia\Middleware;
use Tightenco\Ziggy\Ziggy;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        // $widgets = Widget::all();

        $setting = Setting::first(['contacts', 'marketing_executives', 'social_medias', 'address', 'google_maps_url']);
        return [
            ...parent::share($request),
            'auth' => [
                'user' => $request->user(),
            ],
            'setting' => $setting,
            // 'widgets' => $widgets,
            'ziggy' => fn () => [
                ...(new Ziggy)->toArray(),
                'location' => $request->url(),
            ],
        ];
    }
}
