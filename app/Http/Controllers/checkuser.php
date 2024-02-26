<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Models\Company;
use App\Models\donkey;
use App\Models\donkey1;
use App\Models\Work_Log;

class checkuser extends Controller
{

    public function checkuser(){
         Company::orderBy('id', 'asc')->paginate(30);
        $data['allUsers'] = Company::all();

        // ค้นหาว่ามีข้อมูลของพนักงานที่มาทำงานหรือไม่ในแต่ละวันของเดือนปัจจุบัน

    $year = date('Y');
    $month = date('m');
    $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);

    // สร้างตัวแปรเพื่อเก็บข้อมูลการมาทำงานของพนักงานในแต่ละวัน
    $attendance = [];

    // วนลูปเพื่อตรวจสอบว่าพนักงานมาทำงานหรือไม่ในแต่ละวันของเดือนปัจจุบัน
    for ($day = 1; $day <= 31; $day++) {
        $logs = Work_Log::whereYear('Day_work', $year)
            ->whereMonth('Day_work', $month)
            ->whereDay('Day_work', $day)
            ->get();
            $attendance[$day] = $logs;
        }
    // ส่งผลลัพธ์ไปยัง view
        // ดึงข้อมูลผู้ใช้จากตาราง users
        return view('checkuser', $data,['attendance' => $attendance]);


        // ส่งข้อมูลผู้ใช้ไปยัง Blade View usercom.blade.php
    }

    public function checkuser1(){

        $data['users'] = Company::orderBy('id', 'asc')->paginate(30);
        $data['allUsers'] = Company::all();

        // ดึงข้อมูลผู้ใช้จากตาราง users
        return view('checkuser1', $data);


        // ส่งข้อมูลผู้ใช้ไปยัง Blade View usercom.blade.php
    }


}
