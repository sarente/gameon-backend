<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\Activity\ActivityNotFoundException;
use App\Exceptions\Activity\ActivityWrongAnswerException;
use App\Exceptions\WorkFlow\GainBeforeException;
use App\Exceptions\WorkFlow\UserWorkFlowNotFoundException;
use App\Exceptions\WorkFlow\WorkFlowNotFoundException;
use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\CustomWorkflow;
use App\Models\User;
use App\Models\UserPoint;
use App\Models\UserWorkflow;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Workflow\Exception\LogicException;

class ActivityController extends Controller
{
    public function show($activity)
    {
        $activity = Activity::with('image')->find($activity);
        if (!$activity) {
            throw new ActivityNotFoundException();
        }
        return response()->success($activity);
    }

}
