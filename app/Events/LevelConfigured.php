<?php
/**
 * Created by PhpStorm.
 * User: Jawad Fathi
 * Date: 9/24/2019
 * Time: 3:05 PM
 */

namespace App\Events;

use App\Http\Requests\Request;
use App\Models\Level;
use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class LevelConfigured extends Event
{
    use SerializesModels;
    public $default_datas,
        $level_count,
        $total_xp,
        $education_term,
        //
        $project_xp,
        $project_monthly,
        //
        $task_xp,
        $task_monthly,
        //
        $club_xp,
        $club_monthly,
        //
        $qa_xp,
        $qa_monthly;
        //
        //$square_xp,
        //$square_monthly,
    /**
     * Create a new event instance.
     *
     * @return void
     */

    public function __construct($default_datas) {

        $this->level_count = $default_datas['general']['level_count'];
        $this->total_xp = $default_datas['general']['total_xp'];
        $this->education_term = $default_datas['general']['education_term'];

        $this->project_xp = $default_datas['project']['xp'];
        $this->project_monthly = $default_datas['project']['monthly'];

        $this->task_xp = $default_datas['task']['xp'];
        $this->task_monthly = $default_datas['task']['monthly'];

        $this->club_xp = $default_datas['club']['xp'];
        $this->club_monthly = $default_datas['club']['monthly'];

        $this->qa_xp = $default_datas['question-answer']['xp'];
        $this->qa_monthly = $default_datas['question-answer']['monthly'];

        //$this->square_xp = $default_datas['square']['xp'];
        //$this->square_monthly = $default_datas['square']['monthly'];

    }
}
