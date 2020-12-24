<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->user()->role_id !== User::ADMIN) {
            return response()
            ->json(['error' => "Vous devez être un administrateur"], 403);
        }
        return $next($request);
    }
}
