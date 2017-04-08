<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'trivia_id', 'id', 'created_at', 'updated_at'
    ];

    public function respuestas()
    {
        return $this->hasMany('App\Respuesta');
    }
}
