<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;


class JwtAuth
{
    /**
     * @var Guard
     */
    protected $auth;

    /**
     * AuthenticateApi constructor.
     * @param Guard $auth
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }


    /**
     * Handle an incoming request.
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $bearer = $request->bearerToken();
        if ($bearer) {
            $this->auth->getUserFromToken($bearer);
        }
        return $next($request);
    }
    //TODO: add any kind of data to response
   /* public function terminate($request, $response)
    {
        throw new UserModelNotFoundException();
    }*/
}
