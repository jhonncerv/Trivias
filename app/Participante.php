<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participante extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'name', 'email', 'nickname', 'token_oauth', 'user_id'
    ];
}
