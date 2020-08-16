<?php

namespace App\Models;

use App\Models\Avatar\Avatar;
use App\Models\Workflow\Workflow;
use Illuminate\Contracts\Translation\HasLocalePreference;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;
//use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * App\Models\User
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
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Level[] $levels
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
 */
class User extends Authenticatable implements HasLocalePreference
{
    use Notifiable;
    use HasRoles;
    use LogsActivity;

    //protected $guard = 'api';

    protected $guard_name = 'web';
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'experience',
        'point',
        'level',
        'gender',
        'username'
    ];

    /**
     * The attributes that should be hidden for arrays.
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'pivot'
    ];

    /**
     * The attributes that should be cast to native types.
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = [
        'experience',
        'point',
        'level',
    ];

    // Rest omitted for brevity

    public static function getUrl($roleName = null, $is_intro_completed)
    {
        unset($url);
        $urlStr = '_url';

        if (!is_null($roleName)) {

            //FIXME: put in cache
            $keys = Setting::where('key', 'like', "%$roleName%")->pluck('value', 'key');
            if (count($keys)) {
                $url = $keys[$roleName . $urlStr];
                if (!$is_intro_completed && $roleName == Setting::ROLE_STUDENT) {
                    unset($url);
                    $url = $keys[$roleName . '_intro' . $urlStr];
                }
            }
        }
        return $url;
    }

    /**
     * Get the user's preferred locale.
     * @return string
     */
    public function preferredLocale()
    {
        return $this->locale;
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    //Get user last level current Point

    //Get user last level current Experience

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'user_category')->withPivot('level_no');
    }

    public function workflows()
    {
        return $this->belongsToMany(Workflow::class, 'user_workflow')->withPivot('marking');
    }

    public function rewards():MorphToMany
    {
        return $this->morphToMany(
            Reward::class,
            'model',
            'model_has_rewards',
            'model_id',
            'reward_id'
        );
    }

    public function posts()
    {
        return $this->morphMany(Post::class, 'postable');
    }

    public function likes()
    {
        return $this->hasMany(Like::class, 'user_id', 'user_id');
    }

    public function friends()
    {
        //FIXME: change it to laravel standards
        $first = DB::table('friend_user')
            ->where('friend_id', '=', $this->user->id)
            ->where('is_friend','=', true)
            ->leftJoin('users', 'users.id', '=', 'friend_user.user_id')
            ->select('id');

        $friend_ids = DB::table('friend_user')
            ->where('user_id', '=', $this->user->id)
            ->where('is_friend','=', true)
            ->rightJoin('users','users.id', '=', 'friend_user.friend_id')
            ->select('id')
            ->union($first)
            ->pluck('id')
            ->toArray();

        return User::with('image')->find($friend_ids);
    }

    public function getScoreAttribute($value)
    {
        return $this->getLastCurrentScore();
    }

    public function getPointAttribute($value)
    {
        return $this->getLastCurrentPoint();
    }

    public function levels()
    {
        return $this->belongsToMany(Level::class, 'user_level', 'user_id', 'level_id')
            ->withTimestamps()
            ->withPivot('current_xp', 'artifact_name');
    }

    public function getLevelNumber($artifact_name)
    {
        return $this->whereHas('levels', function ($q) use ($artifact_name) {
            $q->where('artifact_name', $artifact_name);
        })->firstOrFail()->artifact_status;
    }

    //Get user last level current Point

    public function getCurrentXp($level_id)
    {
        $query = $this->levels()->getQuery()->where('level_id', $level_id);
        if ($query->exists()) {
            return $query->first()->current_xp;
        }
        return null;
    }

    //Get user last level current Experience

    public function getUserCurrentPoint($level_id)
    {
        if ($this->rightJoin('user_level', 'user_id', 'level_id')->where('level_id', $level_id)->exists()) {
            return $this->rightJoin('user_level', 'user_id', 'level_id')->where('level_id', $level_id)->firstOrFail()->current_point;
        }
        return null;
    }

    public function getLastCurrentPoint()
    {
        $point = Point::getPoints(Setting::ARTIFACT_GENERAL)->where('user_id', $this->id);
        if ($point->count() > 0) {
            return $point->first()->point;
        }
        return 0;
    }

    //manually level up

    public function getLastCurrentXP()
    {
        $level_id = Level::getLevelbyStatus(setting::ARTIFACT_GENERAL, Setting::getByKey(Setting::LAST_LEVEL))->id;
        if ($this->rightJoin('user_level', 'user_id', 'level_id')->where('level_id', $level_id)->exists()) {
            return $this->rightJoin('user_level', 'user_id', 'level_id')->where('level_id', $level_id)->firstOrFail()->current_xp;
        }
        return null;
    }

    public function setCurrentXp($artifact, ?int $artifact_status, ?int $current_xp)
    {
        $level = Level::getLevelbyStatus($artifact, $artifact_status);
        $current_xp = $current_xp ?? $level->max_xp;
        if (is_null($this->getCurrentXp($level->id))) {
            // first time
            return $this->levels()->attach($level->id, ['current_xp' => $current_xp]);
        };
        // update
        return $this->levels()->updateExistingPivot($level->id, ['current_xp' => $current_xp]);
    }
}
