<?php

namespace App\Http\Middleware;

use Closure;

class UsersMiddleware
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
        if($request->users <> 'admin'){
            return redirect('login');
        }
        // Pre-Middleware Action

        $response = $next($request);

        // Post-Middleware Action

        return $response;
    }
}
