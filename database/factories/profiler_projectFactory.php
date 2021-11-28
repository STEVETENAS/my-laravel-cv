<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class profiler_projectFactory extends Factory
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
            'project_name' => $this->faker->name,
            'project_description' => $this->faker->realText(300),
            'profiler_info_id' => $this->faker->randomElement($profilerIDs),
        ];
    }
}
