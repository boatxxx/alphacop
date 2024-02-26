<?php

namespace App\Http\Controllers;

use App\Models\donkey;
use App\Models\donkey1;
use App\Models\Company;

use Illuminate\Http\Request;

class DonkeyController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function edit($id) {
        $data['users'] = Company::orderBy('id', 'asc')->paginate(999);

        $company = donkey::findOrFail($id); // ค้นหาบริษัทจาก ID ในฐานข้อมูล

        return view('businessedit', ['company' => $company],$data);
    }

    public function Donkey()
    {
        $data['leave_documents'] = donkey1::orderBy('id', 'asc')->paginate(5);

        $leaveRequests = donkey::select('leave_requests.*', 'users.name as approved_by_name')
        ->leftJoin('users', 'leave_requests.approved_by', '=', 'users.id')
        ->orderBy('leave_requests.id', 'desc')
        ->paginate(5);

    //$leaveRequests1 = donkey::select('leave_requests.*', 'users.name as user_name')
    //->leftJoin('users', 'leave_requests.user_id', '=', 'users.id')
    //->orderBy('leave_requests.id', 'asc')
    //->paginate(5);
        $data['leave_requests'] = $leaveRequests;

        return view('business', $data);
    }
    public function Donkey1()
    {

        $data['leave_documents'] = donkey1::orderBy('id', 'asc')->paginate(5);
        $leaveRequests = donkey::select('leave_requests.*', 'users.name as approved_by_name')
        ->leftJoin('users', 'leave_requests.approved_by', '=', 'users.id')
        ->orderBy('leave_requests.id', 'desc')
        ->paginate(5);

        $data['leave_requests'] = $leaveRequests;

        // ดึงข้อมูลผู้ใช้จากตาราง users
        return view('business2', $data);
    }
    public function Donkey2()
    {$user = auth()->user();

        if ($user) {
            $user_id = $user->id;

            // ดึงข้อมูล leave_documents ที่เกี่ยวข้องกับ user_id ของผู้ใช้ที่ล็อกอิน
            $data['leave_documents'] = donkey::where('user_id', $user_id)
                ->orderBy('id', 'asc')
                ->paginate(10);

            // ดึงข้อมูล leave_requests ที่เกี่ยวข้องกับ user_id ของผู้ใช้ที่ล็อกอิน
            $leaveRequests = donkey::select('leave_requests.*', 'users.name as approved_by_name')
                ->leftJoin('users', 'leave_requests.approved_by', '=', 'users.id')
                ->where('leave_requests.user_id', $user_id)
                ->orderBy('leave_requests.id', 'desc')
                ->paginate(10);

            $data['leave_requests'] = $leaveRequests;

            return view('businessuser', $data);
        } else {
            return redirect()->route('login');
        }

    }
    public function approveLeave($id)
{

    $leaveRequest = donkey::findOrFail($id);
    // สามารถเพิ่มการตั้งค่าสถานะการอนุมัติใน $leaveRequest ได้ตามต้องการ
    $approver = auth()->user();


    // อัปเดตข้อมูลในฐานข้อมูล
    $leaveRequest->update([
        'approved_by' => $approver->id, // ให้ approved_by เป็น ID ของผู้ใช้ที่อนุญาติ
        'status' => 'approved', // อัปเดตสถานะเป็น 'approved'
    ]);

    return redirect()->route('businessuser')->with('success', 'อนุมัติการลาเรียบร้อย');
}
public function approveLeave1($id)
{ $user = auth()->user();

    $leaveRequest = donkey::findOrFail($id);
    // สามารถเพิ่มการตั้งค่าสถานะการอนุมัติใน $leaveRequest ได้ตามต้องการ
    $approver = auth()->user();


    // อัปเดตข้อมูลในฐานข้อมูล
    $leaveRequest->update([
        'approved_by' => $approver->id, // ให้ approved_by เป็น ID ของผู้ใช้ที่อนุญาติ
        'status' => 'rejected', // อัปเดตสถานะเป็น 'approved'
    ]);

    return redirect()->route('businessuser')->with('success', 'ปฏิเสธการลา');
}
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $user = auth()->user();

        $data = $request->validate([
            'leave_type' => 'required|string|max:50',
            'leave_days' => 'required|integer',
            'reason' => 'required|string',
            'request_date' => 'required|date',
            'image' => 'required|file|mimes:jpeg,jpg,png,gif|max:2048', // ตรวจสอบไฟล์รูปภาพ            'user_id' => auth()->user()->id,


            // เพิ่มกฎการตรวจสอบข้อมูลอื่นๆ ที่ต้องการ
        ]);
        $leaveRequest = donkey::create([
            // ข้อมูลการลาที่สร้างจาก form input
            'user_id' => auth()->user()->id,
            'leave_type' => $data['leave_type'],
            'leave_days' => $data['leave_days'],
            'reason' => $data['reason'],
            'request_date' => $data['request_date'],
            // ... ข้อมูลอื่นๆ
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $imagePath = $image->store('leave_images');

            // สร้างข้อมูลในตาราง leave_documents โดยระบุ leave_request_id
            $leaveDocument = donkey1::create([
                'leave_request_id' =>  $leaveRequest->id, // ให้ leave_request_id เท่ากับ id ของ leave_requests
                'file_name' => $imageName,
                'file_path' => $imagePath,
            ]);

            // ... ส่วนที่เหลือของโค้ด
        }


        // สร้างข้อมูลการลาในฐานข้อมูล
        $data['user_id'] = $user->id;

        return redirect()->route('businessuser')->with('success', 'บันทึกข้อมูลการลาสำเร็จ');
    }
    public function store1(Request $request)
    {

        $selectedCompanyID = $request->input('selected_company_id');

        $data = $request->validate([
            'leave_type' => 'required|string|max:50',
            'leave_days' => 'required|integer',
            'reason' => 'required|string',
            'request_date' => 'required|date',
            'image' => 'required|file|mimes:jpeg,jpg,png,gif|max:2048', // ตรวจสอบไฟล์รูปภาพ            'user_id' => auth()->user()->id,


            // เพิ่มกฎการตรวจสอบข้อมูลอื่นๆ ที่ต้องการ
        ]);
        $leaveRequest = donkey::create([
            // ข้อมูลการลาที่สร้างจาก form input
            'user_id' => $selectedCompanyID,
            'leave_type' => $data['leave_type'],
            'leave_days' => $data['leave_days'],
            'reason' => $data['reason'],
            'request_date' => $data['request_date'],
            // ... ข้อมูลอื่นๆ
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $imagePath = $image->store('leave_images');

            // สร้างข้อมูลในตาราง leave_documents โดยระบุ leave_request_id
            $leaveDocument = donkey1::create([
                'leave_request_id' =>  $leaveRequest->id, // ให้ leave_request_id เท่ากับ id ของ leave_requests
                'file_name' => $imageName,
                'file_path' => $imagePath,
            ]);

            // ... ส่วนที่เหลือของโค้ด
        }


        // สร้างข้อมูลการลาในฐานข้อมูล

        return redirect()->route('businessuser')->with('success', 'บันทึกข้อมูลการลาสำเร็จ');
    }
    /**
     * Display the specified resource.
     */
    public function show(donkey $donkey)
    {
        //
    }
    public function businesscradmin()
    {

        $data['users'] = Company::orderBy('id', 'asc')->paginate(999);


        // ดึงข้อมูลผู้ใช้จากตาราง users
        return view('businesscradmin', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $selectedCompanyID = $request->input('selected_company_id');

        $data = $request->validate([
            'user_id' => $selectedCompanyID,
            'leave_type' => 'required|string|max:50',
            'leave_days' => 'required|integer',
            'reason' => 'required|string',
            'request_date' => 'required|date',
            'image' => 'file|mimes:jpeg,jpg,png,gif|max:2048',
        ]);

        $leaveRequest = donkey::findOrFail($id);

        // อัปเดตข้อมูลการลาจากแบบฟอร์ม
        $leaveRequest->update([
            'user_id' => $selectedCompanyID,
            'leave_type' => $data['leave_type'],
            'leave_days' => $data['leave_days'],
            'reason' => $data['reason'],
            'request_date' => $data['request_date'],
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $imagePath = $image->store('leave_images');

            // อัปเดตข้อมูลในตาราง leave_documents โดยระบุ leave_request_id
            $leaveDocument = donkey1::where('leave_request_id', $leaveRequest->id)->first();
            if ($leaveDocument) {
                $leaveDocument->update([
                    'file_name' => $imageName,
                    'file_path' => $imagePath,
                ]);
            } else {
                // ถ้ายังไม่มีข้อมูลในตาราง leave_documents ให้สร้างใหม่
                donkey1::create([
                    'leave_request_id' => $leaveRequest->id,
                    'file_name' => $imageName,
                    'file_path' => $imagePath,
                ]);
            }
        }

        // ส่วนที่เหลือของโค้ด
        // ...

        return redirect()->route('businessuser')->with('success', 'อัปเดตข้อมูลการลาสำเร็จ');
    }






    /**
     * Remove the specified resource from storage.
     */

     public function destroy(Request $request, $id)
     {

         // ตรวจสอบว่าการร้องขอถูกส่งมาด้วยเมธอด DELETE
      // ค้นหาข้อมูลในตาราง Donkey1 โดยใช้ ID
$donkey1 = donkey::find($id);
$donkey = donkey1::where('leave_request_id', $id)->first();

if ($donkey1) {
    $donkey->delete();

    $donkey1->delete();

    $donkey = donkey::find($id);
    if ($donkey) {
        $donkey->delete();
        return redirect()->route('business')->with('success', 'Deleted successfully');

    } else {
        return redirect()->route('business')->with('success', 'บันทึกข้อมูลการลาสำเร็จ');
    }
} else {
    return redirect()->route('business')->with('success', 'บันทึกข้อมูลการลาสำเร็จ');

}
}
}
