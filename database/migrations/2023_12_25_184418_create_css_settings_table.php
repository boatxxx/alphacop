<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('css_settings', function (Blueprint $table) {
            $table->id();
            $table->string('background_image')->nullable();
            $table->string('background_color')->nullable();
            $table->string('table_border_color')->nullable();
            $table->string('font_size')->nullable();
            // เพิ่มฟิลด์อื่น ๆ ตามต้องการ
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('css_settings');
    }
};
