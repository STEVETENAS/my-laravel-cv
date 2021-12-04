<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class profiler_skillFactory extends Factory
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
            'skill_title' => $this->faker->name,
            'skill_level' => $this->faker->numberBetween(50, 100),
            'skill_description' => $this->faker->realText(300),
            'profiler_infos_id' => $this->faker->randomElement($profilerIDs),
        ];
    }
}
