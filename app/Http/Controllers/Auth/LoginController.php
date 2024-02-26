<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;


class LoginController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';
// Example in a Laravel Controller method

public function loginWithQRCode(Request $request)
{

    $qrcode_data = $request->input('qrcode_data');

    // ตรวจสอบว่า $qrcode_data ถูกต้องหรือไม่
    // ดำเนินการเข้าสู่ระบบในกรณีที่ถูกต้อง

    // เข้าสู่ระบบผู้ใช้ด้วย qrcode_id
    $user = User::where('qrcode_id', $qrcode_data)->first();

    if ($user) {
        // สร้าง access token สำหรับผู้ใช้
        $token = $user->createToken('QRCodeToken')->accessToken;

        return response()->json(['token' => $token]);
    } else {
        return response()->json(['error' => 'Invalid QR Code'], 401);
    }


}

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->middleware('guest')->except('logout');
    }
    public function  login(Request $request)
    {

        $remember = $request->has('remember'); // รับค่าจาก checkbox ในฟอร์ม

        $input = $request->all();
        $latitude = floatval($request->input('latitude'));
        $longitude = floatval($request->input('longitude'));
        $this->validate($request,[
            'email'=>'required|email',
            'password'=>'required'
        ]);


        if (auth()->attempt(['email' => $input['email'], 'password' => $input['password']],$remember)){

            $user = auth()->user();
            $username = $user->name;
            $currentTime = now()->toDateTimeString();
            $message = "ชื่อพนักงาน: $username, เข้างานเวลา: $currentTime ตำแหน่ง  $latitude   $longitude";

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
            if(auth(

            )->user()->is_admin == 1) {
                return redirect()->route('admin.home');
            } else{
                return redirect()->route('home', ['latitude' => $latitude, 'longitude' => $longitude]);
            }

        }else{
            return redirect()->route('login')->with('error','Eamil-address and Password are wrong.');
        }
    }


}


namespace App\Traits;

trait AuthTrait
{
    public function checkLogin()
    {
        // ตรวจสอบว่ามีการล็อกอินอยู่หรือไม่
        if (auth()->check()) {
            // ตรวจสอบสิทธิ์ของผู้ใช้
            if (auth()->user()->Company->is_admin == 1) {
                return redirect()->route('admin.home');


                // มีสิทธิ์เข้าถึงทุกหน้า
                // ทำสิ่งที่ต้องการเมื่อเป็นแอดมิน
                // เช่น redirect ไปหน้าที่เหมาะสมสำหรับแอดมิน
            } else {
                return redirect()->route('home');

                // ไม่ใช่แอดมิน
                // ทำสิ่งที่ต้องการเมื่อไม่ใช่แอดมิน
                // เช่น redirect ไปหน้า loginuser หรือ businesscreate
            }
        } else {
            return redirect()->route('login')->with('error','Eamil-address and Password are wrong.');

            // ไม่ได้ล็อกอิน
            // ทำสิ่งที่ต้องการเมื่อไม่ได้ล็อกอิน
            // เช่น redirect ไปหน้า login
        }
    }
}


