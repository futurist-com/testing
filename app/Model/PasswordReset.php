<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    //
    protected $primaryKey = 'email';
    public $timestamps=false;
}
