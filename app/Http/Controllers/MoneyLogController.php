<?php

namespace App\Http\Controllers;

use App\Models\money_Log;
use App\Models\Work_Log;
use App\Models\Company;

use PDF;
use TCPDF;

use Illuminate\Http\Request;

class MoneyLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data ['allUsers']= Company::where('income', 0)->get();

        return view('daily', $data);

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

        $companyselect = $request->input('company-select');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $daily = $request->input('daily');
        $deductionamount = $request->input('deduction_amount', []);
        $deductionname = $request->input('deduction_name', []);
        $deductionamount1 = $request->input('deduction_amount1', []);
        $deductionname1 = $request->input('deduction_name1', []);
        $Users = Company::find($companyselect);
        $query = Work_Log::query();
        $currentDate = date("Y-m-d");
        if (count($deductionname) === count($deductionamount)) {
            $deductions = array_combine($deductionname, $deductionamount);
        } else {
            // ทำการจัดการกรณีที่จำนวนสมาชิกไม่เท่ากัน
            // อาจแสดงข้อความผิดพลาดหรือปรับปรุงโค้ดตามสถานการณ์
        }


        if (!$Users) {
            return redirect()->back()->with('error', 'ไม่พบพนักงานที่ระบุ');
        }

        $workSchedules = Work_Log::where('Users', $companyselect)
        ->whereBetween('Day_work', [$startDate, $endDate])
        ->get();
        $workDays = $workSchedules->count();

        $totalWages = $workDays * $daily;
        return view('dailyMoney1', compact('Users', 'workDays', 'totalWages', 'startDate', 'endDate','daily','deductionamount','deductionname','currentDate','deductionamount1','deductionname1'));

    }

    public function dailyMoney(Request $request) {

        $companyselect = $request->input('company-select');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $daily = $request->input('daily');
        $deductionamount = $request->input('deduction_amount', []);
        $deductionname = $request->input('deduction_name', []);
        $deductionamount1 = $request->input('deduction_amount1', []);
        $deductionname1 = $request->input('deduction_name1', []);
        $Users = Company::find($companyselect);
        $query = Work_Log::query();
        $currentDate = date("Y-m-d");
        return view('dailyMoney', compact('Users',  'startDate', 'endDate','daily','deductionamount','deductionname','currentDate','deductionamount1','deductionname1'));


    }
    public function exportPDF(Request $request){

        $companyselect = $request->input('company-select');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $daily = $request->input('daily');
        $deductionamount = $request->input('deduction_amount', []);
        $deductionname = $request->input('deduction_name', []);
        $deductionamount1 = $request->input('deduction_amount1', []);
        $deductionname1 = $request->input('deduction_name1', []);
        $Users = Company::find($companyselect);
        $query = Work_Log::query();
        $currentDate = date("Y-m-d");
        return view('dailyMoney1', compact('Users',  'startDate', 'endDate','daily','deductionamount','deductionname','currentDate','deductionamount1','deductionname1'));


    }
/**
     * Display the specified resource.
     */
    public function show(money_Log $money_Log)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(money_Log $money_Log)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, money_Log $money_Log)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(money_Log $money_Log)
    {
        //
    }
}

