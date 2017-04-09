<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trivia extends Model
{

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id', 'created_at', 'updated_at', 'punish_per_second', 'points_per_anwser', 'time_limit', 'query_size', 'publish', 'expiration'
    ];

    public function preguntas()
    {
        return $this->hasMany('App\Pregunta');
    }
}