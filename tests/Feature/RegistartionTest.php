<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;


class RegistartionTest extends TestCase
{
    use WithFaker;
    
    public function testRegistrationSuccess()
    {
        //$faker=Faker::class;
        $payload = [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => 'toptal123',
        ];

        $this->json('post', '/api/register', $payload)
            ->assertStatus(200);
    }
    public function testNotEmail()
    {
        //$faker=Faker::class;
        $payload = [
            'name' => $this->faker->name,
            'email' => '',
            'password' => 'toptal123',
        ];

        $resp=$this->json('post', '/api/register', $payload)
            ->assertStatus(422)->
            assertJsonStructure(['message',
            'errors']);    
    }
    public function testGetiEmail(){
        $user=User::first();
        $resp=$this->json('get', '/api/get-email', ['email'=>$user->email])
            ->assertStatus(422)->
            assertJson(['message'=>'Такой email уже зарегистрирован.',
            'unique'=>'0',
            'status'=>'422']);
        
    }
    public function testGetISNotEmail(){
        $resp=$this->json('get', '/api/get-email', ['email'=>$this->faker->unique()->safeEmail])
            ->assertStatus(200)->
            assertJson(['unique'=>'1',
            'status'=>'200']);
    }

}
