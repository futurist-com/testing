<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Departament;
use App\User;

class Company extends Model
{
    //
    public function users(){
        return $this->belongsToMany('App\User');
    }
    public function departaments(){
        return $this->hasMany('App\Model\Departament');
    }
    public function posts(){
        return $this->hasMany('App\Model\Post');
    }
    public function workers(){
        return $this->hasMany('App\Model\Worker');
    }
    
    /*public function getCompanyForUser()
    {
        $company=$this->where
    }*/
}
