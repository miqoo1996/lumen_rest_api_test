<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'email' => $this->faker->unique()->safeEmail,
            'email_token' => Str::random(User::USER_EMAIL_TOKEN_LENGTH),
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'password' => Hash::make('111111'),
            'phone' => $this->faker->phoneNumber,
        ];
    }
}
