<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Activity;
use App\Models\Category;
use App\Models\CustomWorkflow;
use App\Models\User;
use App\Models\Workflow\UserWorkflow;
use App\Models\Workflow\Workflow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;
use ZeroDaHero\LaravelWorkflow\Exceptions\DuplicateWorkflowException;

class WorkflowController extends Controller
{
    public function index()
    {
        return response()->success(CustomWorkflow::get());
    }

    public function store(Request $request)
    {
        $workflow_name = $request->only('name');
        $workflow = CustomWorkflow::where('name', $workflow_name)->exists();

        if ($workflow) {
            return response()->error('workflow.name-valid');
        }

        $category = Category::find($request->category_id);

        $workflow = new CustomWorkflow($request->input());
        $workflow->category()->associate($category);
        $workflow->save();

        return response()->success($workflow);
    }

}
