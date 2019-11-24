<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $table = 'vote';
    protected $fillable = ['tickets'];
    public $timestamps = false;
}
