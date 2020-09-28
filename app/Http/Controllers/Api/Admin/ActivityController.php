<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Setting;

class ActivityController extends Controller
{
    public function index()
    {
        $kind = request()->get('kind');
        if (!is_null($kind)) {
            $activities = Activity::where('type', $kind)->get();
        } else {
            $activities = Activity::get();
        }
        return response()->success($activities);
    }

    public function getActivityKinds()
    {
        return response()->success(Setting::$activity_types);
    }
}
