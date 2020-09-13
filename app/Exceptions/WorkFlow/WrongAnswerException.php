<?php


namespace App\Exceptions\WorkFlow;
use App\Models\User;
Use  Exception;
use Illuminate\Support\Facades\Log;

class WrongAnswerException extends Exception
{
    /**
     * Report the exception.
     *
     * @return void
     */
    public function report()
    {
        Log::channel('errorlog')->error( trans('workflow.wrong-answer'). PHP_EOL . multi_implode ($this->getTrace()[0],','));
        Log::channel('errorlog')->error(trans('workflow.wrong-answer') . PHP_EOL .substr($this->getTraceAsString(),1,118));
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
        return response()->error('workflow.wrong-answer', [], $request->toArray(), 404);
    }
}
