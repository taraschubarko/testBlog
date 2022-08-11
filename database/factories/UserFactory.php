<?php

namespace Database\Factories;

use App\Models\Geo;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $country = Geo::query()->get('country');
        $country = $country->unique('country')->toArray();
        $country = fake()->randomElement($country);
        //
        $city = Geo::query()->where('country', $country['country'])->get('city');
        $city = $city->unique('city')->toArray();
        $city = fake()->randomElement($city);
        //
        $birthday = fake()->dateTimeBetween('-60 years', '- 16 years');
        $gender = fake()->randomElement([User::GENDER_MALE, User::GENDER_FEMALE]);
        $mf = [1 => 'male', 2 => 'female'];

        return [
            'name' => fake('ru_RU')->name($mf[$gender]),
            'email' => fake()->safeEmail(),
            'birthday' => $birthday,
            'gender' => $gender,
            'country' => $country['country'],
            'city' => $city['city'],
            'email_verified_at' => now(),
            'password' => 'password', // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
