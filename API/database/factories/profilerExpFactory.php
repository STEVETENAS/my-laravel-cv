<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class profilerExpFactory extends Factory
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
            'job_title' => $this->faker->jobTitle,
            'job_description' => $this->faker->realText(300),
            'company_name' => $this->faker->company,
            'company_website' => $this->faker->domainName,
            'job_start_date' => $this->faker->date,
            'job_end_date' => $this->faker->date,
            'profiler_infos_id' => $this->faker->randomElement($profilerIDs),
        ];
    }
}
