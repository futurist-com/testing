<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use Illuminate\Support\Facades\Request;
use App\Model\PasswordReset;

/*class ResetPasswordTest extends TestCase
{
    use WithFaker;
*/
    /*public function testPasswordResetLink()
    {
        $user=User::first();
        $this->json('post', '/api/reset-password', ['email'=>$user->email])->
        assertJson(['message'=>'На вашу почту отправленно письмо с кодом подтверждения. Введите код.',
                    'status'=>'200']);
    }
    public function testPasswordResetLinkNoEmail(){
        $this->json('post', '/api/reset-password', 
        ['email'=>  $this->faker->unique()->safeEmail])->
        assertJson(['message'=>'Учетной записи не найденно.',
        'status'=>422]);
    }*/
    /**
     * 
     * @todo придумать как забарить код*/
    /*public function testCheckCodeResetPassword(){
        $user=factory(User::class)->create(['email'=>$this->faker->unique()->safeEmail,
         'password' => bcrypt('toptal123')]);
         $this->json('post', '/api/reset-password', ['email'=>$user->email])->
        assertJson(['message'=>'На вашу почту отправленно письмо с кодом подтверждения. Введите код.',
                    'status'=>'200']);
        //$passReset= PasswordReset::whereEmail($user->email)->first();
        //dd($passReset->code);           
    }*/
//}
