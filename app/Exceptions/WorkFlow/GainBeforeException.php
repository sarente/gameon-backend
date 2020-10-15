<?php


namespace App\Exceptions\WorkFlow;
use Exception;
use Illuminate\Support\Facades\Log;

class GainBeforeException extends Exception
{
    /**
     * Report the exception.
     *
     * @return void
     */
    public function report()
    {
        Log::channel('errorlog')->error(trans('workflow.gain-before') . PHP_EOL .substr($this->getTraceAsString(),1,118));
    }

    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        $this->report();
        return response()->error('workflow.gain-before', [], $request->toArray(), 404);
    }
}
