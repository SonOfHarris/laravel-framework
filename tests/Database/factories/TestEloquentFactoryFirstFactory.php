<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Illuminate\Tests\Database\TestEloquentFactoryFirst;

// Legacy style
$factory->define(TestEloquentFactoryFirst::class, function (Faker $faker) {
    return [
        'name' => 'first_file',
    ];
});
