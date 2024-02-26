@vite(['resources/sass/app.scss', 'resources/js/app.js'])
<style>
    .sidebar {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        z-index: 100;
        padding: 90px 0 0;
        box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
        z-index: 99;
    }

    @media (max-width: 767.98px) {
        .sidebar {
            top: 11.5rem;
            padding: 0;
        }
    }
    #last7DaysChart {
            margin-bottom: 10px; /* ระยะห่างระหว่าง Canvas กับด้านล่างของหน้าเว็บ */
        }
    .navbar {
        box-shadow: inset 0 -1px 0 rgba(0, 0, 0, .1);
    }

    @media (min-width: 767.98px) {
        .navbar {
            top: 0;
            position: sticky;
            z-index: 999;
        }
    }

    .sidebar .nav-link {
        color: #333;
    }

    .sidebar .nav-link.active {
        color: #0d6efd;
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">


    </div>
    <div class="container-fluid">
        <div class="row">

                    <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4 py-4">
                        <nav aria-label="breadcrumb">

                        </nav>
                        <h1 class="h2">Dashboard</h1>
                        <p>หน้าแรกของส่วนต่อประสานผู้ดูแลระบบ</p>
                        <div class="row my-4">
                            <div class="col-12 col-md-6 col-lg-3 mb-4 mb-lg-0">
                                <div class="card">
                                    <h5 class="card-header">พนักงาน</h5>
                                    <div class="card-body">
                                      <h5 class="card-title">{{ $userCount }} คน</h5>
                                      <p class="card-text"></p>
                                      <p class="card-text text-success"></p>
                                    </div>
                                  </div>
                            </div>
                            <div class="col-12 col-md-6 mb-4 mb-lg-0 col-lg-3">
                                <div class="card">
                                    <h5 class="card-header">ลงเวลา</h5>
                                    <div class="card-body">
                                      <h5 class="card-title">{{ $userCount1 }} ครั้ง</h5>
                                      <p class="card-text"></p>
                                      <p class="card-text text-success"></p>
                                    </div>
                                  </div>
                            </div>
                            <div class="col-12 col-md-6 mb-4 mb-lg-0 col-lg-3">
                                <div class="card">
                                    <h5 class="card-header">การลา</h5>
                                    <div class="card-body">
                                      <h5 class="card-title">{{ $userCount2 }} ครั้ง</h5>
                                      <p class="card-text"></p>
                                      <p class="card-text text-danger"></p>
                                    </div>
                                  </div>
                            </div>
                            <div class="col-12 col-md-6 mb-4 mb-lg-0 col-lg-3">
                                <div class="card">
                                    <h5 class="card-header">การขาดงาน</h5>
                                    <div class="card-body">
                                      <h5 class="card-title">{{ $userCount3 }} ครั้ง</h5>
                                      <p class="card-text"></p>
                                      <p class="card-text text-success"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="container"  align="center" >
                            <div class="row">
                                <div class="col-12 col-xl-4">
                                    <div class="card">
                                    <h5 class="card-header">ภาพรวมการทำงาน
                                    <div class="card-body">
                                    <div id="traffic-chart"><!-- View File -->
                                        <canvas id="myPieChart" width="400" height="1000"></canvas>

                                        <script src="{{ asset('js/Chart.min.js') }}"></script>
                                        <script>
                                            // สร้าง Canvas Element
                                            var ctx = document.getElementById('myPieChart').getContext('2d');

                                            // สร้างข้อมูลสำหรับกราฟวงกลม
                                            var data = {
                                                labels: ['เข้างาน', 'ลา', 'ขาด'],
                                                datasets: [{
                                                    data: [{{ $userCount1 }}, {{ $userCount2 }},{{ $userCount3 }}],
                                                    backgroundColor: ['red', 'blue', 'yellow']
                                                }]
                                            };

                                            // กำหนดตัวเลือกของกราฟ
                                            var options = {
                                                // ตั้งค่าต่างๆ ตามที่ต้องการ เช่น legend, title, etc.
                                            };

                                            // สร้างกราฟวงกลม
                                            var myPieChart = new Chart(ctx, {
                                                type: 'pie',
                                                data: data,
                                                options: options
                                            });
                                        </script>
                                        </div>
                                    </div>
                                    </div>
                                    </div>
                                    <div class="col-12 col-xl-4">
                                        <div class="card">
                                            <h5 class="card-header">ภาพรวมทำงาน จันทร์-อาทิตย์</h5>
                                            <div class="card-body">
                                                <div id="traffic-chart">
                                                    <!-- ใช้ Canvas สำหรับกราฟเส้น -->
                                                    <canvas id="myLineChart" width="200" height="200"></canvas>
                                                </div>
                                                <script src="{{ asset('js/Chart.min.js') }}"></script>
                                                <script>
                                                    var ctx = document.getElementById('myLineChart').getContext('2d');

                                                    var data = {
                                                        labels: ['วันจันทร์', 'วันอังคาร', 'วันพุธ', 'วันพฤหัส', 'วันศุกร์', 'วันเสาร์', 'วันอาทิตย์'],
                                                        datasets: [{
                                                            label: 'Performance',
                                                            data: [{{  $dayCounts->Monday }}, {{  $dayCounts->Tuesday  }}, {{  $dayCounts->Wednesday  }}, {{  $dayCounts->Thursday  }},{{  $dayCounts->Friday  }},{{  $dayCounts->Saturday  }}, {{  $dayCounts->Sunday  }}], // ข้อมูลตัวอย่าง (สามารถเปลี่ยนแปลงได้ตามที่ต้องการ)
                                                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                                            borderColor: 'rgba(75, 192, 192, 1)',
                                                            borderWidth: 1
                                                        }]
                                                    };

                                                    var options = {
                                                        // ตั้งค่าต่าง ๆ ตามที่ต้องการ
                                                    };

                                                    var myLineChart = new Chart(ctx, {
                                                        type: 'line',
                                                        data: data,
                                                        options: options
                                                    });
                                                </script>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xl-4">
                                        <div class="card">
                                            <h5 class="card-header">สถิติการเข้าใช้งานเว็บ</h5>
                                            <div class="card-body">
                                                <div id="traffic-chart">
                                                    <!-- ใช้ Canvas สำหรับกราฟแท่ง -->
                                                    <canvas id="myBarChart" width="200" height="200"></canvas>
                                                </div>
                                                <script src="{{ asset('js/Chart.min.js') }}"></script>
                                                <script>
                                                    var ctx = document.getElementById('myBarChart').getContext('2d');

                                                    var data = {
                                                        labels: ['เข้าสู่ระบบ', 'เข้างาน', 'ลา', 'ขาด', '--'], // ตัวอย่างของ labels
                                                        datasets: [{
                                                            label: 'Data',
                                                            data: [{{$webAccessCount}}, {{ $userCount1 }}, {{ $userCount2 }}, {{ $userCount3 }}, 0], // ข้อมูลตัวอย่าง (สามารถเปลี่ยนแปลงได้ตามที่ต้องการ)
                                                            backgroundColor: [
                                                                'rgba(255, 99, 132, 0.2)',
                                                                'rgba(54, 162, 235, 0.2)',
                                                                'rgba(255, 206, 86, 0.2)',
                                                                'rgba(75, 192, 192, 0.2)',
                                                                'rgba(153, 102, 255, 0.2)'
                                                            ],
                                                            borderColor: [
                                                                'rgba(255, 99, 132, 1)',
                                                                'rgba(54, 162, 235, 1)',
                                                                'rgba(255, 206, 86, 1)',
                                                                'rgba(75, 192, 192, 1)',
                                                                'rgba(153, 102, 255, 1)'
                                                            ],
                                                            borderWidth: 1
                                                        }]
                                                    };

                                                    var options = {
                                                        // ตั้งค่าต่าง ๆ ตามที่ต้องการ
                                                    };

                                                    var myBarChart = new Chart(ctx, {
                                                        type: 'bar',
                                                        data: data,
                                                        options: options
                                                    });
                                                </script>
                                            </div>
                                        </div>
                                    </div>

                                        </div>
                                        </div>

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
                                    @foreach($work__logs as $workLog)
                                    <tr>
                                        <td>{{ $workLog->log_id }}</td>
                                        <td>{{ $workLog->Users}}  </td>
                                        <td>{{ $workLog->name }}</td>
                                        <td>{{ $workLog->Day_work }}</td>
                                        <td>{{ $workLog->start_Time }}</td>
                                        <td> {{ $workLog->end_time }} </td>
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
                                    </>

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

</div>

@endsection

