<?php

namespace Database\Seeders;

use App\Models\profiler_academic;
use App\Models\profiler_contract;
use App\Models\profiler_email;
use App\Models\profiler_exp;
use App\Models\profiler_info;
use App\Models\profiler_ip;
use App\Models\profiler_lang;
use App\Models\profiler_medical;
use App\Models\profiler_project;
use App\Models\profiler_resident;
use App\Models\profiler_skill;
use App\Models\profiler_telephone;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        profiler_info::factory(5)->create();
        profiler_academic::factory(10)->create();
        profiler_telephone::factory(5)->create();
        profiler_lang::factory(3)->create();
        profiler_resident::factory(5)->create();
        profiler_project::factory(45)->create();
        profiler_ip::factory(5)->create();
        profiler_medical::factory(5)->create();
        profiler_contract::factory(30)->create();
        profiler_email::factory(5)->create();
        profiler_exp::factory(12)->create();
        profiler_skill::factory(8)->create();
    }
}
