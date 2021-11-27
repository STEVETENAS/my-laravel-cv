<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilerMedicalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('profiler_medicals', function (Blueprint $table) {
            $table->id();
            $table->mediumText('medical_status');
            $table->Text('medical_description');
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
        Schema::dropIfExists('profiler_medicals');
    }
}
