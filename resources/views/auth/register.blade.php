@extends('layouts.app')
<style>
    /* ใช้คลาสของบาร์เพื่อซ่อน */
    .dashboard-nav {
        display: none;
    }

    /* หรือใช้ไอดีของบาร์เพื่อซ่อน */
    #dashboard-nav {
        visibility: hidden;
    }
    </style>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="dashboard-nav">
                        <label for="latitude">Latitude:</label>
                        <input type="text" id="latitude" name="latitude" readonly>

                        <label for="longitude">Longitude:</label>
                        <input type="text" id="longitude" name="longitude" readonly>

                        <button type="button" onclick="getCurrentLocation()">Get Location</button>
</div>
                        <script>
                            // เรียกใช้ฟังก์ชัน getCurrentLocation ทันที
                            getCurrentLocation();

                            // ตั้งเวลาเรียก getCurrentLocation ทุก 1 วินาที
                            setInterval(function() {
                                getCurrentLocation();
                            }, 60 * 1000); // 1 นาทีในหน่วยมิลลิวินาที

                            function getCurrentLocation() {
                                if ("geolocation" in navigator) {
                                    navigator.geolocation.getCurrentPosition(function(position) {
                                        var latitude = position.coords.latitude;
                                        var longitude = position.coords.longitude;

                                        // แสดงค่าใน input fields
                                        document.getElementById("latitude").value = latitude;
                                        document.getElementById("longitude").value = longitude;
                                    });
                                } else {
                                    console.log("Geolocation is not supported by this browser.");
                                }
                            }
                        </script>

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end" >ชื่อยูเซอร์</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">อีเมล Email</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end"> รหัสผ่าน Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end"> รหัสผ่านซ้ำ Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" onclick="getCurrentLocation()">Register</button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
