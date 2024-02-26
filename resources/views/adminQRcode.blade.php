<style>
        @extends('layouts.app')

    body {
        background-color: #f8f9fa;
        padding: 20px;
    }

    .container {
        max-width: 400px;
        margin: auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    #qrcode {
        margin-top: 20px;
    }
    body {
            background-color: #f8f9fa;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        th, td {
            padding: 15px;
            text-align: center;
        }

        th {
            background-color: #007bff;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>

    <title>QR Code Generator</title>
    <!-- Include the QR Code library -->
    <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
</head>
<body>
    @section('content')

        <h1 class="mb-4">QR Code Generator</h1>

        <div class="mb-3">
            <label for="text-input" class="form-label">Enter text:</label>
            <input type="text" id="text-input" class="form-control" placeholder="Enter your text">
        </div>

        <button class="btn btn-primary mb-3" onclick="generateQRCode()">Generate QR Code</button>

        <div class="form-control text-center" id="qrcode"></div>
        <div class="container">
            <h1 class="mb-4">QR Codes List</h1>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>QR Code</th>
                        <th>Code</th>
                        <th>Link</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($qrCodes as $qrCode)
                        <tr>
                            <td>{{$qrCode->code}}</td>
                            <td>{{$qrCode->code}}</td>
                            <td>{{ $qrCode->link }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script>
        function generateQRCode() {
            // Get the text input value
            var text = document.getElementById('text-input').value;

            // Create a QR Code instance
            var qrcode = new QRCode(document.getElementById('qrcode'), {
                text: text,
                width: 250,
                height: 250
            });
        }
    </script>
    @endsection

</body>
</html>
