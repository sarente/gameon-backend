<?php

namespace App\Listeners\User\Profile;

use App\Events\UserCreated;
use App\Models\Avatar\Avatar;
use App\Models\Avatar\Eye;
use App\Models\Avatar\Hair;
use App\Models\Avatar\Jeans;
use App\Models\Avatar\Shoe;
use App\Models\Avatar\Skin;
use App\Models\Avatar\Tshirt;
use App\Models\Point;
use App\Models\Setting;

class CreateAvatar
{
    /**
     * Create the event listener.
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     * @param UserCreated $event
     * @return void
     */
    public function handle(UserCreated $event)
    {
        $user = $event->user;

        switch ($user->level) {
            case 1:
            case 2:
                $avatar = new Avatar(['posture' => 1]);
                break;
            case 3:
            case 4:
                $avatar = new Avatar(['posture' => 2]);
                break;
            case 5:
                $avatar = new Avatar(['posture' => 3]);
                break;
            default:
                $avatar = new Avatar(['posture' => 0]);
                break;
        }
        $avatar->user()->associate($user);
        $avatar->save();

        $hairs = Hair::all();
        $skins = Skin::all();
        $eyes = Eye::all();

        $avatar->items(Setting::ITEM_HAIR)->attach($hairs);
        $avatar->items(Setting::ITEM_SKIN)->attach($skins);
        $avatar->items(Setting::ITEM_EYE)->attach($eyes);

        $default_male_hair = Hair::where('gender', 1)->first();
        $default_female_hair = Hair::where('gender', 0)->first();

        $default_male_tshirt = Tshirt::where('gender', 1)->first();
        $default_female_tshirt = Tshirt::where('gender', 0)->first();

        $default_skin = Skin::find(1);
        $default_eye = Eye::find(1);
        $default_jeans = Jeans::find(1);
        $default_shoe = Shoe::find(1);

        $avatar->items(Setting::ITEM_SKIN)->attach($default_skin, ['is_worn' => true]);
        $avatar->items(Setting::ITEM_EYE)->attach($default_eye, ['is_worn' => true]);
        $avatar->items(Setting::ITEM_JEANS)->attach($default_jeans, ['is_worn' => true]);
        $avatar->items(Setting::ITEM_SHOE)->attach($default_shoe, ['is_worn' => true]);

        if ($user->gender == 0) {
            $avatar->items(Setting::ITEM_HAIR)->attach($default_female_hair, ['is_worn' => true]);
            $avatar->items(Setting::ITEM_TSHIRT)->attach($default_female_tshirt, ['is_worn' => true]);
        }
        else {
            $avatar->items(Setting::ITEM_HAIR)->attach($default_male_hair, ['is_worn' => true]);
            $avatar->items(Setting::ITEM_TSHIRT)->attach($default_male_tshirt, ['is_worn' => true]);
        }

        $point = new Point(['point' => 0, 'artifact_name' => Setting::ARTIFACT_GENERAL]); //Give initial point
        $point->user()->associate($user);
        $point->save();
    }
}
