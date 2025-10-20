<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        // Check if this is an admin route
        $isAdminRoute = $request->is('admin/*');

        // Get the appropriate user based on the route
        $user = null;
        if ($isAdminRoute && Auth::guard('admin')->check()) {
            $adminUser = Auth::guard('admin')->user();
            $user = [
                'id' => $adminUser->id,
                'name' => $adminUser->name,
                'email' => $adminUser->email,
                'avatar_url' => $adminUser->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($adminUser->name) . '&background=047857&color=fff',
            ];
        } elseif (!$isAdminRoute && Auth::check()) {
            $studentUser = Auth::user();
            $user = [
                'id' => $studentUser->id,
                'name' => $studentUser->name,
                'email' => $studentUser->email,
                'avatar_url' => $studentUser->avatar_url,
                'initials' => $studentUser->initials,
            ];
        }

        return [
            ...parent::share($request),
            'auth' => [
                'user' => $user,
            ],
        ];
    }
}
