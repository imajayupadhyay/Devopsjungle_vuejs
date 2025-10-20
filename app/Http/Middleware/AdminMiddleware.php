<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth('admin')->check()) {
            // For Inertia requests, return a proper redirect response
            if ($request->header('X-Inertia')) {
                return redirect()->route('admin.login')
                    ->with('error', 'Please login to continue');
            }
            return redirect()->route('admin.login');
        }

        $user = auth('admin')->user();

        if (!$user || !$user->is_admin) {
            abort(403, 'Access denied. Admin privileges required.');
        }

        return $next($request);
    }
}