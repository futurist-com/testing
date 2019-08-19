<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Departament extends Model
{
    //
    public function post(){
        return $this->hasMany('App\Model\Post');
    }
}
