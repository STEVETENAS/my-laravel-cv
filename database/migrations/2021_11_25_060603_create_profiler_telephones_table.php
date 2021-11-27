<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilerTelephonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('profiler_telephones', function (Blueprint $table) {
            $table->id();
            $table->double('profiler_phone_number');
            $table->tinyText('phone_number_description');
            $table->foreignId("profiler_info_id")->constrained('profiler_infos')
                ->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('profiler_telephones');
    }
}