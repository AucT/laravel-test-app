<?php

namespace App\Http\Middleware;

use Closure;

class MustBeUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $user = $request->user();

        if ($user && $user->is_admin != 1) {
            return $next($request);
        }
        return redirect()->route('admin');
    }
}
