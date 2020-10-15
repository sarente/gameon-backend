<?php

namespace App\Jobs;

use App\Models\Category;
use App\Models\User;
use App\Models\UserPoint;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class PointMaker implements ShouldQueue
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
        $categories = Category::pluck('id')->toArray();
        foreach ($categories as $category) {
            UserPoint::create([
                'user_id' => $this->user->id,
                'category_id' => $category,
                'point' => 15
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
