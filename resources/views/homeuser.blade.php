

@extends('layouts.app')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<style>




  .left-side {
    background-color: #f0f0f0;
  }

  .right-side {
    background-color: #fafafa;
  }

  .icon {
    font-size: 50px;
    margin-bottom: 20px;
    color: #ff6600;
  }

  img {
    max-width: 100%;
    height: auto;
  }
</style>
@extends('layouts.menu')
{{-- resources/views/home.blade.php --}}


@section('content')
<div class="container">

    <div class="left-side">
        <div class="container">
          <i class="fas fa-user-circle icon"></i>
          <h1>ระบบบริหารทรัพยากรบุคคล (HR System)</h1>
          <p>บันทึกเงินเดือน, เงินได้, เงินหักในสัญญาจ้างด้วย โปรแกรม HR</p>
        </div>
      </div>

      <div class="right-side">
        <div class="container">
          <h1>ส่งลาออนไลน์</h1>
          <p>พร้อมดูสรุปการลาต่างๆ ผ่าน app HR</p>
          <p>เก็บประวัติพนักงานถูกต้อง, แม่นยำด้วยระบบ HR</p>
          <p>ติดต่อเราเพื่อรับสาธิตเดโม่ฟรี</p>
          <p>สามารถติดต่อได้ที่: boatsucro@gmail.com</p>
          <img src="{{ asset('storage/profile_images/io0NWANGIh.png') }}" alt="Demo" />
        </div>
      </div>
@endsection
