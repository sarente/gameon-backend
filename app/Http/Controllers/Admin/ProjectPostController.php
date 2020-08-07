<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Web\ProjectRequest;
use App\Models\Image;
use App\Models\Post;
use App\Models\Project;
use App\Models\Rosette;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManager;

class ProjectPostController extends Controller
{
    protected $transPrefix = 'models.project.';
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index($id)
    {
        $project = Project::find($id);

        $posts = $project->with('posts.image')->get()->toArray();


        return view('admin.projects.index', compact('posts'))->with('transPrefix', $this->transPrefix);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        $rosettes = Rosette::listsTranslations('name')->pluck('name','id')->toArray();
        $students = User::role('student')->pluck('name','id')->toArray();
        $teachers = User::role('teacher')->pluck('name','id')->toArray();

        return view('admin.projects.create')->with([
            'rosettes'=>$rosettes,
            'students'=>$students,
            'teachers'=>$teachers,
            'transPrefix'=> $this->transPrefix
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return void
     */
    public function store(ProjectRequest $request)
    {
        $user = $request->user();
        $project_name = $request->only('name');
        $project = Project::whereTranslationLike('name', $project_name)->exists();

        if ($project) {
            return response()->error('project.name-valid');
        }

        try {
            $project = new Project($request->input());
            $project->user()->associate($user);
            $project->save();

            if ($request->hasFile('image')) {
                $project->image()->save(new Image([
                    'image' => $request->file('image'),
                ]));
            }
            if ($request->input('image_url')) {
                $project->image()->save(new Image([
                    'image' => ImageManager::make($request->input('image_url')),
                ]));
            }


            $rosettes = Rosette::find($request->input('rosette_ids'));
            if($rosettes){
                $project->rosettes()->attach($rosettes);
            }

            $students = User::find($request->input('student_ids'));
            if($students) {
                $project->members()->attach($students, ['is_member' => true]);
            }

            $teachers = User::find($request->input('teacher_ids'));
            if($teachers) {
                $project->members()->attach($teachers, ['is_member' => true]);
            }

//            foreach ($teachers as $teacher) {
//                $teacher->givePermissionTo([
//                    Setting::PERMISSION_PROJECT_ACCEPT . '-' . $project->id,
//                    Setting::PERMISSION_PROJECT_DONE . '-' . $project->id,
//                    Setting::PERMISSION_PROJECT_DELETE . '-' . $project->id,
//                    Setting::PERMISSION_PROJECT_UPDATE . '-' . $project->id,
//                ]);
//            }

        } catch (\Exception $exception) {
            return response()->error($exception->getMessage());
        }


        return redirect('admin/projects')->with('flash_message', 'Project added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function show($id)
    {
        $project = Project::find($id);
        if (!$project) {
            return response()->error('error.not-found');
        }

        $project = $project->load([
            'claims',
            'rosettes.image',
            'steps',
            'image',
            'posts.user',
            'posts.image',
            'posts.likes.user',
            'posts.comments.user',
            'posts.comments.likes.user',
        ])->load([
            'members',
            'members.roles' => function ($role) {
                $role->where('name', 'teacher')->orWhere('name', 'student')->select('name');
            }]);

        return view('admin.projects.show', compact('project'))->with('transPrefix', $this->transPrefix);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function edit($id)
    {
        $project = Project::findOrFail($id);

        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int      $id
     *
     * @return void
     */
    public function update(ProjectRequest $request, $id)
    {

        $data = $request->all();

        $project = Project::findOrFail($id);
        $project->update($data);


        return redirect('admin/projects')->with('flash_message', 'Project updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function destroy($id)
    {
        Project::destroy($id);

        return redirect('admin/projects')->with('flash_message', 'Project deleted!');
    }
}
