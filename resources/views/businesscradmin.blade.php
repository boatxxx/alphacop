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
            <div class="search-group">

            </div>
            <form action="{{ route('leave.store1') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <label for="company-select">เลือกพนักงาน :</label>
                <select name="selected_company_id" id="company-select" class="search-input">
                    <option value="">-- เลือกพนักงาน --</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
                <script>
                    document.getElementById('company-select').addEventListener('change', function() {
                        const selectedCompanyId = this.value;
                        document.getElementById('selected_company_id_input').value = selectedCompanyId;
                        document.getElementById('search-form').submit();
                    });
                </script>
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
