<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class profiler_residentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $profilerIDs = DB::table('profiler_infos')->pluck('id')->toArray();

        return [
            'place_of_residence' => $this->faker->streetName,
            'city_of_residence' => $this->faker->city,
            'country_of_residence' => $this->faker->country,
            'residence_longitude' => $this->faker->longitude,
            'residence_latitude' => $this->faker->latitude,
            'profiler_infos_id' => $this->faker->randomElement($profilerIDs),
        ];
    }
}
