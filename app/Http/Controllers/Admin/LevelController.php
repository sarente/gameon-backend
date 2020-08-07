<?php

namespace App\Http\Controllers\Admin;

use App\Models\Image;
use App\Models\Level;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LevelController extends Controller
{
    protected $transPrefix = 'models.levels.';

    public function index()
    {
        $levels = Level::all();

        return view('admin.levels.index', compact('levels'))->with('transPrefix', $this->transPrefix);
    }

    public function create()
    {
        $artifacts = array_combine(trans('models.artifact'),trans('models.artifact'));

        return view('admin.levels.create')->with([
            'transPrefix'=> $this->transPrefix,
            'artifacts' => $artifacts
        ]);
    }

    public function store(Request $request)
    {
        $level = new Level($request->all());
        $level->save();

        if ($request->hasFile('image')) {
            $level->image()->save(new Image([
                'image' => $request->file('image'),
            ]));
        }

        return redirect('admin/levels')->with('flash_message', 'Level added!');
    }

    public function show($id)
    {
        $level = Level::find($id);

        return view('admin.levels.show', compact('level'))->with('transPrefix', $this->transPrefix);
    }

    public function edit($id)
    {
        $level = Level::find($id);
        $artifacts = [
            $level->artifact => $level->artifact
        ];

        return view('admin.levels.edit', compact('level'))->with([
            'transPrefix'=> $this->transPrefix,
            'artifacts' => $artifacts
        ]);
    }

    public function update(Request $request, $id)
    {
        $level = Level::find($id);

        if ($request->hasFile('image')) {
            $level->image()->delete();
            $level->image()->save(new Image([
                'image' => $request->file('image'),
            ]));
        }

        $level->update($request->all());

        return redirect('admin/levels')->with('flash_message', 'Level updated!');
    }

    public function destroy($id)
    {
        Level::destroy($id);

        return redirect('admin/levels')->with('flash_message', 'Level deleted!');
    }
}
