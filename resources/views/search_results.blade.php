<style>
    .image-frame {
    border: 2px solid #ccc;
    padding: 5px;
    display: inline-block;
    margin-right: 10px;
}

.profile-image {
    max-width: 150px; /* ปรับขนาดภาพตามต้องการ */
    max-height: 150px;
}
    </style>


@extends('layouts.app')

@extends('layouts.menu')
{{-- resources/views/home.blade.php --}}


@section('content')
<div class="container"  align="center" >

    <h2>ผลการค้นหา</h2>

    @if($searchResults->isEmpty())
        <p>ไม่พบผลลัพธ์ที่คุณค้นหา</p>
    @else
        <ul>
            @foreach($searchResults as $result)
                <li>{{ $result->id }}</li>
            @endforeach
        </ul>
    @endif
    <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4 py-4" >
        <table class="table table-bordered">

            <th>id.</th>
            <th> ชื่อยูสเซอร์ Name</th>
            <th> รูปโปรไฟล์</th>
            <th> อีเมล Email</th>
            <th> ระดับ</th>
            <th class="col-width-1">ตำแหน่ง</th>
            <th class="col-width-1">สาขา</th>
            <th class="col-width-1">รหัสพนักงาน</th>
            <th class="col-width-1">จำนวนวันลา</th>
            <th class="col-width-1">จำนวนพักร้อน</th>
            <th class="col-width-1">ประเภทพนักงาน </th>
            <th colspan="2"><a href="{{ route('create') }}" class="btn btn-warning">เพิ่มผู้ใช้งาน</a></th>
            <th></th>

    @foreach($searchResults1 as $Company)
    <tr>

        <td>{{ $Company->id }}</td>
         <td>{{ $Company->name }}</td>

        <td>
             <div class="image-frame">
                @if ($Company->img_user)
                <!-- ใช้รูปภาพของค่าตัวแปรที่มีข้อมูล -->
                <img src="{{ $Company->img_user }}" alt="Company Profile Image"class="profile-image">
                @else
                <!-- ใช้รูปภาพเริ่มต้น (fallback image) เมื่อไม่มีข้อมูล -->
                <img src="{{ asset('storage/user.png') }}" alt="Fallback Image" style="max-width: 2in;">
            @endif
          </div></td>

        <td>{{ $Company->email }}</td>
        <td>@if ($Company->is_admin == 1)
            Admin
        @else
            พนักงานทั่วไป
        @endif</td>
        <td>{{ $Company->position }}</td>
        <td>{{ $Company->branch }}</td>
        <td>{{ $Company->id_name }}</td>
        <td>{{ $Company->donkey_Day }}</td>
        <td>{{ $Company->vacation_Day }}</td>
        <td>@if ($Company->income == 1)
            รายเดือน
        @else
            รายวัน
        @endif</td>

    <td>

            <a href="{{ route('edit', $Company->id)}}" class="btn btn-warning">Edit</a>


            <form action="{{ route('users.destroy', $Company->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </td>
    </tr>

</table>
    @endforeach
</div>
@endsection
