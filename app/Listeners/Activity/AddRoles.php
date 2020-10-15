<?php
/**
 * Created by PhpStorm.
 * User: Jawad Fathi
 * Date: 9/24/2019
 * Time: 4:29 PM
 */

namespace App\Listeners\Activity;

use App\Events\ActivitySaved;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class AddRoles implements ShouldQueue
{
    use InteractsWithQueue;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    /**
     * Handle the event.
     *
     * @param  ActivitySaved  $event
     * @return void
     */
    public function handle(ActivitySaved $event)
    {
        // get project
        $model = $event->project;
        Log::info('Log from event listener '.$model->id);

    }
}
