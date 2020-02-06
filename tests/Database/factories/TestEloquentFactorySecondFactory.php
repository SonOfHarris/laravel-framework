<?php

use Faker\Generator as Faker;
use Illuminate\Tests\Database\TestEloquentFactorySecond;

// Current style
factories()->define(TestEloquentFactorySecond::class, function (Faker $faker) {
    return [
        'name' => 'second_file',
    ];
});
