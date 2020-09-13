<?php


namespace App\Exceptions\WorkFlow;
Use  Exception;
use Illuminate\Support\Facades\Log;

class GainBeforeException extends Exception
{
    protected $message = 'An error occurred';
    /**
     * Report the exception.
     *
     * @return void
     */
    public function report($request,\Throwable $exception)
    {
        $this->message=$exception->getMessage();
        Log::error($exception->getMessage(),$request->toArray());

        parent::report($exception);
    }

    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        return response()->error('workflow.gain-before', [], [], 401);
    }
}
