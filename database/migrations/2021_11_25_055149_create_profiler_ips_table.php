<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilerIpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('profiler_ips', function (Blueprint $table) {
            $table->id();
            $table->mediumText('ip_name');
            $table->mediumText('ip_description');
            $table->binary('ip_img');
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
        Schema::dropIfExists('profiler_ips');
    }
}
