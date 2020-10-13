<?php


namespace App\Exceptions\Token;

use Exception;
use Illuminate\Support\Facades\Log;

class TokenInvalidException extends Exception
{
    protected $message = 'An error occurred';

    /**
     * Report the exception.
     * @return void
     */
    public function report()
    {
        Log::channel('errorlog')->error(multi_implode($this->getTrace()[0], ','));
    }

    /**
     * Render the exception into an HTTP response.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        $this->report();
        return response()->error('auth.token_invalid', [], $request->toArray(), 401);
    }
}
