<?php

namespace App\Console\Commands;

use App\Models\Setting;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class PointMaker extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:point:maker';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $userCount = $this->query()->count();
        $perPage = 50;
        $pageCount = ceil($userCount / $perPage);

        $start = microtime(true);
        for ($page = 0; $page < $pageCount; $page++) {
            $users = $this->getUsers($page, $perPage);
            /** @var User $user */
            foreach ($users as $user) {
                if ($user->hasRole(Setting::ROLE_USER)) {
                    $this->info( PHP_EOL.$user->id.' '.$user->name.PHP_EOL);
                    \App\Jobs\PointMaker::dispatch($user, Carbon::now())->delay(now()->addSecond(1)); // put to database
                }
            }
            //if ($this->getOutput()->getVerbosity() >= Output::VERBOSITY_DEBUG) {
            $this->info(
                $page . '/' . $pageCount
                . ' - ' . $this->memoryUsage()
                . ' - ' . (int)((microtime(true) - $start))
            );
            //}
        }
    }
    private function query()
    {
        return User::role(\App\Models\Setting::ROLE_USER);
    }

    private function getUsers($page, $perPage)
    {
        return $this->query()
            ->take($perPage)
            ->skip($page * $perPage)
            ->orderBy('id', 'desc')
            ->get();
    }

    function memoryUsage()
    {
        $size = memory_get_usage();
        $unit = ['b', 'kb', 'mb', 'gb', 'tb', 'pb'];
        return @round($size / pow(1024, ($i = floor(log($size, 1024)))), 2) . ' ' . $unit[$i];
    }
}
