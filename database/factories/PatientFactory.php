<?php

namespace Database\Factories;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

class PatientFactory extends Factory
{

    protected $model = Patient::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    
    public function definition()
    {
        $faker = \Faker\Factory::create('en_US');
        $gender = $faker->randomElement(['male', 'female']);
        return [
            'uuid' => $faker->uuid(),
            'first_name' => $faker->firstName(($gender)),
            'last_name' => $faker->lastName(($gender)),
            'mobile' => $faker->phoneNumber(),
            'email' => $faker->email(),
            'gender' => $gender,
            'ssn'=>$faker->ssn(),
            'birthday' => $faker->date(),
            'address' => $faker->streetAddress(),
            'city' => $faker->city(),
            'state' => $faker->state(),
            'zip' => $faker->postcode(),
            'emg_first_name' => $faker->firstName(($gender)),
            'emg_last_name' => $faker->lastName(($gender)),
            'emg_mobile' => $faker->phoneNumber(),
            'emg_email' => $faker->email(),
            'emg_address' => $faker->streetAddress(),
            'emg_city' => $faker->city(),
            'emg_state' => $faker->state(),
            'emg_zip' => $faker->postcode(),
        ];
    }
}
