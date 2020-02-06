<?php

namespace Illuminate\Tests\Database;

use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Database\Eloquent\Model;
use Mockery as m;
use PHPUnit\Framework\TestCase;

class DatabaseEloquentFactoryTest extends TestCase
{
    protected function tearDown(): void
    {
        m::close();
    }

    public function testDefiningBuilders(): void
    {
        $factory = new Factory(new Faker());

        $this->assertFalse($factory->offsetExists(TestEloquentFactoryFirst::class));
        $this->assertFalse($factory->offsetExists(TestEloquentFactorySecond::class));
        $this->assertFalse($factory->offsetExists(TestEloquentFactoryThird::class));

        $factory->define(TestEloquentFactoryFirst::class, function (Faker $faker) {
            return [
                'name' => 'first',
            ];
        });
        $factory->define(TestEloquentFactorySecond::class, function (Faker $faker) {
            return [
                'name' => 'second',
            ];
        });

        $this->assertTrue($factory->offsetExists(TestEloquentFactoryFirst::class));
        $this->assertTrue($factory->offsetExists(TestEloquentFactorySecond::class));
        $this->assertFalse($factory->offsetExists(TestEloquentFactoryThird::class));

        $this->assertEquals(['name' => 'first'], $factory->raw(TestEloquentFactoryFirst::class));
        $this->assertEquals(['name' => 'second'], $factory->raw(TestEloquentFactorySecond::class));
    }

    public function testLoadingBuilders(): void
    {
        $factory = new Factory(new Faker());

        $this->assertFalse($factory->offsetExists(TestEloquentFactoryFirst::class));
        $this->assertFalse($factory->offsetExists(TestEloquentFactorySecond::class));
        $this->assertFalse($factory->offsetExists(TestEloquentFactoryThird::class));

        $factory->load(__DIR__.'/factories');

        $this->assertTrue($factory->offsetExists(TestEloquentFactoryFirst::class));
        $this->assertTrue($factory->offsetExists(TestEloquentFactorySecond::class));
        $this->assertFalse($factory->offsetExists(TestEloquentFactoryThird::class));

        $this->assertEquals(['name' => 'first_file'], $factory->raw(TestEloquentFactoryFirst::class));
        $this->assertEquals(['name' => 'second_file'], $factory->raw(TestEloquentFactorySecond::class));
    }
}

class TestEloquentFactoryFirst extends Model
{

}

class TestEloquentFactorySecond extends Model
{

}

class TestEloquentFactoryThird extends Model
{

}
