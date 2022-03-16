<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;

class Localization
{
    public function handle($request, Closure $next)
    {
//        Arr::add(['test' => 'tedt']);

        return $next($request);
    }
}
