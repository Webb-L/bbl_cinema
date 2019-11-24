<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bbl_movie_layout extends Model
{
    protected $table = 'movie';
    public $timestamps = false;

    function movie() {
        return $this->hasOne('App\Vote','id','release_room');
    }
}
