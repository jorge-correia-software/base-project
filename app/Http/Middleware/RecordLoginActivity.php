<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RecordLoginActivity
{
    /**
     * Handle an incoming request.
     *
     * Record login activity for authenticated users.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $guard = null): Response
    {
        if (auth($guard)->check()) {
            $user = auth($guard)->user();

            // Record login if last_login_at is null or was more than 5 minutes ago
            if (!$user->last_login_at || $user->last_login_at->diffInMinutes(now()) > 5) {
                if ($guard === 'vaste' && method_exists($user, 'recordLogin')) {
                    $user->recordLogin($request->ip());
                } elseif (method_exists($user, 'updateLastLogin')) {
                    $user->updateLastLogin();
                } else {
                    $user->update([
                        'last_login_at' => now(),
                        'last_login_ip' => $request->ip()
                    ]);
                }
            }
        }

        return $next($request);
    }
}
