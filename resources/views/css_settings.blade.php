@extends('layouts.app')


@extends('layouts.menu')
@section('content')
<body>
    <h1>Add CSS Settings</h1>
    @if ($errors->has('background_color'))
    <span class="text-danger">{{ $errors->first('background_color') }}</span>
@endif

<!-- แสดงข้อผิดพลาดสำหรับ table_border_color -->
@if ($errors->has('table_border_color'))
    <span class="text-danger">{{ $errors->first('table_border_color') }}</span>
@endif

<!-- แสดงข้อผิดพลาดสำหรับ font_size -->
@if ($errors->has('font_size'))
    <span class="text-danger">{{ $errors->first('font_size') }}</span>
@endif
    <form method="POST" action="{{ route('csssettingsstore') }}" enctype="multipart/form-data">
        @csrf


 <label for="background_image">Background Image:</label>
        <input type="file" id="background_image" name="background_image" value="{{ $customCSS->background_image }}">
        <input type="text" value="{{ $customCSS->background_image }}" readonly>

        <br>

    <br>

    <label for="background_color">Background Color:</label>
    <!-- แสดงค่าสีจากฐานข้อมูล -->
    <input type="color" name="background_color" id="background_color" value="{{ $customCSS->background_color }}"> <br>

    <label for="table_border_color">Table Border Color:</label><br>
    <!-- แสดงค่าสีของ table border จากฐานข้อมูล -->
    <input type="color" name="table_border_color" id="table_border_color" value="{{ $customCSS->table_border_color }}"> <br>

    <label for="font_size">Font Size:</label>
    <!-- แสดงขนาด font ที่บันทึกไว้ -->
    <input type="number" id="font_size" name="font_size" value="{{ $customCSS->font_size }}">
    <br>

        <button type="submit">Save</button>
    </form>
    @endsection
