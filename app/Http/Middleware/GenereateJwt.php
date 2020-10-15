<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Str;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\ValidationData;

class GenereateJwt
{/**
 * Handle an incoming request.
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  \Closure  $next
 * @param  int|null  $minutes
 * @return mixed
 */
    public function handle($request, Closure $next, $minutes = null)
    {
        if (! $request->user() && session()->has('token')) {
            session()->forget('token');
        } elseif ($request->user() && (! session('token') || ! $this->validate($request, session('token')))) {
            session()->put('token', $this->issue($request, $minutes));
        }

        return $next($request);
    }

    /**
     * Issue the token.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int|null  $minutes
     * @return string
     */
    protected function issue($request, $minutes)
    {
        $builder = (new Builder)
            ->setId(Str::random())
            ->setIssuer($request->getHost())
            ->setAudience($request->getHost())
            ->setSubject($request->user()->id);

        if ($minutes) {
            $builder->setExpiration(time() + ($minutes * 60));
        }

        return (string) $builder->sign(new Sha256, config('app.key'))->getToken();
    }

    /**
     * Validate the token.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $token
     * @return bool
     */
    protected function validate($request, $token)
    {
        $token = (new Parser)->parse($token);

        $data = new ValidationData;
        $data->setIssuer($request->getHost());
        $data->setAudience($request->getHost());
        $data->setSubject($request->user()->id);

        return $token->validate($data);
    }
}
