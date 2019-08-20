<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function workers(){
        return $this->hasMany('App\Model\Worker');
    }
}
