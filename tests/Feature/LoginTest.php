<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class LoginTest extends TestCase
{
    public function testRequirulesEmailAndLogin()
    {
        $this->json('POST', '/api/login')->
        assertStatus(422)->
        assertJsonStructure([
            'message',
            'status'
        ]);
    }
    public function testUserLoginsSuccessfully()
    {
        /*$user=factory(User::class)->create(['email'=>'test503@test.lr',
         'password' => bcrypt('toptal123')]
        );*/
        $payload = ['username' => 'test1@test.lr', 'password' => '852'];
        //dd($payload);
        $response = $this->json('POST', "api/login", $payload)
            ->assertStatus(200)
            ->assertJsonStructure([
                'user',
                'token',
                'status'
            ]);
    }
}
