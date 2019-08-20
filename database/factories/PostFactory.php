<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;
use App\Model\Post;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'name'=>$faker->bs,
        'description'=>$faker->sentence(6, true)    
    ];
});
