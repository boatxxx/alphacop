

@extends('layouts.app')
@extends('layouts.menu')

<style>
.user-log {
    font-family: Arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
    max-width: 800px;
    margin: 0 auto;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.user-log th, .user-log td {
    padding: 12px 16px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

.user-log th {
    background-color: #f5f5f5;
    font-weight: bold;
    color: #333;
}

.user-log tbody tr:nth-child(even) {
    background-color: #f2f2f2;
}

/* ปรับแต่งเมื่อมี hover บนแถวข้อมูล */
.user-log tbody tr:hover {
    background-color: #ddd;
    cursor: pointer;
}

/* ปรับแต่งขนาดตารางสำหรับการแสดงบนคอมพิวเตอร์ */
@media screen and (min-width: 768px) {
    .user-log {
        font-size: 14px;
    }
    .user-log th, .user-log td {
        padding: 14px 18px;
    }.* กำหนดสไตล์ของแต่ละกลุ่ม */
.search-group {
    margin-bottom: 15px;
}

/* กำหนดสไตล์ของ label */
.search-label {
    display: inline-block;
    width: 150px;
    font-weight: bold;
}

/* กำหนดสไตล์ของ input */
.search-input {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    width: 30%;
}

/* กำหนดสไตล์ของ button */
.search-button {
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.search-button:hover {
    background-color: #0056b3;
}
}
</style>
@section('content')
<div class="container"  align="center" >
    <h1>ตารางเข้างานและออกงานพนักงาน</h1>
    <form action="{{ route('search1') }}" method="GET" class="search-form">
        <div class="search-group">
            <label for="start-date">ตั้งแต่:</label>
            <input type="date" name="start_date" id="start-date" class="search-input">
        </div>
        <div class="search-group">
            <label for="end-date">ถึงวันที่:</label>
            <input type="date" name="end_date" id="end-date" class="search-input">
        </div>
        <!-- เพิ่มตัวเลือกแผนก, ตำแหน่ง, ระดับตำแหน่ง, ฝ่าย, ประเภท, สถานะ, ผู้อนุมัติ เป็นอันเดียวกัน -->
        <div class="search-group">
            <label for="keyword">ค้นหา:</label>
            <input type="text" name="keyword" id="keyword" placeholder="ชื่อ, รหัส" class="search-input">
        </div>
        <button type="submit" class="search-button">ค้นหา</button>
    </form>
    <table class="user-log table table-striped table-bordered">
        <thead>

            <tr>
                <th>หรัสเข้างาน</th>
                <th>ไอดีพนักงาน</th>
                <th>ชื่อพนักงาน</th>
                <th>วันที่เข้างาน</th>
                <th>เริ่มทำงาน</th>
                <th>เลิกงาน</th>
                <th>รวมเวลาทำงาน</th>
            </tr>
        </thead>
        <tbody>
            @if ($results->isEmpty())
            <p>ไม่พบผลลัพธ์ที่คุณค้นหา</p>
        @else

        @foreach ($results as $result)
        <tr>
            <td>{{ $result->log_id }}</td>
            <td>{{ $result->Users}}  </td>
            <td>{{ $result->user_name }}</td>
            <td>{{ $result->Day_work }}</td>
            <td>{{ $result->start_Time }}</td>
            <td> {{ $result->end_time }} </td>
            <td>
                @php
                $start = Carbon\Carbon::parse($result->start_Time);
                $end = Carbon\Carbon::parse($result->end_time);
                $diff = $end->diffInMinutes($start);
                $hours = floor($diff / 60);
                $minutes = $diff % 60;
            @endphp
            {{ $hours }} ชั่วโมง {{ $minutes }} นาที
        </td>

        </td>
        @endforeach
        @endif
        @endsection

