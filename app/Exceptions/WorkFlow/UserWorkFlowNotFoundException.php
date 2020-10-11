<?php


namespace App\Exceptions\WorkFlow;
use App\Models\User;
Use  Exception;
use Illuminate\Support\Facades\Log;

class UserWorkFlowNotFoundException extends Exception
{
    /**
     * Report the exception.
     *
     * @return void
     */
    public function report()
    {
        Log::channel('errorlog')->error(trans('workflow.not-found') );
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
        return response()->error('user.workflow-not-fount', [], $request->toArray(), 404);
    }
}
