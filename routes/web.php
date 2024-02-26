<?php

use Illuminate\Support\Facades\Route;
use app\Http\Controllers\HomeController;
use app\Http\Controllers\CompanyCRUDController;
use app\Http\Controllers\WorkLogController;
use app\Http\Controllers\DonkeyController;
use app\Http\Controllers\MoneyLogController;
use app\Http\Controllers\AbsenteeController;
use app\Http\Controllers\MonthlyController;
use App\Http\Controllers\LocationController;


use App\Models\Company;
use Illuminate\Http\Request;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::post('/update-location', [LocationController::class, 'update']);

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/homeuser', function () {
    return view('homeuser');
})->name('homeuser');



Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/adminHome', [App\Http\Controllers\HomeController::class, 'adminhome'])
    ->name('admin.home')
    ->middleware('is_admin');
Route::get('/admin', function () {
 return view('welcome'); // แสดงหน้า view ชื่อ "adminHome"
})->name('adminHome'); // กำหนดชื่อเส้นทางเป็น "adminHome"
Route::get('/usercom', [App\Http\Controllers\CompanyCRUDController::class, 'usercom'])
->name('usercom')
->middleware('is_admin');

//Route::put('/usercom/{id}', [App\Http\Controllers\CompanyCRUDController::class,'update'])->name('usercom.update');
Route::put('{id}/update', [App\Http\Controllers\CompanyCRUDController::class, 'update'])->name('users.update')->middleware('is_admin');;
Route::get('{id}/edit', [App\Http\Controllers\CompanyCRUDController::class, 'edit'])->name('edit');
Route::get('/edituser', [App\Http\Controllers\CompanyCRUDController::class, 'edituser'])->name('edituser')->middleware('is_admin');;

Route::get('create', [App\Http\Controllers\CompanyCRUDController::class, 'create'])->name('create');
Route::post('/users', [App\Http\Controllers\CompanyCRUDController::class,'store'])->name('users.store');
Route::delete('destroy/{id}', [App\Http\Controllers\CompanyCRUDController::class, 'destroy'])->name('users.destroy')->middleware('is_admin');;
Route::delete('destroylogin/{id}', [App\Http\Controllers\WorkLogController::class, 'destroy'])->name('loginuser.destroy')->middleware('is_admin');;

Route::get('{id}/home', [App\Http\Controllers\WorkLogController::class, 'index02'])->name('home02');
Route::get('/search', [App\Http\Controllers\SearchController::class, 'search'])->name('search');
Route::get('/searchabsentee', [App\Http\Controllers\SearchController::class, 'search_absentee'])->name('searchabsentee')->middleware('is_admin');;
Route::get('/search1', [App\Http\Controllers\SearchController::class, 'search1'])->name('search1')->middleware('is_admin');;

Route::get('/login01', [App\Http\Controllers\WorkLogController::class, 'index'])->name('loginuser');
Route::get('/logout', [App\Http\Controllers\WorkLogController::class, 'update'])->name('logout01');

Route::get('/home', [App\Http\Controllers\WorkLogController::class, 'index01'])->name('home');
Route::get('/businesscradmin', [App\Http\Controllers\DonkeyController::class, 'businesscradmin'])->name('businesscradmin')->middleware('is_admin');;
Route::get('/business', [App\Http\Controllers\DonkeyController::class, 'Donkey'])->name('business');

Route::get('/businessuser', [App\Http\Controllers\DonkeyController::class, 'Donkey2'])->name('businessuser');

Route::get('/businessadmin', [App\Http\Controllers\DonkeyController::class, 'Donkey1'])->name('business2')->middleware('is_admin');
Route::post('businessadmin/{id}', [App\Http\Controllers\DonkeyController::class, 'approveLeave'])->name('leave.approve');
Route::post('businessadmin1/{id}', [App\Http\Controllers\DonkeyController::class, 'approveLeave1'])->name('leave.approve1');

Route::get('/businesscreate', function () {
    return view('businesscreate');
    // โค้ดที่ใช้ในการแสดงหน้าเกี่ยวกับธุรกิจ
})->name('businesscreate');

Route::get('/leave/create',[App\Http\Controllers\DonkeyController::class, 'create'])->name('leave.create');
Route::post('/business4444', [App\Http\Controllers\DonkeyController::class, 'store'])->name('leave.store');
Route::post('/business5555', [App\Http\Controllers\DonkeyController::class, 'store1'])->name('leave.store1');
Route::post('/login-with-qrcode', [LoginController::class, 'loginWithQRCode']);

