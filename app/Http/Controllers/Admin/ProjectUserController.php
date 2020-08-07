<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectUserController extends Controller
{
    protected $transPrefix = 'models.project.';

    public function create($project_id)
    {
        $project = Project::find($project_id);
        $teachers = User::role('teacher')->pluck('name','id')->toArray();
        $students = User::role('student')->pluck('name','id')->toArray();

        return view('admin.projects.users.create')->with([
            'project'=>$project,
            'teachers'=>$teachers,
            'students'=>$students
        ]);
    }

    /**
     * Adds member to specified project.
     * @param  int $id
     * @param  Request $request
     * @return array
     */
    public function addMember(Request $request, $id)
    {
        $user = $request->user();

        $project = Project::find($id);
        if (!$project) {
            return response()->error('project.not-found');
        }

        $users = User::find($request->input('user_ids'));
        if($users){
            $members = $project->members()->find($request->input('user_ids'));
            $users = $users->diff($members);
        }

        $project->members()->attach($users, [ 'is_member' => true]);

        return view('admin.projects.show' , compact('project'))->with([
            'flash_message'=> 'Member(s) added!',
            'menu' => 'members',
            'link'=> 'members_link',
            'transPrefix'=> $this->transPrefix
        ]);
    }

    /**
     * Delete members of the project.
     * @param  int $id
     * @param Request $request
     * @return array
     */
    public function deleteMember(Request $request, $id)
    {
        $user = $request->user();

        $project = Project::find($id);
        if (!$project) {
            return response()->error('project.not-found');
        }

        if(!$request->user_ids){
            return redirect('admin/projects/' . $id )->with('flash_message', "You didn't select any member!");
        }

        $members = $project->members()->find($request->input('user_ids'));
        if($members){
            $project->members()->detach($members);
        }

        return view('admin.projects.show' , compact('project'))->with([
            'flash_message'=> 'Member(s) deleted!',
            'menu' => 'members',
            'link'=> 'members_link',
            'transPrefix'=> $this->transPrefix
        ]);
    }

    /**
     * Makes join claim to the project.
     * @param  int $id
     * @param  Request $request
     * @return array
     */
    public function makeClaim(Request $request, $id)
    {
        $user = $request->user();

        $project = Project::find($id);
        if (!$project) {
            return response()->error('project.not-found');
        }

        $claim = $project->claims()->find($user->id);
        if ($claim) {
            return response()->error('claim.claim-exists');
        }

        $member = $project->members()->find($user->id);
        if ($member) {
            return response()->error('claim.member-exists');
        }
        $project->claims()->sync($user);

        return response()->success('common.success');
    }

    /**
     * Accepts the join claim of the project.
     * @param  int $project_id
     * @param int $user_id
     * @param Request $request
     * @return array
     */
    public function acceptClaim(Request $request, $project_id, $user_id)
    {
        $user = $request->user();

        $project = Project::find($project_id);
        if (!$project) {
            return response()->error('project.not-found');
        }

        $claim = $project->claims()->find($user_id);
        if (!$claim) {
            return response()->error('claim.not-found');
        }

        $project->claims()->updateExistingPivot($user_id, [ 'is_member' => true]);

        return response()->success('common.success');
    }

    /**
     * Rejects the join claim of the project.
     * @param  int $project_id
     * @param int $user_id
     * @param Request $request
     * @return array
     */
    public function rejectClaim(Request $request, $project_id, $user_id)
    {
        $user = $request->user();

        $project = Project::find($project_id);
        if (!$project) {
            return response()->error('project.not-found');
        }

        $claim = $project->claims()->find($user_id);
        if (!$claim) {
            return response()->error('claim.not-found');
        }

        $project->claims()->detach($user_id);

        return response()->success('common.success');
    }

    /**
     * Ends the project.
     * @param  int $id
     * @param Request $request
     * @return array
     */
    public function endProject(Request $request, $id)
    {
        $user = $request->user();

        $project = Project::find($id);
        if (!$project) {
            return response()->error('project.not-found');
        }

        if($project->is_completed){
            return response()->error('project.end');
        }

        $project->update(['is_completed'=> true]);

        $members = $project->members()->get();
        if (!$members){
            return response()->error('members.not-found');
        }

        if($user->hasRole(Setting::ROLE_TEACHER)){
            foreach ($members as $member){
                $member->rosettes()->attach($project->rosettes()->get());
                $member->profile()->update(['point'=> $project->point, 'experience'=> $project->experience]);
            }
        }

        return response()->success('common.success');
    }
}
