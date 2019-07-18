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
        $this->json('POST', '/api/login')->assertStatus(422);
    }
    public function testUserLoginsSuccessfully(){
        /*$user=factory(User::class)->create(['email'=>'test503@test.lr',
         'password' => bcrypt('toptal123')]
        );*/
        $payload=['email'=>'test500@test.lr', 'password'=>bcrypt('toptal123')];
        //dd($payload);
        $response=$this->json('POST', "api/login")
                ->assertStatus(422)
                ->assertJsonStructure([
                    'user',
                    'status']);
                    dd($response);
    }
}
