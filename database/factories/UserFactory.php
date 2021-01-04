<?php

namespace Database\Factories;

use App\Models\Country;
use App\Models\User;
use App\Models\Image;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;

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
    public function definition()
    {
        $faker = Faker::create();
        return [
            'image_id' => null,
            'interest_country' => Country::all()->random()->id,
            'first_name' => $this->faker->name,
            'last_name' => $this->faker->name,
            'country_code' => Country::all()->random()->code,
            'country_phone' => Country::all()->random()->country_phone,
            'whats_app' => Country::all()->random()->country_phone . rand(1000000, 10000000),
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'is_phone_virefied' => rand(0, 1),
            'phone' => rand(1000000, 10000000),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }
}
