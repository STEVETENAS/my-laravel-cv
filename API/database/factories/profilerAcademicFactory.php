<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class profilerAcademicFactory extends Factory
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
            'diploma_title' => $this->faker->name,
            'diploma_description' => $this->faker->text(100),
            'institution_attended' => $this->faker->name,
            'profiler_infos_id' => $this->faker->randomElement($profilerIDs),
        ];
    }
}
