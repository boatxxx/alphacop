@extends('layouts.app')

<style>
    body {
        font-size: 16px;
    }
    .container {
        margin-top: 50px;
    }
</style>
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
@extends('layouts.menu')
@section('content')
<div class="container"  align="center" >
    <form action="{{ route('searchabsentee') }}" method="GET" class="search-form" id="search-form">
        <div class="search-group">
            <label for="employee-select">เลือกพนักงาน :</label>
            <select name="selected_employee_id" id="employee-select" class="search-input">
                <option value="">-- เลือกพนักงาน --</option>
                @foreach($absentees1 as $absentee)
                    <option value="{{ $absentee->user_id }}">{{ $absentee->user->name }}</option>
                @endforeach
            </select>
        </div>
        <input type="text" name="keyword1" placeholder="คำค้นหา" class="search-input" id="selected_employee_id_input1">
        <input type="hidden" name="page" value="{{ $absentees->currentPage() }}"> <!-- เพิ่ม input hidden เก็บข้อมูลหน้าที่กำลังแสดงอยู่ -->
        <button type="submit" class="search-button">ค้นหา</button>
    </form>

    <script>
        document.getElementById('employee-select').addEventListener('change', function() {
            const selectedEmployeeId = this.value;
            document.getElementById('selected_employee_id_input1').value = selectedEmployeeId;
            document.getElementById('search-form').submit();
        });
    </script>
    <div class="container">
        <h1 class="mb-4">รายชื่อผู้ที่ขาดงาน</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">ลำดับ</th>
                    <th scope="col">รหัสผู้ขาดงาน</th>
                    <th scope="col">ชื่อ</th>
                    <th scope="col">วันที่ขาดงาน</th>
                </tr>
            </thead>
            <tbody>
                @foreach($absentees as $key => $absentee)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $absentee->id }}</td>
                    <td>{{ $absentee->user_id }}</td>
                    <td>{{ $absentee->user->name }}</td>
                    <td>{{ $absentee->absent_date }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>
@endsection
