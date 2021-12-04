<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilerLangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('profiler_langs', function (Blueprint $table) {
            $table->id();
            $table->tinyText('language');
            $table->unsignedTinyInteger('language_level');
            $table->foreignId("profiler_infos_id");
            $table->timestampTz('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('profiler_langs');
    }
}
