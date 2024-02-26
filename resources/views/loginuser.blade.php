
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
    }
/* กำหนดสไตล์ของแต่ละกลุ่ม */
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
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" integrity="" crossorigin=""/>

<script src="https://unpkg.com/leaflet/dist/leaflet.js" integrity="" crossorigin=""></script>
<div align="center" class="alert alert-success">
    {{ session('success') }}
</div>
<div class="container"  align="center" >
    <h1>ตารางเข้างานและออกงานพนักงาน</h1>
    <form action="{{ route('search1') }}" method="GET" class="search-form">
        <div class="search-group">
            <label for="start-date" class="search-label">ตั้งแต่:</label>
            <input type="date" name="start_date" id="start-date" class="search-input">
        </div>
        <div class="search-group">
            <label for="end-date" class="search-label">ถึงวันที่:</label>
            <input type="date" name="end_date" id="end-date" class="search-input">
        </div>
        <!-- เพิ่มตัวเลือกแผนก, ตำแหน่ง, ระดับตำแหน่ง, ฝ่าย, ประเภท, สถานะ, ผู้อนุมัติ เป็นอันเดียวกัน -->
        <div class="search-group">
            <label for="keyword" class="search-label">ค้นหา:</label>
            <input type="text" name="keyword" id="keyword" placeholder="ชื่อ, รหัส" class="search-input">
        </div>
        <button type="submit" class="search-button">ค้นหา</button>
    </form>

    <table class="user-log table table-striped table-bordered">
        <thead>

            <tr>
                <th>id</th>
                <th>id:User</th>
                <th>Name</th>
                <th>วันที่เข้างาน</th>
                <th>เริ่มทำงาน</th>
                <th>เลิกงาน</th>
                <th>เข้างาน</th>
                <th>ออกงาน</th>
                <th>เวลาทำงาน</th>

        </thead>
        <tbody>
            @foreach($work__logs as $workLog)
            <tr>
                <td>{{ $workLog->log_id }}</td>
                <td>{{ $workLog->Users}}  </td>
                <td>{{ $workLog->name }}</td>
                <td>{{ $workLog->Day_work }}</td>
                <td>{{ $workLog->start_time }}</td>
                <td> {{ $workLog->end_time }} </td>
                <th colspan= 2>
                    <div id="map{{ $workLog->log_id }}" style="height: 150px; width: 150px; "></div>
                    <script>
                        var map{{ $workLog->log_id }} = L.map('map{{ $workLog->log_id }}').setView([{{ $workLog->latitude1 }}, {{ $workLog->longitude1 }}], 50);

                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map{{ $workLog->log_id }});

                        var markerIn{{ $workLog->log_id }} = L.marker([{{ $workLog->latitude }}, {{ $workLog->longitude }}]).addTo(map{{ $workLog->log_id }}).bindPopup('ตำแหน่งเข้างาน');

                        var markerOut{{ $workLog->log_id }} = L.marker([{{ $workLog->latitude1 }}, {{ $workLog->longitude1 }}]).addTo(map{{ $workLog->log_id }}).bindPopup('ตำแหน่งออกงาน');

                        // เพิ่มเส้นเชื่อม
                        var polyline{{ $workLog->log_id }} = L.polyline([
                            [{{ $workLog->latitude }}, {{ $workLog->longitude }}],
                            [{{ $workLog->latitude1 }}, {{ $workLog->longitude1 }}]
                        ], { color: 'blue' }).addTo(map{{ $workLog->log_id }});
                    </script></th>
                <td>
                    @php
                    $start = Carbon\Carbon::parse($workLog->start_Time);
                    $end = Carbon\Carbon::parse($workLog->end_time);
                    $diff = $end->diffInMinutes($start);
                    $hours = floor($diff / 60);
                    $minutes = $diff % 60;
                @endphp
                {{ $hours }} ชั่วโมง {{ $minutes }} นาที
            </td>
                </td>
                <th>

                    <form action="{{ route('loginuser.destroy',$workLog->log_id) }}" method="POST">

                        @csrf
                        @method('DELETE')
                        <button onclick="return confirmAction()" type="submit" class="btn btn-danger">Delete</button>

                        <!-- JavaScript -->
                        <script>
                          function confirmAction() {
                            if (confirm("คุณแน่ใจหรือไม่ที่ต้องการทำการนี้?")) {
                              console.log('ผู้ใช้กด "ตกลง"');
                              return true; // ยืนยันการส่งค่าฟอร์ม
                            } else {
                              console.log('ผู้ใช้กด "ยกเลิก"');
                              return false; // ยกเลิกการส่งค่าฟอร์ม
                            }
                          }
                        </script>
                             </form></th>


            </tr>
                   </tr>

            <script>

                function calculateWorkingHours(start_time, end_time) {
                    const startTime = new Date(`1970-01-01T${start_time}`);
                    const endTime = new Date(`1970-01-01T${end_time}`);

                    const timeDifference = endTime - startTime;
                    const hoursWorked = timeDifference / 3600000;

                    const totalWorkHours = (hoursWorked - 1).toFixed(2);
                    return totalWorkHours;
                }

                const workingHoursCells = document.querySelectorAll(".working-hours-cell");

                workingHoursCells.forEach(cell => {
                    const start_time = cell.previousElementSibling.previousElementSibling.textContent;
                    const end_time = cell.previousElementSibling.textContent;
                    const total_work_hours = calculateWorkingHours(start_time, end_time);
                    cell.textContent = `${total_work_hours} hours`;
                });
            </script>

            @endforeach

            <script>
                // Function to calculate working hours and minutes
                function calculateWorkingTime(start_time) {
                    // Convert start_time to Date object
                    const startTime = new Date(`1970-01-01T${start_time}`);

                    // Calculate the difference in milliseconds
                    const timeDifference = Date.now() - startTime;

                    // Convert milliseconds to hours and minutes
                    const hours = Math.floor(timeDifference / 3600000);
                    const minutes = Math.floor((timeDifference % 3600000) / 60000);

                    return { hours, minutes };
                }

                // Get references to the working-time-cell elements
                const workingTimeCells = document.querySelectorAll(".working-time-cell");

                // Loop through each working-time-cell element
                workingTimeCells.forEach(cell => {
                    const start_time = cell.previousElementSibling.textContent;
                    const { hours, minutes } = calculateWorkingTime(start_time);
                    cell.textContent = `${hours} ชั่วโมง ${minutes} นาที`;
                });
            </script>
            <!-- แถวอื่น ๆ ของข้อมูลที่เราต้องการแสดง -->
        </tbody>
    </table>
    {!! $work__logs->links('pagination::bootstrap-5') !!}


</div>

@endsection


