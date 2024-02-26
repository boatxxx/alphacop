<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Work_Log;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;



class WorkLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data['work__logs'] = Work_Log::select('work__logs.*', 'name as name')
        ->leftJoin('users', 'work__logs.Users', '=', 'id')
        ->orderBy('work__logs.log_id', 'desc')
        ->paginate(20);
            // ดึงข้อมูลผู้ใช้จากตาราง work__logs
            return view('loginuser', $data);
    }
    public function index02(Request $request)
    {
        $query = Work_Log::query();

        // ตรวจสอบว่ามีการค้นหาตามสมาชิก
        if ($request->has('member_id')) {
            $query->where('user_id', $request->member_id);
        }

        // ตรวจสอบว่ามีการค้นหาตามเดือน
        if ($request->has('month')) {
            $query->whereMonth('Day_work', $request->month);
        }

        $workLogs = $query->orderBy('log_id', 'asc')->paginate(15);
        $members = User::all(); // หรือดึงข้อมูลสมาชิกมาเฉพาะที่เกี่ยวข้อง

        return view('loginuser', compact('workLogs', 'members'));
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function index01(Request $request)
    {
        $user = Auth::user();

        if ($user) {
            // ตรวจสอบว่าผู้ใช้มีการล็อกอินในวันนี้หรือไม่
            $today = now()->format('Y-m-d');
            $hasLoggedToday = $user->workLogs()->where('Day_work', $today)->exists();
            $request->all();
            $latitude = $request->input('latitude', '0.00000000');
            $longitude = $request->input('longitude', '0.00000000');
            if (!$hasLoggedToday) {

                // สร้างข้อมูลการทำงานที่ว่างเปล่าเพื่อใช้สำหรับการล็อกงาน
                $workLog = new work_Log([
                    'Day_work' => now()->format('Y-m-d'),
                    'start_time' => now()->toTimeString(),
                    'end_time' => now()->toTimeString(),
                    'latitude' => $latitude,
                    'longitude' => $longitude,
                ]);
                // เก็บข้อมูลการทำงานใหม่
                $user->workLogs()->save($workLog);

                // สร้างข้อมูลการล็อกอินในตาราง 'logs'

            }

            // ดึงข้อมูลการทำงานของผู้ใช้ที่เข้าสู่ระบบ (work logs ของผู้ใช้งานที่เข้าสู่ระบบ)
            $data['work__logs'] = $user->workLogs()->orderBy('log_id', 'desc')->paginate(5);
        } else {
            // ไม่มีผู้ใช้ล็อกอิน
            $data['work__logs'] = collect(); // ให้เป็นคอลเลกชันว่างเปล่า
        }

        return view('home', $data);


    }

    public function update(Request $request)
    {
        $user = Auth::user();

        // ตรวจสอบว่าผู้ใช้มีการล็อกอินหรือไม่
        if ($user) {
            // ตรวจสอบว่ามีการล็อกอินในวันนี้หรือไม่
            $today = now()->format('Y-m-d');
            $hasLoggedToday = $user->workLogs()->where('Day_work', $today)->exists();

            $latitude = $request->input('latitude', '0.00000000');
            $longitude = $request->input('longitude', '0.00000000');
            $user = auth()->user();
            $username = $user->name;
            $currentTime = now()->toDateTimeString();
            $message = "ชื่อพนักงาน: $username, ออกจากงานเวลา: $currentTime ตำแหน่ง  $latitude   $longitude";

            $token = 'GLbhx14KpG2gKggysIK3JVZ9imn8Ci9p0Ma6qIMSGex'; // ใส่ Access Token ที่ได้จาก Line Notify
            $client = new Client();
            $response = $client->post('https://notify-api.line.me/api/notify', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                ],
                'form_params' => [
                    'message' => $message,
                ],
            ]);
            if ($hasLoggedToday) {
                // ดึงข้อมูลการล็อกอินที่ทำในวันนี้
                $loginLog = $user->workLogs()->where('Day_work', $today)->first();

                // อัปเดตเวลา end_time ให้เป็นเวลาปัจจุบัน
                $loginLog->end_time = now()->format('H:i');
                $loginLog->latitude1 = $latitude;
                $loginLog->longitude1 = $longitude;
                $loginLog->save();
            }
        }

        // ล็อกเอาท์ผู้ใช้
        Auth::logout();

        // แสดงหน้าเข้าสู่ระบบหลังจากล็อกเอาท์
        return redirect('/login');
    }
    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {

        // ส่งข้อมูลผู้ใช้ไปยัง Blade View usercom.blade.php
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Work_Log $work_Log)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Work_Log $work_Log)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update01(Request $request, Work_Log $work_Log)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        // ตรวจสอบว่าการร้องขอถูกส่งมาด้วยเมธอด DELETE
      // ค้นหาข้อมูลในตาราง Donkey1 โดยใช้ ID
$donkey1 = Work_Log::find($id);
$donkey = Work_Log::where('log_id', $id)->first();

if ($donkey1) {
    $donkey->delete();

    $donkey1->delete();

    $donkey = Work_Log::find($id);
    if ($donkey) {
        $donkey->delete();
        return redirect()->route('loginuser')->with('success', 'Deleted successfully');

    } else {
        return redirect()->route('loginuser')->with('success', 'บันทึกข้อมูลการลาสำเร็จ');
    }
} else {
    return redirect()->route('loginuser')->with('success', 'บันทึกข้อมูลการลาสำเร็จ');

}

    }
    public function getUserLoggedInData() {

        // ตรวจสอบว่าผู้ใช้มีการล็อกอินหรือไม่
        if (Auth::check()) {
            // ดึงข้อมูลของผู้ใช้ที่ล็อกอินอยู่
            $user = Auth::user();
            // ทำสิ่งที่คุณต้องการกับข้อมูลผู้ใช้ที่ล็อกอินอยู่
            return view('loginuser', $user);
        } else {
            // ไม่มีผู้ใช้ล็อกอิน
            return null;
        }
    }
}
