<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $table = 'purchase';
    public $timestamps = false;
    protected $fillable = ['status'];

    public function movie(){
        return $this->hasOne('App\bbl_movie_layout','layout_id','movie_id');
    }
}
