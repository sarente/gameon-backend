<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;
use Throwable;
use Tymon\JWTAuth\Exceptions;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     * @param \Throwable $exception
     * @return void
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     * @param \Illuminate\Http\Request $request
     * @param \Throwable $exception
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof UserModelNotFoundException) {
            if ($request->expectsJson() || $request->acceptsJson()) {
                return response()->error('auth.invalid', [], $request->toArray(), 404);
            }
        }
        elseif ($exception instanceof \Spatie\Permission\Exceptions\UnauthorizedException) {
            if ($request->expectsJson() || $request->acceptsJson()) {
                return response()->error('auth.unauthorised', [], [], 403);
            }
        } elseif ($exception instanceof AuthenticationException) {
            if ($request->expectsJson()|| $request->acceptsJson()) {
                return response()->error('auth.unauthenticated', [], [], 401);
            }
        } elseif ($exception instanceof AuthorizationException) {
            return response()->error('auth.unauthorised', [], [], 403);
        } else if ($exception instanceof ValidationException) {
            return response()->error('common.none-valid', [], [], 404);
        } elseif ($exception instanceof HttpResponseException) {
            if ($request->expectsJson() || $request->acceptsJson()) {
                return response()->error($exception->getMessage(), [], [], 500);
            }
        }/*else if ($exception instanceof ModelNotFoundException) {
            if ($request->expectsJson() || $request->acceptsJson()) {
                //return response()->error($exception->getModel(), [], [], 404);
                throw new UserModelNotFoundException();
            }
            return redirect()->back();
        }
        elseif ($exception instanceof \Exception) {
            if ($request->expectsJson() || $request->acceptsJson()) {
                return response()->error('common.none-valid', [], [], 404);
            }
            return redirect()->back();
        }*/
        return parent::render($request, $exception);
    }
}
