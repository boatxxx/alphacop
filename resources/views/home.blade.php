

@extends('layouts.app')

<style>
    /* ใช้คลาสของบาร์เพื่อซ่อน */
    .dashboard-nav {
        display: none;
    }

    /* หรือใช้ไอดีของบาร์เพื่อซ่อน */
    #sidebar {
        visibility: hidden;
    }
    </style>
@extends('layouts.menu')
{{-- resources/views/home.blade.php --}}


@section('content')
<div class="container">
    <h1>ตารางเข้างานและออกงาน</h1>
    <script>
        if ("geolocation" in navigator) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var latitude = position.coords.latitude;
                var longitude = position.coords.longitude;

                // ส่งข้อมูลไปยังเซิร์ฟเวอร์ที่คุณกำหนด
                fetch('/home', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ latitude: latitude, longitude: longitude })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log('Location updated successfully.');
                    } else {
                        console.error('Failed to update location:', data.message);
                    }
                })
                .catch(error => {
                });
            });
        } else {
            console.log("Geolocation is not supported by this browser.");
        }
    </script>
    {{-- ปุ่มล็อกอินใหญ่ๆ และปุ่มล็อกเอ้า --}}
    @auth
    <!-- ปุ่มสำหรับยื่นใบลา -->
    <div class="text-center mb-3">
 <form method="POST" action="{{ route('logout01') }}">
 <div><div class="dashboard-nav">
    <label for="latitude">Latitude:</label>
    <input type="text" id="latitude" name="latitude" readonly>

    <label for="longitude">Longitude:</label>
    <input type="text" id="longitude" name="longitude" readonly>

    <button type="button" onclick="getCurrentLocation()">Get Location</button></div>
    <script src="https://cdn.jsdelivr.net/npm/quagga"></script>

    <script>

        // เรียกใช้ฟังก์ชัน getCurrentLocation ทันที
        getCurrentLocation();

        // ตั้งเวลาเรียก getCurrentLocation ทุก 1 วินาที
        setTimeout(function() {
            getCurrentLocation();
            // ตั้งเวลาเรียก getCurrentLocation ทุก 5 นาที
            setInterval(function() {
                getCurrentLocation();
            }, 5 * 60 * 1000); // 5 นาทีในหน่วยมิลลิวินาที

            // ตั้งเวลาเรียก getCurrentLocation ทุก 10 นาที
            setInterval(function() {
                getCurrentLocation();
            }, 10 * 60 * 1000); // 10 นาทีในหน่วยมิลลิวินาที
        }, 1000); // 1 วินาทีในหน่วยมิลลิวินาที

            function getCurrentLocation() {
            if ("geolocation" in navigator) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var latitude = position.coords.latitude;
                    var longitude = position.coords.longitude;

                    // แสดงค่าใน input fields
                    document.getElementById("latitude").value = latitude;
                    document.getElementById("longitude").value = longitude;

                    // (Optional) ส่งข้อมูลไปยังเซิร์ฟเวอร์ที่คุณกำหนด
                    sendLocationToServer(latitude, longitude);
                });
            } else {
                console.log("Geolocation is not supported by this browser.");
            }
        }

        function sendLocationToServer(latitude, longitude) {
            fetch('/home', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ latitude: latitude, longitude: longitude })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log('Location updated successfully.');
                } else {
                    console.error('Failed to update location:', data.message);
                }
            })
            .catch(error => {
            });
        }

            </script>
</div>
<a  href="{{ route('businesscreate') }}" class="btn btn-success btn-lg fas fa-file-upload">ยื่นใบลา</a>
<br>
<!-- ปุ่มสำหรับดูใบลา -->
<a href="{{ route('businessuser') }}" class="btn btn-success btn-lg fas fa-money-check-alt">ดูใบลา</a><br>
<a href="{{ route('QRcode') }}" class="btn btn-success btn-lg "><i class="fas fa-user"></i>สแกนจุด</a>

<br>
</div>
        <div class="text-center mb-3">

            <a href="{{ route('logout01') }}" id="logoutLink" href="#" class="btn btn-danger btn-lg" onclick="getCurrentLocationAndLogout()">Logout</a>
            <script>
                function getCurrentLocationAndLogout() {
                    if ("geolocation" in navigator) {
                        navigator.geolocation.getCurrentPosition(function(position) {
                            var latitude = position.coords.latitude;
                            var longitude = position.coords.longitude;

                            // เพิ่มค่าลงในลิงก์ 'Logout'
                            var logoutLink = document.getElementById('logoutLink');
                            logoutLink.href = "{{ route('logout01') }}" + "?latitude=" + latitude + "&longitude=" + longitude;

                            // ส่งคำขอ logout โดยใช้ลิงก์ 'Logout'
                            logoutLink.click();
                        });
                    } else {
                        console.log("Geolocation is not supported by this browser.");
                    }
                }
            </script>

            <!-- ลิงก์ 'Logout' ที่ถูกสร้างโดย JavaScript -->


        </div>
    @else



        <div class="text-center mb-3">
            <a href="{{ route('login') }}" class="btn btn-primary btn-lg">Login</a>
        </div>
    @endauth

    <table class="table">
        <thead>
            <tr>
                <th>หรัสเข้างาน</th>
                <th>วันที่ทำงาน</th>
                <th>ชื่อคนทำงาน</th>
                <th>เข้างาน</th>
                <th>ออกงาน</th>
            </tr>
        </thead>
        <tbody>

            @foreach($work__logs as $workLog)
            <tr>
                <td>{{ $workLog->log_id }}</td>
                <td>{{ $workLog->Day_work }}</td>
                <td>{{ $workLog->Users }}</td>
                <td>{{ $workLog->start_time }}</td>
                <td>{{ $workLog->end_time }}</td>
            </tr>
   @endforeach
        </tbody>
    </table>
    {{ $work__logs->links() }} {{-- แสดงลิงก์ pagination --}}

</div>
@endsection
