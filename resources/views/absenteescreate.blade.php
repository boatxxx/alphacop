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

@extends('layouts.menu')
@section('content')
<div class="container"  align="center,top"  >
    <div class="d-flex justify-content-center align-items-center vh-100  mt-0">
        <div class="card custom-card p-4" style="width:80%;" align="top">
            <form action="{{ route('absenteeup') }}" method="POST" enctype="multipart/form-data">
                @csrf


                <div class="form-group">
                    <label for="leave_days" class="custom-label">ผู้ขาดงาน</label>
                    <input type="number" id="leave_days" name="leave_days" class="form-control custom-form-control" required>
                </div>
                <div class="form-group">
                    <label for="request_date" class="custom-label">วันที่ขาด</label>
                    <input type="date" id="request_date" name="request_date" class="form-control custom-form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">บันทึก</button>
            </form>
        </div>
    </div>



</div>
@endsection
