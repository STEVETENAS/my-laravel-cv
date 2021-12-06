<?php

namespace Database\Seeders;

use App\Models\profilerAcademic;
use App\Models\profilerContract;
use App\Models\profilerEmail;
use App\Models\profilerExp;
use App\Models\profilerInfo;
use App\Models\profilerIp;
use App\Models\profilerLang;
use App\Models\profilerMedical;
use App\Models\profilerProject;
use App\Models\profilerResident;
use App\Models\profilerSkill;
use App\Models\profilerTelephone;
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
        profilerInfo::factory(5)->create();
        profilerAcademic::factory(10)->create();
        profilerTelephone::factory(5)->create();
        profilerLang::factory(3)->create();
        profilerResident::factory(5)->create();
        profilerProject::factory(45)->create();
        profilerIp::factory(5)->create();
        profilerMedical::factory(5)->create();
        profilerContract::factory(30)->create();
        profilerEmail::factory(5)->create();
        profilerExp::factory(12)->create();
        profilerSkill::factory(8)->create();
    }
}
