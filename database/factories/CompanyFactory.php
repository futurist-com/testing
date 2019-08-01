<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;
use App\Model\Company;

$factory->define(Company::class, function (Faker $faker) {
    return [
        'name'=>$faker->company,
        'description'=>$faker->realText();
        'logo'=>$facker->imageUrl($width = 640, $height = 480);
            
        //
    ];
});
