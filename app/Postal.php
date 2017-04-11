<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Postal extends Model
{
    protected $table = 'postales';


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'points', 'created_at', 'updated_at', 'ciudad_id', 'id'
    ];


    public function ciudad(){
        return $this->belongsTo('App\Ciudad');
    }
}
