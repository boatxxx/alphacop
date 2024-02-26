<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-yVl01tWMKb5vu8MyfxECo3WaZ1ghKta2HjpP3V9dXDKIIoPl5w34oAly5NVNjqU" crossorigin="anonymous">
<title>Add User</title>
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

    </style>
@section('content')
<div class="container mt-5">
    <h1 class="display-4">เพิ่มผู้ใช้งานระบบ</h1>
    <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
        @csrf
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="mb-3">
            <label for="name" class="form-label fs-5">ชื่อยูเซอร์:</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">อีเมล Email:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">รหัสผ่าน:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="is_admin" name="is_admin">
            <label class="form-check-label" for="is_admin">ระดับแอดมิ้น</label>
        </div>

        <!-- รายการอื่น ๆ ที่คุณต้องการปรับแต่ง  -->

        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-GLhlTQ8iKl17I9q6HsipYFf25M6pfMz+FX5fH8hddEcEL5PUnj6p1QYKdbjQ8rVo" crossorigin="anonymous"></script>


@endsection
