<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('work__schedules', function (Blueprint $table) {
            $table->id('schedule_id');
            $table->string('start_date');
            $table->string('end_date');
            $table->string('note');
            $table->string('log_id');
            $table->timestamps();
            $table->string('id_User');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work__schedules');
    }
};
