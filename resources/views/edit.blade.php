<!DOCTYPE html>
@extends('layouts.app')

@extends('layouts.menu')
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    @section('content')

     <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12">
                <h2>แก้ไขข้อมูล </h2>
            </div>
            <div class="div">
                <a href="{{ route('usercom')}}" class ="btn btn-primary">Back</a>
            </div>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <form action="{{ route('users.update', $company->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
                <div class="row">
                    <div class="col-md-12 mt-3">
                        <div class=" mb-3 form-group">
                            <label for="name" class="form-label fs-5">ชื่อยูสเซอร์:</label>
                            <input type="text" name="name" value="{{ $company->name }}" class="form-control" placeholder="Company Name">
                            @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                        </div>

                        <div class="col-md-12">
                            <div class="form-group mt-3">
                                <label for="name" class="form-label fs-5">อีเมล Email:</label>
                                <input type="Email" name="email" value="{{ $company->email }}"  class="form-control" placeholder="Company Name">
                                @error('Email')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                            </div>
                            <div class="col-md-12">
                                <div class="form-group mt-3">
                                       <strong>รหัสผ่าน</strong>
                                       <input type="text" name="password" value="{{ $company->password }}"  class="form-control" placeholder="Company Name">
                                       @error('password')
                                       <div class="alert alert-danger">{{ $message }}</div>
                                       @enderror

                                   </div>
                                   <div class="col-md-12">
                                    <div class="form-group mt-3">
                                        <div class="form-group mt-3">
                                            <label for="is_admin">ระดับแอดมิน</label>
                                            <select id="is_admin" name="is_admin" class="form-control">
                                                <option value="1" {{ $company->is_admin == 1 ? 'selected' : '' }}>รายเดือน</option>
                                                <option value="0" {{ $company->is_admin == 0 ? 'selected' : '' }}>รายวัน</option>
                                            </select>
                                        </div>
                                              <script>
                                                document.querySelectorAll('.income-select1').forEach(select => {
                                                  select.addEventListener('change', function() {
                                                    const companyId = this.getAttribute('data-company-id');
                                                    const selectedValue = this.value;

                                                    // You can perform AJAX request to update the value on the server.
                                                    // Example using fetch API:
                                                    fetch(`/update-income/${companyId}`, {
                                                      method: 'POST',
                                                      headers: {
                                                        'Content-Type': 'application/json',
                                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                                      },
                                                      body: JSON.stringify({ income: selectedValue })
                                                    })
                                                    .then(response => response.json())
                                                    .then(data => {
                                                      // Handle the response if needed.
                                                    });
                                                  });
                                                });
                                                </script>
                                        </form>

                                        </div>
                                       </div>
                        <div class="col-md-12">
                             <div class="form-group mt-3">
                                    <strong>ตำแหน่ง</strong>
                                    <input type="text" name="position" value="{{ $company->position }}"  class="form-control" placeholder="Company Name">
                                    @error('address')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mt-3">
                                           <strong>สาขา</strong>
                                           <input type="text" name="branch" value="{{ $company->branch }}"  class="form-control" placeholder="Company Name">
                                           @error('address')
                                           <div class="alert alert-danger">{{ $message }}</div>
                                           @enderror

                                       </div>
                                       <div class="col-md-12">
                                        <div class="form-group mt-3">
                                               <strong>รหัสพนักงาน</strong>
                                               <input type="text" name="id_name" value="{{ $company->id_name }}"  class="form-control" placeholder="Company Name">
                                               @error('address')
                                               <div class="alert alert-danger">{{ $message }}</div>
                                               @enderror

                                           </div>
                                           <div class="form-group mt-3">
                                            <strong>จำนวนวันลา</strong>
                                            <input type="text" name="donkey_Day" value="{{ $company->donkey_Day }}"  class="form-control" placeholder="Company Name">
                                            @error('address')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror

                                        </div>
                                        <div class="form-group mt-3">
                                            <strong>จำนวนวันพักร้อน</strong>
                                            <input type="text" name="vacation_Day" value="{{ $company->vacation_Day }}"  class="form-control" placeholder="Company Name">
                                            @error('address')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror

                                        </div>
                                        <label for="img_user">Profile</label>
                                        <img src="{{ $company->img_user }}" alt="Company Profile Image"  class="responsive-image">>
                                        <input type="file" id="img_user" name="img_user">
                                        <div class="form-group mt-3">

                                            <div class="form-group mt-3">
                                                <label for="income">ประเภทรายได้</label>
                                                <select id="income" name="income" class="form-control">
                                                    <option value="1" {{ $company->income == 1 ? 'selected' : '' }}>รายเดือน</option>
                                                    <option value="0" {{ $company->income == 0 ? 'selected' : '' }}>รายวัน</option>
                                                </select>
                                            </div>
                                                  <script>
                                                    document.querySelectorAll('.income-select').forEach(select => {
                                                      select.addEventListener('change', function() {
                                                        const companyId = this.getAttribute('data-company-id');
                                                        const selectedValue = this.value;

                                                        // You can perform AJAX request to update the value on the server.
                                                        // Example using fetch API:
                                                        fetch(`/update-income/${companyId}`, {
                                                          method: 'POST',
                                                          headers: {
                                                            'Content-Type': 'application/json',
                                                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                                          },
                                                          body: JSON.stringify({ income: selectedValue })
                                                        })
                                                        .then(response => response.json())
                                                        .then(data => {
                                                          // Handle the response if needed.
                                                        });
                                                      });
                                                    });
                                                    </script>
                                            </form>
                                        </div>
                    </div>
                    <button type="submit" class="mt-3 btn btn-primary">Sumbmit</button>
                </div>
            </form>
        </div>
     </div>
     @endsection
</body>
</html>
