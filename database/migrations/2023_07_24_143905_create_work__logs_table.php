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
        Schema::create('work__logs', function (Blueprint $table) {
            $table->id('log_id');
            $table->string('Day_work')->nullable();
            $table->unsignedBigInteger('Users'); // น่าจะใช้ unsignedBigInteger แทน string สำหรับ Users
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->decimal('latitude', 10, 8)->default(0);
            $table->decimal('longitude', 11, 8)->default(0);
            $table->decimal('latitude1', 10, 8)->default(0);
            $table->decimal('longitude1', 11, 8)->default(0);

            $table->timestamps();

            $table->unique(['Users', 'Day_work']);
            $table->index('log_id');
            $table->foreign('Users')->references('id')->on('users');
            // ไม่จำเป็นต้องมี foreign key สำหรับ log_id ที่อ้างอิงตาราง users แล้ว
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work__logs');
    }
};
