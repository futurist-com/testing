<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;
use App\Model\Worker;

$factory->define(Worker::class, function (Faker $faker) {
    return [
        'name'=>$faker->firstName." ".$faker->lastName,
        'email'=>$faker->email,
        'telefon'=>$faker->phoneNumber,
        'description'=>$faker->sentence(6,true),
        'specialty'=>$faker->word 
    ];
});
