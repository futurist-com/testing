<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class ResetPasswordTest extends TestCase
{
    use WithFaker;

    public function testPasswordResetLink()
    {
        $user=User::first();
        $this->json('post', '/api/reset-password', ['email'=>$user->email])->
        assertJson(['message'=>'На вашу почту отправленно письмо с кодом подтверждения. Введите код.',
        'status'=>'200']);
    }
    public function testPasswordResetLinkNoEmail(){
        $this->json('post', '/api/reset-password', 
        ['email'=>$this->faker->unique()->safeEmail])->
        assertJson(['message'=>'Учетной записи не найденно.',
        'status'=>422]);
    }
}
