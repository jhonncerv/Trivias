<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    protected $table = 'ciudades';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'available', 'created_at', 'updated_at'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['is_publish'];

    public function getIsPublishAttribute()
    {
        $diff = new Carbon($this->attributes['publish'], 'America/Mexico_City');
        return $diff->isPast() ? 1 : 0;
    }

}
