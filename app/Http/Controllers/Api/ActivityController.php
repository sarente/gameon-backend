<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\Activity\ActivityNotFoundException;
use App\Http\Controllers\Controller;
use App\Models\Activity;

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

    //do-action
    public function proceed($workflow,$activity)
    {
        
    }

    //return-value
    public function verify($workflow,$activity)
    {

    }
}
