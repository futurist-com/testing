<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;
use App\Model\Departament;

$factory->define(Departament::class, function (Faker $faker) {
    return [
        //
        'name'=>$faker->word ,
        'description'=>$faker->sentence(5, true),
    ];
});
