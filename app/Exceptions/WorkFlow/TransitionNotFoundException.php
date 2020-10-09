<?php


namespace App\Exceptions\WorkFlow;
use App\Models\User;
Use  Exception;
use Illuminate\Support\Facades\Log;

class TransitionNotFoundException extends Exception
{
    /**
     * Report the exception.
     *
     * @return void
     */
    public function report()
    {
        Log::channel('errorlog')->error(trans('workflow.transition.not-found') . PHP_EOL .substr($this->getTraceAsString(),1,118));
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
        return response()->error('workflow.transition.not-found', [], $request->toArray(), 404);
    }
}
