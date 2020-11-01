<?php

namespace App\Http\Controllers\Api\Admin;

use App\Exceptions\WorkFlow\WorkFlowNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Request;
use App\Models\CustomWorkflow;

class WorkflowController extends Controller
{
    public function index()
    {
        return response()->success(CustomWorkflow::get());
    }

    public function show($id)
    {
        $workflow = CustomWorkflow::find($id);
        if (!$workflow) {
            throw new WorkFlowNotFoundException();
        }
        return response()->success($workflow);
    }

    public function store(Request $request)
    {
        CustomWorkflow::create($request->json()->all());
        return response()->success('common.success');
    }

    public function update(Request $request, $id)
    {
        $model = CustomWorkflow::findOrFail($id);
        $model->update($request->json()->all());
        return response()->success('common.success');
    }

}
