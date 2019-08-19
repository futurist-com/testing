<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Departament;

class Company extends Model
{
    //
    public function users(){
        return $this->belongsToMany('App/User');
    }
    public function departaments(){
        return $this->hasMany('App\Model\Departament');
    }
    public function posts(){
        return $this->hasMany('App\Model\Post');
    }
}
