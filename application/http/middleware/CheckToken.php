<?php

namespace app\http\middleware;

class CheckToken
{
    public function handle($request, \Closure $next)
    {
        return $next($request);
    }
}
