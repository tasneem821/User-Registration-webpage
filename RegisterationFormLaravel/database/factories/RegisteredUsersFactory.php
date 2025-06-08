<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RegisteredUsers>
 */
class RegisteredUsersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'fullname'     => $this->faker->name(),
            'username'     => $this->faker->userName(),
            'phone'        => $this->faker->phoneNumber(),
            'whats'        => $this->faker->phoneNumber(),
            'address'      => $this->faker->address(),
            'email'        => $this->faker->unique()->safeEmail(),
            'password'     => bcrypt('password'), 
            'imageUpload'  => 'default.jpg',
        ];
    }
}