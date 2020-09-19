<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * App\Models\Setting
 *
 * @property int $id
 * @property string $key
 * @property string|null $value
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereValue($value)
 * @mixin \Eloquent
 */
class Setting extends Model
{
    use LogsActivity;
    /**
     * Indicates if the model should be timestamped.
     * @var bool
     */
    public $timestamps = false;

    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'settings';

    /**
     * The database primary key value.
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     * @var array
     */
    protected $fillable = ['key', 'value'];

    const WF_TYPE_WF = 'workflow';
    const WF_TYPE_SM = 'state_machine';

    const ACTIVITY_ACTION ='do-action';
    const ACTIVITY_RETURN ='return-value';

    const APP_NAME = 'Sarente Gameon';
    const DEFAULT_PASS = 'Gameon';

    const DOMAIN_NAME = 'domain-name';
    const DOMAIN_REAL = 'sarente.com';
    const DOMAIN_TEST = 'test.com';

    const URL_STUDENT = 'user_url';
    const URL_STUDENT_INTRO = 'user_intro_url';
    const URL_TEACHER = 'supervisor_url';
    const URL_ADMIN = 'admin_url';
    const URL_API = 'api_url';
    const URL_LOGOUT = 'logout_url';

    const GENDER_FEMALE = 0;
    const GENDER_MALE = 1;
    const GENDER_UNISEX = 2;

    public static $workflow_types = [
        0 => Setting::WF_TYPE_WF,
        1 => Setting::WF_TYPE_SM,
    ];

    public static $activity_types = [
        0 => Setting::ACTIVITY_ACTION,
        1 => Setting::ACTIVITY_RETURN,
    ];

    public static $status_types = [
        0 => Setting::STATUS_OPENED,
        1 => Setting::STATUS_DOING,
        2 => Setting::STATUS_PENDING,
        3 => Setting::STATUS_COMPLETED,
        4 => Setting::STATUS_DISABLED,
        5 => Setting::STATUS_DECLINED, //reddedildi
        6 => Setting::STATUS_POSTPONE, //erteleme
        7 => Setting::STATUS_CANCELED,
    ];

    public static $message_types = [
        0 => Setting::PLAN_MESSAGE,
        1 => Setting::MENTOR_MESSAGE,
        2 => Setting::POPUP_MESSAGE,
        3 => Setting::DONE_MESSAGE,
        4 => Setting::RIGHT_MESSAGE,
        5 => Setting::WRONG_MESSAGE,
        6 => Setting::ROSSETTE_MESSAGE,
    ];
    //Used in task

    public static $level_artifacts = [
        0 => Setting::ARTIFACT_PROJECT,
        1 => Setting::ARTIFACT_CLUB,
        2 => Setting::ARTIFACT_TASK,
        3 => Setting::ARTIFACT_QUESTION_ANSWER,
        4 => Setting::ARTIFACT_SQUARE,
        5 => Setting::ARTIFACT_GENERAL,
        7 => Setting::ARTIFACT_POST,
    ];


    //Default rewards
    const REWARD_ROSETTE = 'rosette';
    const REWARD_MEDAL = 'medal';
    const REWARD_BADGE = 'badge';

    //Default Permissions of project
    const PERMISSION_PROJECT_CREATE = 'project-create'; // project creator
    const PERMISSION_PROJECT_DONE = 'project-done';
    const PERMISSION_PROJECT_UPDATE = 'project-update';
    const PERMISSION_PROJECT_DELETE = 'project-delete';
    const PERMISSION_PROJECT_CLAIM_ACCEPT = 'project-claim-accept';
    const PERMISSION_PROJECT_CLAIM_REJECT = 'project-claim-reject';
    const PERMISSION_PROJECT_POST_ADD = 'project-post-add';
    const PERMISSION_PROJECT_DOCUMENT_ADD = 'project-document-add';

    const PERMISSION_ROSETTE_CREATE = 'rosette-create';
    const PERMISSION_ROSETTE_DELETE = 'rosette-delete';
    const PERMISSION_ROSETTE_UPDATE = 'rosette-update';
    const PERMISSION_ROSETTE_ATTACH = 'rosette-attach';
    const PERMISSION_ROSETTE_DETACH = 'rosette-detach';
    const PERMISSION_ROSETTE_HOLD = 'rosette-hold';

