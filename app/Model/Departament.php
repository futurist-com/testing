<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Departament extends Model
{
    
    public function posts(){
        return $this->hasMany('App\Model\Post');
    }
}
