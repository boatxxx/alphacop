<!DOCTYPE html>
<html lang="en">
    @extends('layouts.app')

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
        function startScanning() {
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
                fetch('/scan', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    },
                    body: JSON.stringify({
                        code: code
                    })
                })
                .then(response => response.json())
                .then(data => {
                    console.log('API Response:', data);

                    if (data.link) {
                        window.location.href = data.link;
                    } else {
                        alert('QR Code not found');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
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
        }
    </script>
@endsection

</body>

</html>
