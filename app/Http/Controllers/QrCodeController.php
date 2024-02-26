<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QrCode;
use App\Models\User;
use App\Models\Company;

class QrCodeController extends Controller
{
    public function scan(Request $request)
    {
        $code = $request->input('code');
        $qrCode = QrCode::where('code', $code)->first();

        if ($qrCode) {
            return response()->json(['link' => $qrCode->link], 200);
        } else {
            return response()->json(['message' => 'QR Code not found'], 404);
        }
    }

    public function vite()
    {
        $qrCodes = QrCode::all();
        return view('adminQRcode', compact('qrCodes'));
    }
    public function CreateQrCode(Request $request)
{
    $qrCodes = QrCode::all();

 // Validate the form data
 $request->validate([
    'code' => 'required|string',
    'link' => 'required|url',
]);

// Get the form data
$code = $request->input('code');
$link = $request->input('link');

// Generate QR code

// Create a new instance of the model
$model = new QrCode();
$model->code = $code;
$model->link = $link;

// Save the model to the database
$model->save();
// Save the data or do any other necessary operations
// For example, you can store the data in the database

// Return a response (you can customize this based on your needs)
return view('adminQRcode', compact('qrCodes'));
}


public function scanuser(Request $request)
    {
        $code = $request->input('code');
        $qrCode = Company::where('id', $code)->first();

        if ($qrCode) {
            return response()->json(['link' => $qrCode->id], 200);
        } else {
            return response()->json(['message' => 'QR Code not found'], 404);
        }
    }
    public function scanUser1(Request $request)
    {
        // ดึงข้อมูลจาก request
$input = $request->only('email', 'password');
$remember = $request->has('remember');

// เพิ่ม ip address จาก QR code เข้าใน $input
$code = $request->input('code');
$qrCode = Company::where('id', $code)->first();

if ($qrCode) {
    $input['ip'] = $qrCode->ip;
} else {
    // กรณี QR code ไม่ตรง
    return response()->json(['message' => 'QR Code not found'], 404);
}

// ทำการล็อกอิน
if (auth()->attempt($input, $remember)) {
    // ทำสิ่งที่คุณต้องการ เช่น ส่งผลลัพธ์ไปที่หน้าหลัก
    return redirect('/home');
} else {
    // กรณีล็อกอินไม่สำเร็จ
    return response()->json(['message' => 'Login failed'], 401);
}
    }
    public function login(Request $request)
    {
        // รับค่า IP จาก QR Code
        $userIp = $request->ip();

        // ตรวจสอบกับฐานข้อมูล Company
        $company = Company::where('ip_address', $userIp)->first();

        if ($company) {
            // ดึงอีเมลและรหัสผ่าน
            $email = $company->email;
            $password = $company->password;

            // ส่งไปยังหน้า login
            return view('login1', compact('email', 'password'));
        } else {
            // กรณีไม่พบข้อมูลในฐานข้อมูล
            return response()->json(['message' => 'Company not found'], 404);
        }
    }

}
