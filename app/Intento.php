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
        //
    ];
}
