<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilerResidentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('profiler_residents', function (Blueprint $table) {
            $table->id();
            $table->string('place_of_residence');
            $table->string('city_of_residence');
            $table->string('country_of_residence');
            $table->double('residence_longitude');
            $table->double('residence_latitude');
            $table->foreignId("profiler_infos_id");
            $table->timestampTz('deleted_at');
            $table->timestampsTz();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('profiler_residents');
    }
}
