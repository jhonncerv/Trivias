<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trivia extends Model
{

    public function preguntas()
    {
        return $this->hasMany('App\Pregunta');
    }
}
