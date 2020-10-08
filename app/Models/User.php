<?php

namespace App\Models;

use App\Exceptions\UserModelNotFoundException;
use App\Models\Workflow\Workflow;
use Illuminate\Contracts\Translation\HasLocalePreference;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * App\Models\User
 *
 * @property int $id
 * @property int $username
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property int $gender
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @property-read \App\Models\Avatar\Avatar $avatar
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Classroom[] $classroom
 * @property-read int|null $classroom_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Club[] $clubs
 * @property-read int|null $clubs_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\GameonEvent[] $gameonEvents
 * @property-read int|null $gameon_events_count
 * @property-read mixed $experience
 * @property-read mixed $level
 * @property-read mixed $point
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Image[] $image
 * @property-read int|null $image_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Introduction[] $introductions
 * @property-read int|null $introductions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Pane[] $levels
 * @property-read int|null $levels_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read \App\Models\Profile $profile
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Project[] $projects
 * @property-read int|null $projects_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Question[] $questions
 * @property-read int|null $questions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Task[] $tasks
 * @property-read int|null $tasks_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUsername($value)
 * @mixin \Eloquent
 * @property string|null $surname
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Category[] $categories
 * @property-read int|null $categories_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserPoint[] $points
 * @property-read int|null $points_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Reward[] $rewards
 * @property-read int|null $rewards_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CustomWorkflow[] $workflows
 * @property-read int|null $workflows_count
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSurname($value)
 */
class User extends Authenticatable implements HasLocalePreference
{
    use Notifiable;
    use HasRoles;
    use LogsActivity;

    protected $guard_name = 'api';
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'username',
        'name',
        'surname',
        'email',
        'password',
        'gender',
    ];

    /**
     * The attributes that should be hidden for arrays.
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'updated_at',
        'pivot'
    ];

    /**
     * The attributes that should be cast to native types.
     * @var array
     */
    protected $dates = [
        'email_verified_at'
    ];

    protected $casts = [
        'email_verified_at' => 'date:Y-m-d',
        'created_at' => 'datetime:Y-m-d H:00',
    ];

    public static function getUrl($roleName = null, $is_intro_completed)
    {
        unset($url);
        $urlStr = '_url';

        if (!is_null($roleName)) {

            //FIXME: put in cache
            $keys = Setting::where('key', 'like', "%$roleName%")->pluck('value', 'key');
            if (count($keys)) {
                $url = $keys[$roleName . $urlStr];
                if (!$is_intro_completed && $roleName == Setting::ROLE_USER) {
                    unset($url);
                    $url = $keys[$roleName . '_intro' . $urlStr];
                }
            }
        }
        return $url;
    }

    public static function boot()
    {
        parent::boot();

        static::created(function (self $model) {

            //create user avatar, one to one relation, each user has one avatar in avatars table
            $avatar = new Avatar();
            $avatar->user()->associate($model);
            $avatar->save();
        });
    }

    public static function getUser()
    {
        $user = auth()->user();
        if (!$user) {
            throw new UserModelNotFoundException();
        }
        return $user;
    }

    public function isAdmin()
    {
        return $this->hasRole(Setting::ROLE_ADMIN);
    }

    public function preferredLocale()
    {
        return $this->locale;
    }

    public function avatar()
    {
        return $this->hasOne(Avatar::class);
    }

    public function categories()
    {
        //TODO: get user level and point in each category
        return $this->belongsToMany(Category::class, 'user_category');
    }

    public function workflows()
    {
        return $this->belongsToMany(CustomWorkflow::class, 'user_workflow', 'user_id', 'workflow_id')->withTimestamps()->withPivot('marking');
    }

    public function points()
    {
        return $this->belongsToMany(UserPoint::class, 'user_point')->withPivot('point', 'category_id', 'workflow_id','result_id');
    }

    public function pointsByCategory()
    {
        return UserPoint::Where('user_id', $this->id)
            ->selectRaw("category_id,SUM(point) as current_point")
            ->groupBy('category_id')
            ->get();
    }

    public function rewards(): MorphToMany
    {
        return $this->morphToMany(
            Reward::class,
            'model',
            'model_has_rewards',
            'model_id',
            'reward_id'
        );
    }

    public function image()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
