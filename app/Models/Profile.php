<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * App\Models\Profile
 *
 * @property int $id
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string|null $description
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\Classroom[] $classroom
 * @property string|null $related_fields
 * @property string|null $favorite_games
 * @property string|null $language
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $user_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Badge[] $badges
 * @property-read int|null $badges_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $claims
 * @property-read int|null $claims_count
 * @property-read int|null $classroom_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Comment[] $comments
 * @property-read int|null $comments_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Like[] $likes
 * @property-read int|null $likes_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Medal[] $medals
 * @property-read int|null $medals_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Post[] $posts
 * @property-read int|null $posts_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Question[] $questions
 * @property-read int|null $questions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Rosette[] $rosettes
 * @property-read int|null $rosettes_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tag[] $tags
 * @property-read int|null $tags_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Task[] $tasks
 * @property-read int|null $tasks_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereClassroom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereFavoriteGames($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereRelatedFields($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereUserId($value)
 * @mixin \Eloquent
 */
class Profile extends Model
{
    use LogsActivity;

    protected $fillable = [
        'first_name',
        'last_name',
        'description',
        'description',
        'classroom',
        'related_fields',
        'favorite_games',
        'language'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'pivot',
        'user_id',
        'avatar',
        'user'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags(): MorphToMany
    {
        return $this->morphToMany(
            Tag::class,
            'model',
            'model_has_tags',
            'model_id',
            'tag_id'
        );
    }

    public function posts()
    {
        return $this->morphMany(Post::class, 'postable');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id', 'user_id');
    }

    public function likes()
    {
        return $this->hasMany(Like::class, 'user_id', 'user_id');
    }

    public function classroom()
    {
        return $this->belongsToMany(Classroom::class, 'classroom_user', 'user_id', Null,'user_id');
    }

    public function claims()
    {
        return $this->belongsToMany(User::class, 'user_friend', 'user_id', 'friend_id', 'user_id')
            ->wherePivot('is_friend', '=', false);
    }

    public function friends()
    {
        //FIXME: change it to laravel standards
        $first = DB::table('user_friend')
            ->where('friend_id', '=', $this->user->id)
            ->where('is_friend','=', true)
            ->leftJoin('users', 'users.id', '=', 'user_friend.user_id')
            ->select('id');

        $friend_ids = DB::table('user_friend')
            ->where('user_id', '=', $this->user->id)
            ->where('is_friend','=', true)
            ->rightJoin('users','users.id', '=', 'user_friend.friend_id')
            ->select('id')
            ->union($first)
            ->pluck('id')
            ->toArray();

        return User::with('image')->find($friend_ids);
    }

    /*public static function boot()
    {
        parent::boot();

        static::created(function (self $model) {

            $postAdd = Permission::create([
                'name' => Setting::PERMISSION_PROFILE_POST_ADD . '-' . $model->id,
                'guard_name' => Guard::getDefaultName($model),
            ]);

            $user = User::find($model->user_id);
            $user->givePermissionTo([
                $postAdd,
            ]);
        });
    }*/
}
