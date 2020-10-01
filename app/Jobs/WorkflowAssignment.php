<?php

namespace App\Jobs;

use App\Models\CustomWorkflow;
use App\Models\Setting;
use App\Models\User;
use App\Models\UserWorkflow;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class WorkflowAssignment implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $user;
    private $date;

    /* Create a new job instance.
    * @return void
    */
    public function __construct(User $user, Carbon $date = null)
    {
        $this->user = $user;
        $this->date = $date ?? Carbon::now();
    }

    /**
     * Execute the job.
     * @return void
     */
    public function handle()
    {
        //Add workflow to user////////////////////////////////////////
        $workflows = CustomWorkflow::pluck('id')->toArray();
        foreach ($workflows as $workflow) {
            UserWorkflow::create([
                'user_id' => $this->user->id,
                'workflow_id' => $workflow,
                //'marking' => "" . Setting::$activity_types[0] . "",
                'marking' => "slide-show",
            ]);
        }
    }

    public function failed(\Exception $exception)
    {
        Log::channel('errorlog')->error($exception->getMessage());
    }


    public function ShouldQueue()
    {
        //\Log::info('run from queue');
    }
}
