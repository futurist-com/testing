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
    public function testGetEmail(){
        $user=User::first();
        dd($user);
    }
}
