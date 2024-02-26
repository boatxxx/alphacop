<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Work_Log;
use App\Models\User;
use App\Models\Company;
use App\Models\Absentee;

class SearchController extends Controller
{
    public function search(Request $request)
    {

        $keyword = $request->input('keyword');
        $searchResults = User::where('id', 'like', '%' . $keyword . '%')->get();
        $searchResults1 = Company::where('id', 'like', '%' . $keyword . '%')
            ->orWhere('name', 'like', '%' . $keyword . '%')
            ->get();

        $companies = Company::all(); // ดึงข้อมูลบริษัททั้งหมด

        // ดึงค่าที่ถูกเลือกมาจากคำค้นหา (หากมี)
        $selectedCompanyID = $request->input('selected_company_id');
        $selectedCompany = null;

        if ($selectedCompanyID) {
            $selectedCompany = Company::find($selectedCompanyID);
        }

        return view('search_results', [
            'searchResults' => $searchResults,
            'searchResults1' => $searchResults1,
            'companies' => $companies, // ส่งข้อมูลบริษัททั้งหมดไปยัง View
            'selectedCompany' => $selectedCompany,
        ]);

    }
    public function search_absentee(Request $request)
    {

        $absentees1 = Absentee::select('absentees.*', 'users.name as absentees_name')
        ->leftJoin('users', 'absentees.user_id', '=', 'users.id')
        ->orderBy('absentees.id', 'asc')
        ->paginate(10); // แก้จำนวนข้อมูลที่ต้องการแสดงต่อหน้าได้ที่นี่


        $keyword = $request->input('keyword1');


        $companies = Absentee::all(); // ดึงข้อมูลบริษัททั้งหมด

        $absentees = Absentee::select('absentees.*', 'users.name as absentees_name')
    ->leftJoin('users', 'absentees.user_id', '=', 'users.id')
    ->where('absentees.user_id', 'like', '%' . $keyword . '%')
    ->orderBy('absentees.id', 'asc')
    ->paginate(10);
        // ดึงค่าที่ถูกเลือกมาจากคำค้นหา (หากมี)
        $selectedCompanyID = $request->input('selected_company_id1');
        $selectedCompany = null;





        if ($selectedCompanyID) {
            $selectedCompany = Absentee::find($selectedCompanyID);
        }

        return view('search_absentees', [
            'companies' => $companies, // ส่งข้อมูลบริษัททั้งหมดไปยัง View
            'selectedCompany' => $selectedCompany,
            'absentees' => $absentees,
            'absentees1' => $absentees1,
        ]);

    }
    public function search1(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $branch = $request->input('Users');
        // เพิ่มตัวแปรสำหรับแผนก, ตำแหน่ง, ระดับตำแหน่ง, ฝ่าย, ประเภท, สถานะ, และผู้อนุมัติ

        $keyword = $request->input('keyword');

        $query = Work_Log::query();
        $query->select('work__logs.*', 'users.name as user_name')
            ->leftJoin('users', 'work__logs.Users', '=', 'users.id') // เชื่อมโยงกับตาราง users
            ->orderBy('work__logs.log_id', 'asc');

        if ($startDate) {
            $query->whereDate('Day_work', '>=', $startDate);
        }

        if ($endDate) {
            $query->whereDate('Day_work', '<=', $endDate);
        }

        if ($branch && $branch !== 'all') {
            $query->where('branch', $branch);
        }

        // เพิ่มเงื่อนไขสำหรับแผนก, ตำแหน่ง, ระดับตำแหน่ง, ฝ่าย, ประเภท, สถานะ, และผู้อนุมัติ

        if ($keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->where('users.name', 'like', '%' . $keyword . '%')
                  ->orWhere('Users', 'like', '%' . $keyword . '%');
            });
        }

        $results = $query->paginate(99);
        $searchResults1 = Company::all();

        // ส่งข้อมูลผลการค้นหากลับไปยัง View
        return view('search_results1', ['results' => $results,  'searchResults1' => $searchResults1]);
    }
}
