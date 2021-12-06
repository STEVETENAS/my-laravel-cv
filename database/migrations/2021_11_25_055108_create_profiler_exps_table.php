<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilerExpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('profiler_exps', function (Blueprint $table) {
            $table->id();
            $table->tinyText('job_title');
            $table->mediumText('job_description');
            $table->mediumText('company_name');
            $table->mediumText('company_website')->nullable();
            $table->date('job_start_date');
            $table->date('job_end_date')->nullable();
            $table->foreignId('profiler_infos_id');
            $table->timestampTz('deleted_at')->nullable();
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
        Schema::dropIfExists('profiler_exps');
    }
}
