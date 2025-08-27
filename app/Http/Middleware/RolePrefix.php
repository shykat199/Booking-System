<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RolePrefix
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user) {
            if ($user->role === ADMIN_ROLE) {
                $request->merge(['dynamic_prefix' => 'admin']);
            } elseif ($user->role === USER_ROLE) {
                $request->merge(['dynamic_prefix' => 'customer']);
            }
        }

        return $next($request);
    }
}
