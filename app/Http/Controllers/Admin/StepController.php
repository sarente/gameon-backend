<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Api\StepRequest;
use App\Models\Project;
use App\Models\Step;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;

class StepController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index($id)
    {
        $project = Project::find($id);

        if (!$project) {
            return response()->error('project.not-found');
        }

        return response()->paginate($project->steps());
    }

    public function create($id)
    {
        $project = Project::find($id);

        return view('admin.projects.steps.create', compact('project'));
    }

    public function edit($project_id, $step_id)
    {
        $project = Project::find($project_id);
        $step = Step::find($step_id);

        return view('admin.projects.steps.edit', compact(['project','step']));
    }

    public function store(StepRequest $request, $project_id)
    {
        $project = Project::find($project_id);

        if (!$project) {
            return response()->error('project.not-found');
        }

        try {
            $step = new Step([
                'step_no'=> $request->step_no,
                'end_date'=> $request->end_date,
                'is_completed'=> $request->is_completed
            ]);
            $step->fill([
                'name:'. App::getLocale()    => $request->name,
                'description:'. App::getLocale() => $request->description,
            ]);
            $project->steps()->save($step);

        } catch (\Exception $exception) {
            return response()->error($exception->getMessage());
        }

        return redirect('admin/projects/' . $project_id)->with('flash_message', 'Step added!');
    }

    public function update(StepRequest $request, $project_id, $step_id)
    {
        $step = Step::find($step_id);
        if (!$step) {
            return response()->error('step-not-found');
        }

        $step->update($request->input());

        return redirect('admin/projects/' . $project_id)->with('flash_message', 'Step updated!');
    }

    public function destroy($project_id, $step_id)
    {
        $step = Step::find($step_id);
        if (!$step) {
            return response()->error('step-not-found');
        }

        $step->delete();

        return redirect('admin/projects/' . $project_id)->with('flash_message', 'Step deleted!');
    }

    public function doneStep($id)
    {
        $step = Step::find($id);
        if (!$step) {
            return response()->error('step-not-found');
        }

        $step->update(['is_completed' => true]);

        return response()->success('common.success');
    }
}
