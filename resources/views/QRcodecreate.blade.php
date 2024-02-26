<!DOCTYPE html>
<html lang="en">
    @extends('layouts.app')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>Add QR Code Data</title>
    <style>
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
        }
    </style>
</head>
<body>
    @section('content')

    <div class="container">
        <h1 class="mb-4">Add QR Code Data</h1>

        <form action="{{route('QrCodecreatex')}}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="code" class="form-label">QR Code:</label>
                <input type="text" id="code" name="code" class="form-control" placeholder="Enter QR Code">
            </div>

            <div class="mb-3">
                <label for="link" class="form-label">Link:</label>
                <input type="text" id="link" name="link" class="form-control" placeholder="Enter Link">
            </div>

            <button type="submit" class="btn btn-primary">Add Data</button>
        </form>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    @endsection

</body>
</html>
