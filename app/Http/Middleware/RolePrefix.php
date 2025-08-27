<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RolePrefix
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::guard('api')->user();

        if (!$user) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }

        $requestedPrefix = $request->route('dynamic_prefix');
        $allowedPrefix = null;

        if ($user->role === ADMIN_ROLE) {
            $allowedPrefix = 'admin';
        } elseif ($user->role === USER_ROLE) {
            $allowedPrefix = 'customer';
        } else {
            return response()->json(['error' => 'Unknown user role'], 403);
        }

        if ($requestedPrefix !== $allowedPrefix) {
            return response()->json([
                'error' => 'Unauthorized for this prefix',
                'message' => "Your role ({$user->role}) cannot access prefix: {$requestedPrefix}"
            ], 403);
        }

        $request->attributes->add(['validated_prefix' => $allowedPrefix]);

        return $next($request);
    }
}
