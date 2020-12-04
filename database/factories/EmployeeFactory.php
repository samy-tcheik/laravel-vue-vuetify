<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Employee::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'last_name' => $this->faker->lastName(),
            'first_name' => $this->faker->firstNameMale(),
            'post_id' => $this->faker->numberBetween(1, Post::count()),
            'date_birth' => $this->faker->dateTimeBetween('-30 years','-20 years'),
            'address' => $this->faker->address,
            'recru' => $this->faker->dateTimeThisDecade(),
            'created_at' => $this->faker->dateTime(),
            'updated_at' => $this->faker->dateTime()
        ];
    }
}
