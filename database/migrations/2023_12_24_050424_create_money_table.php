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
        Schema::create('salary_slips', function (Blueprint $table) {
            $table->id(); // รหัสสลิปเงินเดือน (Primary Key)
            $table->string('company_name'); // ชื่อบริษัท
            $table->string('address'); // ที่อยู่บริษัท
            $table->string('country'); // ประเทศ
            $table->string('phone'); // เบอร์โทรศัพท์บริษัท
            $table->string('email'); // อีเมลของบริษัท
            $table->date('issued_date'); // วันที่ประกาศ
            $table->string('employee_name'); // ชื่อพนักงาน
            $table->string('employee_id'); // รหัสพนักงาน
            $table->string('branch'); // สาขา
            $table->string('position'); // ตำแหน่ง
            $table->date('start_date'); // วันที่เริ่มงาน
            $table->date('end_date'); // วันที่สิ้นสุดการทำงาน
            $table->text('income_items'); // รายการรายได้ (เก็บข้อมูลในรูปแบบ JSON หรือ Text)
            $table->text('deduction_items'); // รายการหัก (เก็บข้อมูลในรูปแบบ JSON หรือ Text)
            $table->decimal('net_amount', 10, 2); // ยอดสุทธิ
            $table->string('signature'); // ลายเซ็น

            $table->timestamps(); // เพิ่ม timestamps สำหรับ created_at และ updated_at

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salary_slips');
    }
};
