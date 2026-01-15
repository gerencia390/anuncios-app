<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ListaBlancaMiddleware
{
    /**
     * @var string[]
     */
    public $whitelistIps = [
        // '192.168.120.112'
        '186.121.247.106'
    ];

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!in_array($request->getClientIp(), $this->whitelistIps)) {
            abort(403, "El acceso al sitio está restringido.");
        }

        return $next($request);
    }
}
