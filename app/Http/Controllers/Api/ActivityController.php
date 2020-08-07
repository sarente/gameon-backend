<?php

namespace App\Http\Controllers\Api;

use App\Events\ActivitySaved;
use App\Http\Requests\Api\ActivityRequest;
use App\Models\Activity;
use App\Models\Image;
use App\Models\Setting;
use App\Models\Status;
use App\Models\User;
use App\Notifications\StudentNotification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Notification;

class ActivityController extends Controller
{
    public function index()
    {
        $activities = Activity::all();

        if (!$activities) {
            return response()->error('error.not-found');
        }
        return response()->success($activities);
    }

    public function store(ActivityRequest $request)
    {
        $user = auth()->user();

        $activity_name = $request->only('name');
        $activity = Activity::query()->where('name', $activity_name)->exists();

        if ($activity) {
            return response()->error('activity.name-valid');
        }

        try {
            $activity = new Activity($request->input());
            $activity->creator()->associate($user);
            $activity->save();
            if ($request->has('images')) {
                foreach ($request->images as $image) {
                    $activity->image()->save(new Image([
                        'image' => $image,
                    ]));
                }
            }

            //Add notification
            //TODO: Add notification
            //$users = User::whereNotIn('id', [$user->id])->get();
            //Notification::send($users, new StudentNotification($activity));

        } catch (\Exception $exception) {
            //FIXME:remove image of deleted project
            $activity->delete();
            return response()->error($exception->getMessage());
        }

        return response()->success($activity);
    }

    public function show($id){
        $activity = Activity::with('posts', 'rewards')->find($id);
        if (!$activity) {
            return response()->error('activity.not-found');
        }
        return response()->success($activity);
    }

    // For Admin
    public function updateStatus(Request $request, $id)
    {
        if (!auth()->user()->hasRole(Setting::ROLE_ADMIN) || !auth()->user()->hasRole(Setting::ROLE_TEACHER)) {
            return response()->error('not-authorized');
        }

        $activity = Activity::find($id);
        if (!$activity) {
            return response()->error('activity.not-found');
        }

        $user = User::find($request->user_id);
        $status = Status::find($request->status_id);

        if (!$user || !$status) {
            return response()->error('error.not-found');
        }

        $activity->users()->updateExistingPivot($user, ['status_id' => $status->id]);

        return response()->success('common.success');
    }
}
