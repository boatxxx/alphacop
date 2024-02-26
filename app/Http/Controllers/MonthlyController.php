<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;
use App\Models\Work_Log;
use App\Models\Company;
class MonthlyController extends Controller
{
    public function monthly()
    {
        $monthlyUsers = User::where('income', 1)->get();

        return view('monthly', ['monthlyUsers' => $monthlyUsers]);
    }




    public function calculateSalary(Request $request)
    {
        $companyselect = $request->input('user');

        $userId = $request->input('user');
        $salary = $request->input('salary');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $deductionamount = $request->input('deduction_amount', []);
        $deductionname = $request->input('deduction_name', []);
        $deductionamount1 = $request->input('deduction_amount1', []);
        $deductionname1 = $request->input('deduction_name1', []);
        $currentDate = date("Y-m-d");
        $query = Work_Log::query();
        $Users = Company::find($companyselect);
        if (count($deductionname) === count($deductionamount)) {
            $deductions = array_combine($deductionname, $deductionamount);
        } else {
            // ทำการจัดการกรณีที่จำนวนสมาชิกไม่เท่ากัน
            // อาจแสดงข้อความผิดพลาดหรือปรับปรุงโค้ดตามสถานการณ์
        }
        // ดึงข้อมูลการทำงานจากตาราง Work_Log
        $workDays = Work_Log::where('log_id', $userId)
            ->where('start_Time', '>=', $startDate) // กรองตั้งแต่เวลาเริ่มต้น
            ->where('end_time', '<=', $endDate) // กรองจนถึงเวลาสิ้นสุด
            ->count();

        // คำนวณเงินเดือน
        $fullMonthSalary = $salary; // เงินเดือนเต็มของเดือน
        $dailyDeduction = $salary / 21; // คำนวณหักต่อวัน

        if ($workDays >= 21) {
            $baseSalary = $fullMonthSalary; // ได้รับเงินเต็มจำนวนถ้าทำงาน >= 21 วัน
        } else {
            $deduction = $dailyDeduction * (21 - $workDays); // คำนวณเงินที่ต้องหัก
            // หักเงินตามจำนวนวันที่ขาดทำงาน
            $baseSalary = $salary - $deduction;

            // ไม่ให้เงินเดือนติดลบ
            if ($baseSalary < 0) {
                $baseSalary = 0;
            }
        }


    return view('result', [
        'userId' => $userId,
        'startDate' => $startDate,
        'endDate' => $endDate,
        'baseSalary' => $baseSalary,
        'workDays' => $workDays,
        'deduction' => $deduction,
        'currentDate' => $currentDate,
        'Users' => $Users,
        'deductionamount1' => $deductionamount1,
        'deductionamount' => $deductionamount,
        'deductionname1' => $deductionname1,
        'deductionname' => $deductionname,
    ]);



    }
}

