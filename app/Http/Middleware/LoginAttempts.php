<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\FailedLogin;
use Carbon\Carbon;

class LoginAttempts
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $email = $request->input('email');
        $failedLogin = FailedLogin::where('email', $email)->first();

        if ($failedLogin && $failedLogin->disabled_login == 1) {
            $lockoutTime = Carbon::parse($failedLogin->lockout_time);
            if (Carbon::now()->lessThan($lockoutTime)) {
                return response()->json([
                    'error' => 'Too many login attempts. Please try again later.',
                    'lockout_time' => $lockoutTime->timestamp,
                ], 429);
            } else {
                $failedLogin->lockout_time = null;
                $failedLogin->disabled_login = 0;
                $failedLogin->save();
            }
        }

        return $next($request);
    }
}
