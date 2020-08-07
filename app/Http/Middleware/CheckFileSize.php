<?php

namespace App\Http\Middleware;

use Closure;

class CheckFileSize
{
    /**
     * Handle an incoming image request.
     * @param  \Illuminate\Http\Request $request
     * @param  Closure $next
     * @param  string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        foreach ($request->file() as $file) {
            $size = $file->getSize(); // size in bytes!
            //$extension = $request->file->getClientOriginalExtension();
            $onemb = pow(2, 20) * 10; // equal 10 mg

            if ($size > $onemb) {
                return response()->error('common.file-size');
            }
        }
        return $next($request);
    }
}
