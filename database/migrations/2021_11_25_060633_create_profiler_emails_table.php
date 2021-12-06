<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilerEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('profiler_emails', function (Blueprint $table) {
            $table->id();
            $table->mediumText('profiler_email');
            $table->mediumText('email_description');
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
        Schema::dropIfExists('profiler_emails');
    }
}
