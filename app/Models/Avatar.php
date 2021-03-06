<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Avatar
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property array $items
 * @property int $user_id
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Avatar newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Avatar newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Avatar query()
 * @method static \Illuminate\Database\Eloquent\Builder|Avatar whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Avatar whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Avatar whereItems($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Avatar whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Avatar whereUserId($value)
 * @mixin \Eloquent
 */
class Avatar extends Model
{
    protected $fillable = [
        'items'
    ];
    protected $casts = [
        'items' => 'array',
    ];
    protected $attributes = [
        'items' => '{
            "Hair":0,"Hat":-1,"TShirt":0,"Pants":0,"Shoes":0,"Accessory":-1,"SkinColor":{"r":0.8679245114326477,"g":0.5573326945304871,"b":0.4544321298599243,"a":1.0},"EyeColor":{"r":0.22588101029396058,"g":0.2618088126182556,"b":0.3396225571632385,"a":0.0},"HairColor":{"r":0.9058823585510254,"g":0.6941176652908325,"b":0.0,"a":1.0},"UnderpantsColor":{"r":0.0,"g":0.0,"b":0.0,"a":0.0}
        }'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
