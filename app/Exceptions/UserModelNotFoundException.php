<?php


namespace App\Exceptions;

use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

class UserModelNotFoundException extends ModelNotFoundException
{
    protected $model = User::class;
    /**
     * Report the exception.
     * @return void
     */
    public function report()
    {
        Log::channel('errorlog')->error($this->getModel() . PHP_EOL . $this->multi_implode ($this->getTrace()[0],','));
    }

    /**
     * Render the exception into an HTTP response.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        $this->report();
        return response()->error('common.not-found', [], $request->toArray(), 404);
    }

    public function multi_implode($array, $glue) {
        $ret = '';

        foreach ($array as $key=>$value) {
            if (is_array($value)) {
                $ret .= $key.':'.$this->multi_implode($value, $glue) . $glue;
            } else {
                $ret .= $key.':'.$value . $glue;
            }
        }

        $ret = substr($ret, 0, 0-strlen($glue));

        return $ret;
    }
}
