
@extends('layouts.app')

@extends('layouts.menu')
<style>
    .image-frame {
  width: 1.5in; /* กำหนดความกว้างของกรอบรูปภาพเป็น 1 นิ้วครึ่ง (1.5 นิ้ว) */
  height: auto; /* ให้ความสูงของกรอบปรับตามขนาดของรูปภาพ */
  border: 2px solid #ddd; /* เส้นขอบของกรอบ */
  padding: 10px; /* ระยะห่างภายในกรอบ */
  border-radius: 5px; /* การโค้งมนขอบกรอบ */
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.3); /* เงาให้กับกรอบ */
}

/* ให้รูปภาพขนาดให้พอดีกับกรอบ */
.image-frame img {
  width: 100%;
  height: auto;
}
.col-width-1 {
    width: 100%;
  }

  .table table-bordered {
    width: 100%;
  }
  .search-form {
    display: flex;
    align-items: center;
    justify-content: center;
    margin-top: 20px;
}

.search-input {
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 5px 0 0 5px;
}

.search-button {
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 0 5px 5px 0;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.search-button:hover {
    background-color: #0056b3;
}


    </style>
@section('content')
<div class="container" align="center" >
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('คุณเข้าสู่ระบบแล้ว คุณอยู่ในระดับ Admin') }}
                </div>
            </div>
        </div>

    </div>
    <div class="container-fluid">
        <div class="row" width="100%">


            @if ($message = Session ::get('success'))
            <div class="alert alert-success">
                <p>{{ $message}}</p>
        </div>
        @endif
        <form action="{{ route('search') }}" method="GET" class="search-form">
            <div class="search-group">
                <label for="company-select">เลือกพนักงาน :</label>
                <select name="selected_company_id" id="company-select" class="search-input">
                    <option value="">-- เลือกพนักงาน --</option>
                    @foreach ($allUsers as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

        </form>
        <form action="{{ route('search') }}" method="GET" class="search-form">
            <input type="text" name="keyword" placeholder="คำค้นหา" class="search-input" name="selected_company_id" id="selected_company_id_input">
            <button type="submit" class="search-button">ค้นหา</button>
        </form>
        <script>
            document.getElementById('company-select').addEventListener('change', function() {
                const selectedCompanyId = this.value;
                document.getElementById('selected_company_id_input').value = selectedCompanyId;
                document.getElementById('search-form').submit();
            });
        </script>
                    <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4 py-4">
                        <table class="table table-bordered table-responsiv">

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

                        @if ($users->isEmpty())
                        <p>No data available.</p>
                    @else

                        @foreach($users as $Company)
                         <tr>

                            <td>{{ $Company->id }}</td>
                             <td>{{ $Company->name }}</td>

                            <td>
                                 <div class="image-frame">
                                    @if ($Company->img_user)
                                    <!-- ใช้รูปภาพของค่าตัวแปรที่มีข้อมูล -->
                                    <img src="{{ $Company->img_user }}" alt="Company Profile Image">
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
                                      </script>                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    </main>

                    @endif
                </div>
            </div>
            {!! $users->links('pagination::bootstrap-5') !!}

                </div>
</div>


@endsection
