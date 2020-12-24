<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;

class NotDesignerMiddleware
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
        $authorized = auth()->user()->role_id !== User::DESIGNER;

        if ($authorized) {
            return $next($request);
        }
        
        return response()->json(['error' => "En tant que designer l'accès est interdit."], 403);
    }
}
