<?php


namespace App\Exceptions\Category;
use App\Models\User;
Use  Exception;
use Illuminate\Support\Facades\Log;

class CategoryNotFoundException extends Exception
{
    /**
     * Report the exception.
     *
     * @return void
     */
    public function report()
    {
        Log::channel('errorlog')->error(trans('category.not-found') . PHP_EOL .substr($this->getTraceAsString(),1,118));
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
        return response()->error('category.not-found', [], $request->toArray(), 404);
    }
}
