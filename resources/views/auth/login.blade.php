@extends('layouts.app')
<style>
    /* ใช้คลาสของบาร์เพื่อซ่อน */
    .dashboard-nav {
        display: none;
    }

    /* หรือใช้ไอดีของบาร์เพื่อซ่อน */
    .dashboard-nav {
        visibility: hidden;
    }
    .col-md-8 {
        position: absolute;
        top: 190px;

    }
</style>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center" style="font-size: 24px; background-color: #007bff; color: white; border-bottom: none;">
                    {{ __('Login') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        @if ($message = Session::get('error'))
                        <!-- โค้ดแสดงข้อผิดพลาด ถ้ามี -->
                        @endif

                        <div class="bg-white p-5 rounded-5 shadow mt-0">
                            <!-- ส่วนของฟอร์มล็อกอิน -->
                            <div class="text-center"><i class="fa-regular fa-circle-user fa-5x"></i></div>
                            <div class="text-center fs-2 fw-bold">ลงชื่อเข้าใช้</div>
<div class="dashboard-nav">

                                <label for="latitude">Latitude:</label>
                                <input type="text" id="latitude" name="latitude" readonly>

                                <label for="longitude">Longitude:</label>
                                <input type="text" id="longitude" name="longitude" readonly>

                                <button type="button" onclick="getCurrentLocation()">Get Location</button></div>


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
                            <!-- ฟิลด์อีเมล -->
                            <div class="input-group mt-4">
                                <div class="input-group-text bg-info"><i class="fa-solid fa-user"></i></div>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ auth()->check() ? auth()->user()->email : old('email') }}" required autocomplete="email" autofocus placeholder="อีเมล">
                                @error('email')
                                <!-- โค้ดแสดงข้อผิดพลาด ถ้ามี -->
                                @enderror
                            </div>

                            <!-- ฟิลด์รหัสผ่าน -->
                            <div class="input-group mt-2">
                                <div class="input-group-text bg-info"><i class="fa-solid fa-lock"></i></div>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="รหัสผ่าน">
                                @error('password')
                                <!-- โค้ดแสดงข้อผิดพลาด ถ้ามี -->
                                @enderror
                            </div>

                            <!-- Checkbox จดจำฉัน -->
                            <div>
                                <input type="checkbox" name="remember" id="remember">
                                <label for="remember">จดจำฉัน</label>
                            </div>

                            <!-- ปุ่มเข้าสู่ระบบ -->
                            <button type="submit" class="btn btn-primary btn-info text-white w-100 mt-4">
                                {{ __('Login') }}
                            </button>
<!-- resources/views/welcome.blade.php -->

<div id="app">
    <example-component></example-component>

<template>
    <div>
        <web-cam ref="webCam" @camera-start="cameraStart" @camera-stop="cameraStop" />
        <button @click="scanQRCode">Scan QR Code</button>
    </div>
</template>
</div>




                            <!-- ลิงก์ Forgot Password -->
                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>
</div>

@endsection
