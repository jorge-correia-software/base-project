<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class HandleInvalidSessionData
{
    /**
     * Handle an incoming request.
     *
     * Catch UUID type mismatch errors from invalid session data and gracefully logout.
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            // Attempt to get the authenticated user
            // This will trigger the UUID error if session contains invalid data
            if (Auth::check()) {
                $user = Auth::user();

                // Verify user ID is a valid UUID
                if (!$this->isValidUuid($user->id)) {
                    $this->handleInvalidSession($request);
                    return $this->redirectToLogin($request, 'Invalid session data. Please log in again.');
                }
            }

            return $next($request);

        } catch (Throwable $e) {
            // Check if this is a UUID-related error
            if ($this->isUuidError($e)) {
                Log::warning('Invalid session data detected - UUID type mismatch', [
                    'error' => $e->getMessage(),
                    'session_id' => session()->getId(),
                ]);

                $this->handleInvalidSession($request);
                return $this->redirectToLogin($request, 'Your session has expired. Please log in again.');
            }

            // Re-throw if it's not a UUID error
            throw $e;
        }
    }

    /**
     * Check if the exception is related to UUID type mismatch.
     */
    protected function isUuidError(Throwable $e): bool
    {
        $message = $e->getMessage();

        return str_contains($message, 'invalid input syntax for type uuid') ||
               str_contains($message, 'Invalid text representation') ||
               str_contains($message, 'SQLSTATE[22P02]');
    }

    /**
     * Validate UUID format.
     */
    protected function isValidUuid(string $uuid): bool
    {
        $pattern = '/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/i';
        return (bool) preg_match($pattern, $uuid);
    }

    /**
     * Handle invalid session by logging out and clearing session.
     */
    protected function handleInvalidSession(Request $request): void
    {
        // Logout the user
        Auth::logout();

        // Invalidate the session
        $request->session()->invalidate();

        // Regenerate CSRF token
        $request->session()->regenerateToken();
    }

    /**
     * Redirect to login with flash message.
     */
    protected function redirectToLogin(Request $request, string $message): Response
    {
        // For API requests, return JSON
        if ($request->expectsJson()) {
            return response()->json([
                'message' => $message,
                'redirect' => route('signin')
            ], 401);
        }

        // For web requests, redirect with flash message
        return redirect()->route('signin')->with('status', $message);
    }
}
