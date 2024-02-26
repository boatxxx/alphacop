@extends('layouts.app')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

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

     </style>
@extends('layouts.menu')
@section('content')
@if(session('success'))
    <div class="alert alert-success" align="center">{{ session('success') }}</div>
@endif
<div class="container"  align="center" >
    <h2>รายการอนุมัติการลา</h2>
    <a class="add-button" href="{{ route('businesscreate') }}">
    <i class="fas fa-plus"></i> เพิ่มข้อมูลการลา
</a>
    <table>
        <tr>
            <th>ลำดับ</th>
            <th>ประเภท</th>
            <th>วันลา</th>
            <th>จำนวน</th>
            <th>เหตุผล</th>
            <th>วันที่ขอ</th>
            <th>คลิก</th>
            <th>อนุมัติโดย</th>
            <th>สถานะ</th>
            <th>จัดการ</th>
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
        <td>  <form action="{{ route('leave.approve', $donkey->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success">อนุมัติ</button>
                            </form>
                            <form action="{{ route('leave.approve1', $donkey->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger reject-button">ปฏิเสธ</button>
                            </form></td>

        <td>{{ $donkey->approved_by_name }}</td>
        <td>{{ $donkey->status }}</td>

        <td>
            <a href="{{ route('business.edit', $donkey->id) }}" class="btn btn-success">แก้ไข</a>
<form action="{{ route('business.destroy', $donkey->id) }}" method="POST">

    @csrf
    @method('DELETE')
    <button onclick="return confirmAction()" type="submit" class="btn btn-danger">Delete</button>
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
</form>
        </td>
        <td> <!-- ใส่เฉพาะแถวที่มีข้อมูลเอกสาร -->
            @foreach($leave_documents as $donkey1)
                @if($donkey1->leave_request_id == $donkey->id)
                    {{ $donkey1->file_path }}<br>
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
