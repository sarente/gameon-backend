<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Activity;
use App\Models\User;
use App\Models\Workflow\UserWorkflow;
use App\Models\Workflow\Workflow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;
use ZeroDaHero\LaravelWorkflow\Exceptions\DuplicateWorkflowException;

class WorkflowController extends Controller
{
    public function index(Request $request)
    {
        $act = Activity::inRandomOrder()->first();

        dump($act->workflow_transitions());
    }
}
