<?php

namespace App\Http\Controllers;



use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use App\Models\Company;
use App\Models\Work_Log;

class CompanyCRUDController extends Controller
{

    public function usercom(){


        $data['users'] = Company::orderBy('id', 'asc')->paginate(5);
        $data['allUsers'] = Company::all();

        // ดึงข้อมูลผู้ใช้จากตาราง users
        return view('usercom', $data);


        // ส่งข้อมูลผู้ใช้ไปยัง Blade View usercom.blade.php
    }
    public function edit($id) {

        $company = Company::findOrFail($id); // ค้นหาบริษัทจาก ID ในฐานข้อมูล
        return view('edit', compact('company'));
    }
    public function edituser() {
        $user = auth()->user(); // ดึงข้อมูลผู้ใช้ที่ล็อกอินอยู่

        return view('edituser', compact('user'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'id',
            'name',
            'email',
            'password',
            'is_admin',
            'img_user',
            'position',
            'branch',
            'id_name',
            'donkey_Day',
            'vacation_Day',
            'income',
        ]);

        //$Company = new Company;
        //$Company->name = $request->name;
        //$Company->email = $request->email;
        //$Company->save();
        $Company = new Company;
        $Company->name = $request->name;
        $Company->email = $request->email;
        $Company->password = bcrypt($request->password);
        $Company->is_admin = $request->has('is_admin');
        // ดำเนินการอัปโหลดไฟล์รูปภาพ (ถ้ามี)
        if ($request->hasFile('img_user')) {
            $Company->img_user = $request->file('img_user')->store('profile_images');
        }
        $Company->position = $request->position;
        $Company->branch = $request->branch;
        $Company->id_name = $request->id_name;
        $Company->donkey_Day = $request->donkey_Day;
        $Company->vacation_Day = $request->vacation_Day;
        $Company->income = $request->income;
        $Company->save();
         return redirect()->route('usercom')->with('success','Company has been created successfully.');


    }
    public function update(Request $request, $id)
    {

        // ตรวจสอบข้อมูลที่ส่งมา
        $request->validate([

            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'nullable|string|min:6', // รหัสผ่านไม่บังคับ
            'is_admin' => 'required|boolean',
            'img_user' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'position' => 'required|string|max:255',
            'branch' => 'required|string|max:255',
            'id_name' => 'required|string|max:255',
            'donkey_Day' => 'required|numeric',
            'vacation_Day' => 'required|numeric',
            'income' => 'required|in:0,1',
        ]);



        // ดึงข้อมูลบริษัทที่ต้องการอัปเดต
        $company = Company::find($id);

        if (!$company) {
            return redirect()->back()->with('error', 'ไม่พบบริษัทที่ต้องการอัปเดต');
        }

        // อัปเดตข้อมูลบริษัท
        $company->name = $request->name;
        $company->email = $request->email;
        // ตรวจสอบรหัสผ่านไม่บังคับ
        if ($request->filled('password')) {
            $company->password = bcrypt($request->password);
        }
        // อัปเดตภาพโปรไฟล์ถ้ามีการอัปโหลดภาพใหม่
        if ($request->hasFile('img_user')) {
            // ดำเนินการอัปโหลดภาพใหม่
            $imagePath = $request->file('img_user')->store('profile_images', 'public');
            $company->img_user = '/storage/' . $imagePath;
        }
        // อัปเดตข้อมูลอื่นๆ
        $company->position = $request->position;
        $company->branch = $request->branch;
        $company->id_name = $request->id_name;
        $company->donkey_Day = $request->donkey_Day;
        $company->vacation_Day = $request->vacation_Day;
        $company->income = $request->income;

        // บันทึกการเปลี่ยนแปลง
        $company->save();

        return redirect()->route('usercom', $company->id)->with('success', 'อัปเดตข้อมูลบริษัทสำเร็จ');
    }

    public function destroy(Request $request, $id)
    {
        $company = Company::find($id);

        if ($company) {
            $workLogs = Work_Log::where('Users', $id)->get();

            // ลบข้อมูลในตาราง Work_Log ก่อน
            foreach ($workLogs as $workLog) {
                $company->delete();

            }

            $company->delete();
            // ลบข้อมูลในตาราง Company

            return redirect()->back()->with('success', 'Company and related work logs have been deleted.');
        } else {
            return redirect()->back()->with('error', 'Company not found.');
        }



    }
}
