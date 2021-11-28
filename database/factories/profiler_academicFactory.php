<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class profiler_academicFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $profilerIDs = DB::table('profiler_info')->pluck('id')->toArray();

        return [
            'diploma_title' => $this->faker->name,
            'diploma_description' => $this->faker->realText(300),
            'institution_attended' => $this->faker->name('male'),
            'profiler_info_id' => $this->faker->randomElement($profilerIDs),
        ];
    }
}
