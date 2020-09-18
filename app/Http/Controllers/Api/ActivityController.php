<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Category;
use App\Models\CustomWorkflow;
use App\Models\Reward;
use App\Models\User;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index()
    {
        $workflows = Workflow::all();

        if (!$workflows) {
            return response()->error('error.not-found');
        }
        return response()->success($workflows->load('category'));
    }

    public function doActivity($workflow,$activity)
    {
        $workflow = CustomWorkflow::where('id', $workflow)->exists();

        if (!$workflow) {
            return response()->error('workflow.name-valid');
        }

        return response()->success($workflow);
    }

}
