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

class CategoryAssignment implements ShouldQueue
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
            echo ($value);
            if ($value == 1) {
                $this->user->categories()->attach($value, ['enable' => true]);
            } else {
                $this->user->categories()->attach($value);
            }
        }
    }

    public function ShouldQueue()
    {
        //\Log::info('run from queue');
    }
}
