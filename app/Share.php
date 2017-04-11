<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Share extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fb_post_id', 'postal_id', 'participante_id', 'points'
    ];
}