    const PERMISSION_STEP_CREATE = 'step-create';
    const PERMISSION_STEP_DELETE = 'step-delete';
    const PERMISSION_STEP_UPDATE = 'step-update';
    const PERMISSION_STEP_DONE = 'step-done';

    const PERMISSION_CLUB_CREATE = 'club-create';
    const PERMISSION_CLUB_DELETE = 'club-delete';
    const PERMISSION_CLUB_UPDATE = 'club-update';
    const PERMISSION_CLUB_CLAIM_ACCEPT = 'club-claim-accept';
    const PERMISSION_CLUB_CLAIM_REJECT = 'club-claim-reject';
    const PERMISSION_CLUB_POST_ADD = 'club-post-add';
    const PERMISSION_CLUB_DOCUMENT_ADD = 'club-document-add';

    const PERMISSION_QUESTION_CREATE = 'question-create';
    const PERMISSION_QUESTION_DELETE = 'question-delete';
    const PERMISSION_QUESTION_UPDATE = 'question-update';

    const PERMISSION_TASK_CREATE = 'task-create';
    const PERMISSION_TASK_DELETE = 'task-delete';
    const PERMISSION_TASK_UPDATE = 'task-update';

    const PERMISSION_PROFILE_CLAIM_ACCEPT = 'profile-claim-accept';
    const PERMISSION_PROFILE_CLAIM_REJECT = 'profile-claim-reject';
    const PERMISSION_PROFILE_POST_ADD = 'profile-post-add';
    const PERMISSION_POST_UPDATE = 'post-update';
    const PERMISSION_POST_DELETE = 'post-delete';

    //Default Roles of project
    const ROLE_PROJECT_OWNER = 'project-owner';
    const ROLE_PROJECT_ADVISER = 'project-adviser';
    const ROLE_PROJECT_LEADER = 'project-leader';
    const ROLE_PROJECT_MEMBER = 'project-member';

    //Default Roles of club
    const ROLE_CLUB_OWNER = 'club-owner';
    const ROLE_CLUB_ADVISER = 'club-adviser';
    const ROLE_CLUB_LEADER = 'club-leader';
    const ROLE_CLUB_MEMBER = 'club-member';

    //Default Roles of system
    const ROLE_USER = 'user';
    const ROLE_SUPERVISOR = 'supervisor';
    const ROLE_ADMIN = 'admin';
    const ROLE_SUPER_ADMIN = 'super-admin';

    const SARENTE = 'sarente';

    const DEFAULT_LANGUAGE = 'tr';

    //Messages
    const PLAN_MESSAGE = 0;
    const MENTOR_MESSAGE = 1;
    const POPUP_MESSAGE = 2;
    const DONE_MESSAGE = 3;
    const RIGHT_MESSAGE = 4;
    const WRONG_MESSAGE = 5;
    const ROSSETTE_MESSAGE = 6;

    //status
    const STATUS_OPENED = 'opened';//0
    const STATUS_DOING = 'doing';//1
    const STATUS_PENDING = 'pending';//2
    const STATUS_COMPLETED = 'done';//3
    const STATUS_DISABLED = 'disabled';//4
    const STATUS_DECLINED = 'declined';//5
    const STATUS_POSTPONE = 'postpone';//6
    const STATUS_CANCELED = 'canceled';//7

    //item status
    const ITEM_NOT_BOUGHT = 0;
    const ITEM_BOUGHT = 1;
    const ITEM_EQUIPPED = 2;

    const ITEM_HAIR = 'hair';
    const ITEM_HEADGEAR = 'headgear';
    const ITEM_EYE = 'eye';
    const ITEM_SKIN = 'skin';
    const ITEM_DRESS = 'dress';
    const ITEM_JEANS = 'jeans';
    const ITEM_TSHIRT = 'tshirt';
    const ITEM_SHOE = 'shoe';

    const NO_ARTIFACT = 'no-artifact';
    const ARTIFACT_PROJECT = 'project';
    const ARTIFACT_CLUB = 'club';
    const ARTIFACT_TASK = 'task';
    const ARTIFACT_USER = 'user';
    const ARTIFACT_QUESTION_ANSWER = 'question-answer';
    const ARTIFACT_QUESTION = 'question';
    const ARTIFACT_GENERAL = 'general';
    const ARTIFACT_SQUARE = 'square';
    const ARTIFACT_POST = 'post';
    const ARTIFACT_PROFILE = 'profile';


