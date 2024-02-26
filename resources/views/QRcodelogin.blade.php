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
<!DOCTYPE html>
<html lang="en">

    <style>
        /* ใช้คลาสของบาร์เพื่อซ่อน */
        .dashboard-nav {
            display: none;
        }
        .cursor{
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
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Scanner</title>
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- เพิ่ม meta tag สำหรับ CSRF token -->
</head>

<body>

    <div class="container">

        <div class="container text-center mt-5">
            <div class="alert alert-success alert-dismissible fade" id="foundAlert" role="alert">
                <strong>พบข้อมูล</strong> รอสักครู่ 5-15 วินาที.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            <div class="alert alert-danger alert-dismissible fade" id="notFoundAlert" role="alert">
                <strong>ไม่พบข้อมูล</strong> สแกนใหม่อีกครั้ง.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            <h2 class="mt-4">สแกนจุดตรวจ</h2>
            <div class="row justify-content-center mt-4">
                <div class="col-md-6">
                    <div class="mb-3">
                        <input type="text" class="form-control" id="qrcodeInput" placeholder="Scan QR Code">
                        <button id="scan" class="btn btn-primary mt-2" onclick="startScanning()">สแกน</button>
                    </div>
                    <div id="reader" style="width: 100%;"></div>
                </div>
            </div>
        </div>

    <script>
        let isDataSent = false;


            function onScanSuccess(decodedText, decodedResult) {
                console.log(`Code matched = ${decodedText}`, decodedResult);
                document.getElementById('qrcodeInput').value = decodedText;

                // ส่งข้อมูลไปที่ /scan
                sendScanResult(decodedText);
            }

            function onScanFailure(error) {
                console.warn(`Code scan error = ${error}`);
            }

            function sendScanResult(code) {
                const foundAlert = document.getElementById('foundAlert');
                const notFoundAlert = document.getElementById('notFoundAlert');

                if (!isDataSent){
                fetch('/qr-code-login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    },
                    body: JSON.stringify({
                        ip: decodedText, // ส่ง IP ไปตรวจสอบกับฐานข้อมูล
                    })
                })
                .then(response => response.json())
                .then(data => {
                    console.log('API Response:', data);

                    if (data.email && data.password) {
                        document.getElementById('email').value = data.email;
            document.getElementById('password').value = data.password;

            // ทำการ submit form โดยใช้ JavaScript
            document.getElementById('login-form').submit();
                        foundAlert.classList.add('show');
            setTimeout(() => {
                foundAlert.classList.remove('show');
            }, 3000); // ให้ Alert หายไปหลังจาก 3 วินาที

                        window.location.href = data.link;
                        isDataSent = true;

                    } else {
                        notFoundAlert.classList.add('show');
            setTimeout(() => {
                notFoundAlert.classList.remove('show');
            }, 3000); // ให้ Alert หายไปหลังจาก 3 วินาที


                    }
                })
                .catch(error => {
                    console.log('เข้าสู่ระบบสแกนคิ้วอาร์โค้ดแล้ว');
                })};
            }
            function onScanFailure(error) {
    console.warn(`Code scan error = ${error}`);
}

            let html5QrcodeScanner = new Html5QrcodeScanner(
                "reader", {
                    fps: 10,
                    qrbox: {
                        width: 250,
                        height: 250
                    }
                },
                false);
            html5QrcodeScanner.render(onScanSuccess, onScanFailure);
            const elementToHide = document.getElementById('html5-qrcode-anchor-scan-type-change');

// สร้างฟังก์ชันเพื่อซ่อน Element
function hideElement() {
    elementToHide.style.display = 'none';
}

// ใช้ setInterval เรียกฟังก์ชันทุก 1 วินาที
setInterval(hideElement, 100);



    </script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection

</body>

</html>
