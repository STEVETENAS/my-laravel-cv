<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilerProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('profiler_projects', function (Blueprint $table) {
            $table->id();
            $table->mediumText('project_name');
            $table->mediumText('project_description');
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
        Schema::dropIfExists('profiler_projects');
    }
}
