<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CountVisitorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $sessionId = Session::getId();
        $ipAddress = $request->ip();
        $userAgent = $request->userAgent();

        $visitor = DB::table('visitors')
            ->where('ip_address', $ipAddress)
            ->where('user_agent', $userAgent)
            ->first();

        if (!$visitor) {
            DB::table('visitors')->insert([
                'ip_address' => $ipAddress,
                'user_agent' => $userAgent,
                'visited_at' => now(),
            ]);
        }
        return $next($request);
    }
}
