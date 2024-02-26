<?php

namespace App\Http\Controllers;
use App\Models\Company;
use App\Models\donkey;
use App\Models\donkey1;
use App\Models\User;
use App\Models\Work_Log;
use App\Models\Absentee;
use Illuminate\Http\Request;

class AbsenteeController extends Controller
{
    public function checkAbsentees()
    {

        $users = User::all();

        foreach ($users as $user) {
            $lastCheckIn = Work_Log::where('log_id', $user->id)
                ->orderBy('Day_work', 'desc')
                ->first();

            if (!$lastCheckIn || Work_Log::parse($lastCheckIn->Day_work)->diffInHours(Work_Log::now()) >= 25) {
                // ไม่มีการเช็คอินล่าสุดหรือผ่านมากกว่า 25 ชั่วโมง
                // ทำการบันทึกข้อมูลลง Absentee
                Absentee::create([
                    'user_id' => $user->id,
                    'absent_date' => Work_Log::now()->toDateString(), // วันที่ขาดงาน
                ]);
          }      }
    }
    public function showAbsentees()
    {

        $absentees = Absentee::select('absentees.*', 'users.name as absentees_name')
        ->leftJoin('users', 'absentees.user_id', '=', 'users.id')
        ->orderBy('absentees.id', 'desc')
        ->paginate(10); // แก้จำนวนข้อมูลที่ต้องการแสดงต่อหน้าได้ที่นี่

    return view('absentees', [
        'absentees' => $absentees,
    ]);
    }

    public function store(Request $request)
    {
        // ตรวจสอบและบันทึกข้อมูลการขาดงาน
        $request->validate([
            'leave_days' => 'required|numeric',
            'request_date' => 'required|date',
            // เพิ่ม validation rules ตามความต้องการ
        ]);

        Absentee::create([
            'user_id' => $request->leave_days,
            'absent_date' => $request->request_date,
            // เพิ่ม field อื่น ๆ ที่ต้องการบันทึก
        ]);

        // ทำสิ่งที่คุณต้องการหลังจากบันทึกข้อมูล

        return redirect()->route('absentee')->with('success', 'อนุมัติการลาเรียบร้อย');
    }

    }
