<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Intento extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'query_ord', 'correct_str', 'pregunta_id', 'puntaje_id', 'attempt_str'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id', 'attempt_str', 'respuesta_id', 'pregunta_id', 'puntaje_id', 'created_at', 'updated_at', 'correct_str'
    ];

    public function pregunta(){
        return $this->belongsTo('App\Pregunta');
    }

}
