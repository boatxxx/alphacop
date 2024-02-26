@extends('layouts.app')
<style>
    .custom-form-control {
        border-radius: 25px;
        padding: 10px 15px;
    }

    .custom-card {
        width: 50%;
        margin-top: 0;
    }

    .custom-label {
        font-size: 20px;
    }
</style>
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
@extends('layouts.menu')
@section('content')
<div class="container"  align="center,top"  >
    <div class="d-flex justify-content-center align-items-center vh-100  mt-0">
        <div class="card custom-card p-4" style="width:80%;" align="top">
            <form action="{{ route('leave.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="leave_type" class="custom-label">ประเภทการลา</label>
                    <select id="leave_type" name="leave_type" class="form-control custom-form-control" required>
                        <option value="ลาป่วย">ลาป่วย</option>
                        <option value="ลาพักร้อน">ลาพักร้อน</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="leave_days" class="custom-label">จำนวนวันลา</label>
                    <input type="number" id="leave_days" name="leave_days" class="form-control custom-form-control" required>
                </div>
                <div class="form-group">
                    <label for="reason" class="custom-label">เหตุผล</label>
                    <textarea id="reason" name="reason" class="form-control custom-form-control" rows="4" required></textarea>
                </div>
                <div class="form-group">
                    <label for="request_date" class="custom-label">วันที่ขอลา</label>
                    <input type="date" id="request_date" name="request_date" class="form-control custom-form-control" required>
                </div>
                <div class="form-group">
                    <label for="image" class="custom-label">รูปภาพ</label>
                    <input type="file" id="image" name="image" class="form-control-file custom-form-control" accept="image/*" required>
                </div>
                <button type="submit" class="btn btn-primary">บันทึก</button>
            </form>
        </div>
    </div>



</div>
@endsection
