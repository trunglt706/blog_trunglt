<?php

namespace App\Http\Middleware;

use Closure;

class checkUserActive {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if (auth()->user()->status != 1) {
            return redirect()->route('user.index');
        } return $next($request);
    }

}