Route::get('{id}/businessedit',[App\Http\Controllers\DonkeyController::class,'edit'])->name('business.edit');
Route::post('{id}/businessedit1',[App\Http\Controllers\DonkeyController::class,'update'])->name('business.update')->middleware('is_admin');;
Route::delete('{id}/destroybusiness', [App\Http\Controllers\DonkeyController::class, 'destroy'])->name('business.destroy')->middleware('is_admin');;
Route::get('/QRcode', function () {
    return view('QRcode');
    // โค้ดที่ใช้ในการแสดงหน้าเกี่ยวกับธุรกิจ
})->name('QRcode');
Route::get('/QRcodelogin', function () {
    return view('QRcodelogin');
    // โค้ดที่ใช้ในการแสดงหน้าเกี่ยวกับธุรกิจ
})->name('QRcodelogin');

Route::get('/summarize', function () {
    return view('summarize');
    // โค้ดที่ใช้ในการแสดงหน้าเกี่ยวกับธุรกิจ
})->name('summarize');
Route::get('/daily', [App\Http\Controllers\MoneyLogController::class, 'index'])->name('daily')->middleware('is_admin');;
Route::post('/dailyMoney', [App\Http\Controllers\MoneyLogController::class, 'store'])->name('daily.store')->middleware('is_admin');;
Route::get('/exportPDF', [App\Http\Controllers\MoneyLogController::class, 'dailyMoney'])->name('exportPDF')->middleware('is_admin');;

Route::get('/monthly', [App\Http\Controllers\MonthlyController::class, 'monthly'])->name('monthly')->middleware('is_admin');;
Route::post('/calculate-salary', [App\Http\Controllers\MonthlyController::class, 'calculateSalary'])->name('calculateSalary');



Route::get('/checkuser', [App\Http\Controllers\checkuser::class, 'checkuser'])->name('checkuser')->middleware('is_admin');;
Route::post('1/checkuser', [App\Http\Controllers\checkuser::class, 'checkuser1'])->name('checkuser1');
Route::get('/absentee', [App\Http\Controllers\AbsenteeController::class, 'showAbsentees'])->name('absentee');
Route::post('/absenteeup', [App\Http\Controllers\AbsenteeController::class, 'store'])->name('absenteeup');
Route::get('/absenteecreate', function () {
    return view('absenteescreate');

})->name('absenteescreate');
Route::get('/absenteeeng', [App\Http\Controllers\AbsenteeController::class, 'checkAbsentees'])->name('absenteeeng');

use App\Http\Controllers\QrCodeController;

Route::post('/scan', [QrCodeController::class, 'scan']);
Route::post('/scanuser', [QrCodeController::class, 'scanUser1']);
Route::post('/qr-code-login', [QrCodeController::class, 'login'])->name('qr-code-login');
Route::post('/login1', [QrCodeController::class, 'login'])->name('login1');

Route::get('/adminQRcode', [QrCodeController::class, 'vite'])->name('adminQRcode');
Route::post('/adminQRcode1', [QrCodeController::class, 'generateQrCode'])->name('generate.qrcode');
Route::get('/QrCodecreate', function () {
    return view('QrCodecreate');

})->name('QrCodecreate');
Route::post('/QrCodecreatex', [QrCodeController::class, 'CreateQrCode'])->name('QrCodecreatex');


Route::get('/create', function () {
    return view('create');

})->name('create');
Route::get('/dailyMoney1', function () {
    return view('dailyMoney1');
    // โค้ดที่ใช้ในการแสดงหน้าเกี่ยวกับธุรกิจ
})->name('dailyMoney1');
Route::get('/css', [App\Http\Controllers\CssSettingcontroller::class, 'index'])->name('csssettings')->middleware('is_admin');;
Route::post('/cssstore', [App\Http\Controllers\CssSettingcontroller::class, 'store'])->name('csssettingsstore')->middleware('is_admin');;

Route::get('/app', [App\Http\Controllers\CssSettingcontroller::class, 'app'])->name('app');

Route::get('/leave_images/{image}', function ($image) {
    $path = storage_path('app/leave_images/' . $image);

    if (!file_exists($path)) {
        abort(404);
    }

    return response()->file($path);
});



