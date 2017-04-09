<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Puntaje extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'trivia_id', 'ciudad_id', 'participante_id'
    ];

    public function trivia(){
        return $this->belongsTo('App\Trivia');
    }

    public function intentos()
    {
        return $this->hasMany('App\Intento');
    }
}
