@extends('layouts.app')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
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
<style>
        /* Add your custom CSS styles here */
        body {
            font-family: Arial, sans-serif;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .btn {
            padding: 5px 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        .add-button {
    background-color: orange;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease-in-out;
}

.add-button i {
    margin-right: 5px;
}

.alert {
        text-align: center;
    }
     </style>
@extends('layouts.menu')
@section('content')
@if(session('success'))
    <div class="alert alert-success" align="center" >{{ session('success') }}</div>
@endif
<div class="container"  align="center" >
    <h2>รายการลาทั้งหมด</h2>
    <a class="add-button" href="{{ route('businesscreate') }}">
    <i class="fas fa-plus"></i> เพิ่มข้อมูลการลา
    <a class="" href="{{ route('login') }}">
        <i class="fas fa-plus"></i> ยอมกลับหน้าแรก
</a>
    <table>
        <tr>
            <th>ลำดับ</th>
            <th>ผู้ยื่นลา</th>
            <th>ประเภท</th>
            <th>วันลา</th>
            <th>เหตุผล</th>
            <th>วันที่ขอ</th>
            <th>อนุมัติโดย</th>
            <th>สถานะ</th>


            <th>ไฟล์</th>
        </tr>
        @foreach($leave_requests as $donkey)
    <tr>
        <td>{{ $donkey->id }}</td>
        <td>{{ $donkey->user_id }}</td>
        <td>{{ $donkey->leave_type }}</td>
        <td>{{ $donkey->leave_days }}</td>
        <td>{{ $donkey->reason }}</td>
        <td>{{ $donkey->request_date }}</td>
        <td>{{ $donkey->approved_by_name }}</td>
        <td>{{ $donkey->status }}</td>
        <td>

        </td>
        <td> <!-- ใส่เฉพาะแถวที่มีข้อมูลเอกสาร -->
            @foreach($leave_documents as $donkey1)
                @if($donkey1->leave_request_id == $donkey->id)
                    {{ $donkey1->file_name }}<br>
                    <a href="{{ asset($donkey1->file_path) }}" class="btn btn-success" target="_blank">ดูไฟล์</a><br>

                @endif
            @endforeach
        </td>
    </tr>
@endforeach




        </tr>


    {!! $leave_requests->links('pagination::bootstrap-5') !!}

        <!-- เพิ่มข้อมูลตารางอื่น ๆ ที่นี่ -->
    </table>

</div>
@endsection
