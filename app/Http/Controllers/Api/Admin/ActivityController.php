<?php

namespace App\Http\Controllers\Api\Admin;

use App\Exceptions\Activity\ActivityResultNotFoundException;
use App\Exceptions\Activity\ActivityResultWrongAnswerException;
use App\Exceptions\WorkFlow\GainBeforeException;
use App\Exceptions\WorkFlow\UserWorkFlowNotFoundException;
use App\Exceptions\WorkFlow\WorkFlowNotFoundException;
use App\Http\Controllers\Controller;
use App\Models\ActivityResult;
use App\Models\CustomWorkflow;
use App\Models\Setting;
use App\Models\User;
use App\Models\UserPoint;
use App\Models\UserWorkflow;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Workflow\Exception\LogicException;

class ActivityController extends Controller
{
    public function getActivityKinds(){
        return response()->success(Setting::$activity_types);
    }
}