    const JOB_PROJECT = 'project';
    const JOB_TASK = 'task';
    const JOB_QA = 'question-answer';
    const JOB_CLUB = 'club';

    const BACKGROUND_OCEAN = 'ocean';
    const BACKGROUND_OTHER = 'other';

    //LEVELS
    const LEVEL_COUNT = 'level-count';
    const EDUCATION_TERM = 'education-term';
    const ARTIFACT_MONTHLY = 'artifact-monthly';
    const ARTIFACT_TOTAL_XP = 'total-xp';

    const ARTIFACT_PROJECT_MONTHLY = 'artifact-project-monthly';
    const ARTIFACT_PROJECT_XP = 'artifact-task-xp';
    const PROJECT_PER_MONTH = 'project-per-month';
    const PROJECT_PERCENT = 'project-percent';

    const ARTIFACT_CLUB_MONTHLY = 'artifac-club-monthly';
    const ARTIFACT_CLUB_XP = 'artifact-task-xp';
    const CLUB_PER_MONTH = 'club-per-month';
    const CLUB_PERCENT = 'club-percent';

    const ARTIFACT_QA_MONTHLY = 'artifact-question-answer-monthly';
    const ARTIFACT_QA_XP = 'artifact-task-xp';
    const QA_PER_MONTH = 'question-answer-per-month';
    const QA_PERCENT = 'question-answer-percent';

    const ARTIFACT_TASK_MONTHLY = 'artifact-task-monthly';
    const ARTIFACT_TASK_XP = 'artifact-task-xp';
    const TASK_PER_MONTH = 'task-per-month';
    const TASK_PERCENT = 'task-percent';
    ///////////////
    const ARTIFACT_ROSETTE = 'rosette';

    const ROSETTE_VALUES = ['tr'=>'Değerler','en'=>'Values'];
    const ROSETTE_COMPETENCE = ['tr'=>'Yetkinlikler','en'=>'Competence'];

    const MEDAL_CHARLIE = 'Charlie Chaplin';
    const MEDAL_FRIDA = 'Frida Kahlo';
    const MEDAL_FATIH = 'Fatih Sultan Mehmet';
    const MEDAL_HASAN = 'Hasan Ali Yücel';
    const MEDAL_NEWTON = 'Isaac Newton';
    const MEDAL_CURIE = 'Marie Curie';
    const MEDAL_SINAN = 'Mimar Sinan';
    const MEDAL_EINSTEIN = 'Albert Einstein';
    const MEDAL_SANCAR = 'Aziz Sancar';
    const MEDAL_PLATON = 'Platon';
    const MEDAL_WOOLF = 'Virginia Woolf';
    const MEDAL_MEVLANA = 'Mevlana';
    const MEDAL_NAZIM = 'Nazım Hikmet';
    const MEDAL_YUNUS = 'Yunus Emre';
    const MEDAL_SINA = 'İbni Sina';
    const MEDAL_TESLA = 'Nicola Tesla';

    //User category
    const INSTITUTOIN_COLLEAGUE = 'colleague';
    const INSTITUTOIN_CAMPUS = 'campus';
    const INSTITUTOIN_SCHOOL = 'school';
    const INSTITUTOIN_CLASSROOM = 'classroom';
    const INSTITUTOIN_BRANCH = 'branch';

    //Club names
    const CLUB_LITERATURE = 'Edebiyat';
    const CLUB_MUSIC = 'Müzik';
    const CLUB_CHESS = 'Satranç';
    const CLUB_THEATER = 'Tiyatro';
    const CLUB_BASKETBALL = 'Basketbol';

    const LAST_LEVEL='last_level';

    public static function getByKey($key)
    {
        return self::where('key', $key)->first()->value ?? null;
        /*   $model = self::where('key', $key)->first();
             if (!$model) {
               return null;
           }
           return $model->value;
       */
    }

    public static function setByKey($key, $value)
    {
        $setting = Setting::firstOrNew([
            'key' => $key,
        ]);
        $setting->fill([
            'value' => $value
        ]);
        $setting->save();
    }
}
