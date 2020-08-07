<?php

namespace App\Http\Controllers\Admin;

use App\Models\Task;
use App\Models\TaskStep;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TaskController extends Controller
{
    protected $transPrefix = 'models.task.';

    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 15;

        if (!empty($keyword)) {
            $tasks = Task::where('name', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $tasks = Task::orderBy('id', 'ASC')->paginate($perPage);
        }

        return view('admin.tasks.index', compact('tasks'))->with('transPrefix', $this->transPrefix);
    }

    public function create()
    {
        $artifacts = trans('models.artifact');
        $actions = trans('models.actions');//return $actions;

        return view('admin.tasks.create')->with([
            'transPrefix'=> $this->transPrefix,
            'actions' => $actions
        ]);
    }

    public function store(Request $request)
    {
        $user = $request->user();

        $task = new Task($request->input());
        $task->is_completed = false;
        $task->save();

        $sub_task = new TaskStep($request->input());
        $sub_task->is_completed = false;

        $task->details()->save($sub_task);

        return redirect('admin/task')->with('flash_message', 'Task added!');
    }

    public function show($id)
    {
        $task = Task::find($id);

        return view('admin.tasks.show', compact('task'))->with([
            'transPrefix' => $this->transPrefix,
        ]);
    }

    public function edit($id)
    {
        $task = Task::find($id);

        return view('admin.tasks.edit', compact('task'))->with([
            'transPrefix' => $this->transPrefix,
        ]);
    }

    public function destroy($id)
    {
        Task::destroy($id);

        return redirect('admin/task')->with('flash_message', 'Task deleted!');
    }
}
