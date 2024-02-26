<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Work_Log;
use App\Models\Company;
use App\Models\donkey;
use App\Models\donkey1;
use App\Models\User;
use App\Models\Absentee;


class HomeController extends Controller
{



    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function workLogs()
    {
        return $this->hasMany(WorkLog::class);
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();

        if ($user) {
            // ตรวจสอบว่าผู้ใช้มีการล็อกอินในวันนี้หรือไม่
            $today = now()->format('Y-m-d');
            $hasLoggedToday = $user->workLogs()->where('Day_work', $today)->exists();

            if (!$hasLoggedToday) {

                // สร้างข้อมูลการทำงานที่ว่างเปล่าเพื่อใช้สำหรับการล็อกงาน
                $workLog = new Work_Log([
                    'Day_work' => now()->format('Y-m-d'),
                    'start_time' => now()->format('H:i'),
                    'end_time' => now()->format('H:i'),
                ]);
                // เก็บข้อมูลการทำงานใหม่
                $user->workLogs()->save($workLog);

                // สร้างข้อมูลการล็อกอินในตาราง 'logs'
                $loginLog = new Work_Log([
                    'type' => 'login',
                ]);
                $user->workLogs()->save($loginLog);
            }

            // ดึงข้อมูลการทำงานของผู้ใช้ที่เข้าสู่ระบบ (work logs ของผู้ใช้งานที่เข้าสู่ระบบ)
            $data['work__logs'] = $user->workLogs()->orderBy('log_id', 'asc')->paginate(5);
        } else {
            // ไม่มีผู้ใช้ล็อกอิน
            $data['work__logs'] = collect(); // ให้เป็นคอลเลกชันว่างเปล่า
        }

        return view('home', $data);
        dd($variable);
        return view('home');
    }
    public function adminHome(Request $request)
    {
        $userCount = User::count('id');
        $userCount1 = Work_Log::count('log_id');
        $userCount2 = Donkey::count('id'); // Assuming 'donkey' is a model named 'Donkey'
        $userCount3 = Absentee::count('id'); // Assuming 'donkey' is a model named 'Donkey'

        $data['work__logs'] = Work_Log::select('work__logs.*', 'name as name')
        ->leftJoin('users', 'work__logs.Users', '=', 'id')
        ->orderBy('work__logs.log_id', 'asc')
        ->paginate(10);
            // ดึงข้อมูลผู้ใช้จากตาราง work__logs
            $dayCounts = Work_Log::selectRaw('
            SUM(CASE WHEN DAYOFWEEK(Day_work) = 2 THEN 1 ELSE 0 END) AS Monday,
            SUM(CASE WHEN DAYOFWEEK(Day_work) = 3 THEN 1 ELSE 0 END) AS Tuesday,
            SUM(CASE WHEN DAYOFWEEK(Day_work) = 4 THEN 1 ELSE 0 END) AS Wednesday,
            SUM(CASE WHEN DAYOFWEEK(Day_work) = 5 THEN 1 ELSE 0 END) AS Thursday,
            SUM(CASE WHEN DAYOFWEEK(Day_work) = 6 THEN 1 ELSE 0 END) AS Friday,
            SUM(CASE WHEN DAYOFWEEK(Day_work) = 7 THEN 1 ELSE 0 END) AS Saturday,
            SUM(CASE WHEN DAYOFWEEK(Day_work) = 1 THEN 1 ELSE 0 END) AS Sunday'
        )
        ->first();

        // เข้าถึงข้อมูลจำนวนวันของแต่ละวัน

        $webAccessCount = $request->session()->get('web_access_count', 0);
        $webAccessCount++;
        $request->session()->put('web_access_count', $webAccessCount);
        return view('adminHome', [
            'userCount' => $userCount,
            'userCount1' => $userCount1,
            'userCount2' => $userCount2,
            'userCount3' => $userCount3,
            'dayCounts' => $dayCounts,
            'webAccessCount' => $webAccessCount,


        ], $data);
    }


}
