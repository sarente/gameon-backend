<?php

namespace App\Jobs;

use App\Models\Category;
use App\Models\CustomWorkflow;
use App\Models\User;
use App\Models\UserWorkflow;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

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
        //Add category to user////////////////////////////////////////
        $categories = Category::pluck('id')->toArray();
        foreach ($categories as $key => $value) {
            if ($value == 1) {
                $this->user->categories()->attach($value, ['enable' => true]);
            } else {
                $this->user->categories()->attach($value);
            }
        }

        //Add workflow to user////////////////////////////////////////
        $workflows = CustomWorkflow::pluck('id')->toArray();
        foreach ($workflows as $key => $value) {
            ///enable for some selected workflows
            switch ($value) {
                case 1:
                case 2:
                case 6:
                    $enabled = true;
                    break;
                default:
                    $enabled = false;
                    break;
            }
            UserWorkflow::create([
                'user_id' => $this->user->id,
                'workflow_id' => $value,
                'enable' => $enabled ?? false,
                //'marking' => "" . Setting::$activity_types[0] . "",
                'marking' => "slide_show",
            ]);
            unset($enabled);
        }
    }

    public function ShouldQueue()
    {
        //\Log::info('run from queue');
    }
}
