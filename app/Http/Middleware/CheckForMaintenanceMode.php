<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode as Middleware;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class CheckForMaintenanceMode extends Middleware
{

    public function handle($request, Closure $next)
    {
//        throw new HttpException(503);

        return $next($request);
    }
}
