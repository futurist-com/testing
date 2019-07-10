<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Carbon;
use App\Model\PasswordReset;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
     
    public function passReset(){
        return $this->hasOne('App\Model\PasswordReset', 'email', 'email');
    }

    public static function boot()
    {
        parent::boot();
        static::creating(function ($user) {
            $user->token = str_random(30);
        });
    }
    public function confirmEmail()
    {
        $this->email_verified_at = Carbon::today();
        $this->token = null;
        $this->save();
    }
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new \App\Notifications\EmailResetPasswordNotification($token));
    }
}
