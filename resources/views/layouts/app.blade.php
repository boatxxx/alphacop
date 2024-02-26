<!doctype html>
<head>
    <!-- โค้ดอื่น ๆ ที่อยู่ใน head -->
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/x-icon"/>
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/x-icon"/>
</head>

<style>
    #current-time {
        font-size: 20px;
        text-transform: uppercase;
    }
    .nav-item.with-submenu .sub-menu {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        background-color: #fff;
        border: 1px solid #ccc;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        z-index: 1;
    }

    .nav-item.with-submenu:hover .sub-menu {
        display: block;
    }
    :root {
    --font-family-sans-serif: "Open Sans", -apple-system, BlinkMacSystemFont,
    "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji",
    "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
}

*, *::before, *::after {
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
}

html {
    font-family: sans-serif;
    line-height: 1.15;
    -webkit-text-size-adjust: 100%;
    -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
}

nav {
    display: block;
    color: {{ $customCSS->table_border_color }};

    background-color: {{ $customCSS->background_color }}

}

body {
    margin: 0;
    font-family: "Open Sans", -apple-system, BlinkMacSystemFont, "Segoe UI",
    Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji",
    "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #515151;
    text-align: left;
    background-color: #e9edf4;
}

h1, h2, h3, h4, h5, h6 {
    margin-top: 0;
    margin-bottom: 0.5rem;
}

p {
    margin-top: 0;
    margin-bottom: 1rem;
}

a {
    color: #3f84fc;
    text-decoration: none;
    background-color: transparent;
}

a:hover {
    color: #0458eb;
    text-decoration: underline;
}

h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6 {
    font-family: "Nunito", sans-serif;
    margin-bottom: 0.5rem;
    font-weight: 500;
    line-height: 1.2;
}

h1, .h1 {
    font-size: 2.5rem;
    font-weight: normal;
}

.card {
    position: relative;
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -webkit-flex-direction: column;
    -ms-flex-direction: column;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 1px solid rgba(0, 0, 0, 0.125);
    border-radius: 0;
}

.card-body {
    -webkit-box-flex: 1;
    -webkit-flex: 1 1 auto;
    -ms-flex: 1 1 auto;
    flex: 1 1 auto;
    padding: 1.25rem;
}

.card-header {
    padding: 0.75rem 1.25rem;
    margin-bottom: 0;
    background-color: rgba(0, 0, 0, 0.03);
    border-bottom: 1px solid rgba(0, 0, 0, 0.125);
    text-align: center;
}

.dashboard {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    min-height: 100vh;
}

.dashboard-app {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -webkit-flex-direction: column;
    -ms-flex-direction: column;
    flex-direction: column;
    -webkit-box-flex: 2;
    -webkit-flex-grow: 2;
    -ms-flex-positive: 2;
    flex-grow: 2;
    margin-top: 84px;
}

.dashboard-content {
    -webkit-box-flex: 2;
    -webkit-flex-grow: 2;
    -ms-flex-positive: 2;
    flex-grow: 2;
    padding: 25px;
}

.dashboard-nav {
    min-width: 238px;
    position: fixed;
    left: 0;
    top: 0;
    bottom: 0;
    overflow: auto;
    background-color: #373193;
}

.dashboard-compact .dashboard-nav {
    display: none;
}

.dashboard-nav header {
    min-height: 84px;
    padding: 8px 27px;
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-pack: center;
    -webkit-justify-content: center;
    -ms-flex-pack: center;
    justify-content: center;
    -webkit-box-align: center;
    -webkit-align-items: center;
    -ms-flex-align: center;
    align-items: center;
}

.dashboard-nav header .menu-toggle {
    display: none;
    margin-right: auto;
}

.dashboard-nav a {
    color: #515151;
}

.dashboard-nav a:hover {
    text-decoration: none;
}

.dashboard-nav {
    background-color:{{ $customCSS->background_color }};
}

.dashboard-nav a {
    color: #fff;
    color: {{ $customCSS->table_border_color }};

}

.brand-logo {
    font-family: "Nunito", sans-serif;
    font-weight: bold;
    font-size: 21px;
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    color: #515151;
    -webkit-box-align: center;
    -webkit-align-items: center;
    -ms-flex-align: center;
    align-items: center;
}

.brand-logo:focus, .brand-logo:active, .brand-logo:hover {
    color: #dbdbdb;
    text-decoration: none;
}

.brand-logo i {
    color: #d2d1d1;
    font-size: 27px;
    margin-right: 10px;
}

.dashboard-nav-list {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -webkit-flex-direction: column;
    -ms-flex-direction: column;
    flex-direction: column;
}

.dashboard-nav-item {
    min-height: 0px;
    padding: 8px 21px 8px 70px;
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -webkit-align-items: center;
    -ms-flex-align: center;
    align-items: center;
    letter-spacing: 0.02em;
    transition: ease-out 0.5s;
}

.dashboard-nav-item i {
    width: 36px;
    font-size: 19px;
    margin-left: -40px;
}

.dashboard-nav-item:hover {
    background: rgba(255, 255, 255, 0.04);
}

.active {
    background: rgba(0, 0, 0, 0.1);
}

.dashboard-nav-dropdown {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -webkit-flex-direction: column;
    -ms-flex-direction: column;
    flex-direction: column;
}

.dashboard-nav-dropdown.show {
    background: rgba(255, 255, 255, 0.04);
}

.dashboard-nav-dropdown.show > .dashboard-nav-dropdown-toggle {
    font-weight: bold;
}

.dashboard-nav-dropdown.show > .dashboard-nav-dropdown-toggle:after {
    -webkit-transform: none;
    -o-transform: none;
    transform: none;
}


.dashboard-nav-dropdown.show > .dashboard-nav-dropdown-menu {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
}

.dashboard-nav-dropdown-toggle:after {
    content: "";
    margin-left: auto;
    display: inline-block;
    width: 0;
    height: 0;
    border-left: 5px solid transparent;
    border-right: 5px solid transparent;
    border-top: 5px solid rgba(81, 81, 81, 0.8);
    -webkit-transform: rotate(90deg);
    -o-transform: rotate(90deg);
    transform: rotate(90deg);
}

.dashboard-nav .dashboard-nav-dropdown-toggle:after {
    border-top-color: rgba(255, 255, 255, 0.72);
}

.dashboard-nav-dropdown-menu {
    display: none;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -webkit-flex-direction: column;
    -ms-flex-direction: column;
    flex-direction: column;
}

.dashboard-nav-dropdown-item {
    min-height: 0px;
    padding: 8px 22px 8px 70px;
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -webkit-align-items: center;
    -ms-flex-align: center;
    align-items: center;
    transition: ease-out 0.5s;
}

.dashboard-nav-dropdown-item:hover {
    background: rgba(255, 255, 255, 0.04);
}

.menu-toggle {
    position: relative;
    width: 42px;
    height: 42px;
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -webkit-align-items: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-box-pack: center;
    -webkit-justify-content: center;
    -ms-flex-pack: center;
    justify-content: center;
    color: #443ea2;
}

.menu-toggle:hover, .menu-toggle:active, .menu-toggle:focus {
    text-decoration: none;
    color: #875de5;
}

.menu-toggle i {
    font-size: 20px;
}

.dashboard-toolbar {
    min-height: 84px;
    background-color: #dfdfdf;
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -webkit-align-items: center;
    -ms-flex-align: center;
    align-items: center;
    padding: 8px 27px;
    position: fixed;
    top: 0;
    right: 0;
    left: 0;
    z-index: 1000;
}


.nav-item-divider {
    height: 1px;
    margin: 1rem 0;
    overflow: hidden;
    background-color: rgba(236, 238, 239, 0.3);
}

@media (min-width: 992px) {
    .dashboard-app {
        background-image: url('{{ asset(Storage::url("public/background_images/{$customCSS->background_image}")) }}');
        border: 1px solid {{ $customCSS->table_border_color }}; /* กำหนดสีขอบตาราง */

        font-size: {{ $customCSS->font_size }}px; /* กำหนดขนาดตัวอักษร */

        margin-left: 238px;
    }

    .dashboard-compact .dashboard-app  {
        background-image: url('{{ asset(Storage::url("public/background_images/{$customCSS->background_image}")) }}');
        border: 1px solid {{ $customCSS->table_border_color }}; /* กำหนดสีขอบตาราง */

font-size: {{ $customCSS->font_size }}px; /* กำหนดขนาดตัวอักษร */

        margin-left: 0;
    }
}
@media (min-width: 800px) {
    .dashboard-app {
        background-image: url('{{ asset(Storage::url("public/background_images/{$customCSS->background_image}")) }}');
        border: 1px solid {{ $customCSS->table_border_color }}; /* กำหนดสีขอบตาราง */

font-size: {{ $customCSS->font_size }}px; /* กำหนดขนาดตัวอักษร */

        margin-left: 0%;
    }

    .dashboard-compact .dashboard-app {
        background-image: url('{{ asset(Storage::url("public/background_images/{$customCSS->background_image}")) }}');

        margin-left: 0;
    }
}


@media (max-width: 768px) {
    .dashboard-content {
        background-image: url('{{ asset(Storage::url("public/background_images/{$customCSS->background_image}")) }}');
        border: 1px solid {{ $customCSS->table_border_color }}; /* กำหนดสีขอบตาราง */

font-size: {{ $customCSS->font_size }}px; /* กำหนดขนาดตัวอักษร */


        padding: 15px 0px;
    }
}
@media (max-width: 600px) {
    .dashboard-content {
        background-image: url('{{ asset(Storage::url("public/background_images/{$customCSS->background_image}")) }}');
        border: 1px solid {{ $customCSS->table_border_color }}; /* กำหนดสีขอบตาราง */

font-size: {{ $customCSS->font_size }}px; /* กำหนดขนาดตัวอักษร */


        padding: 15px 0px;
    }
}
@media (max-width: 300px) {
    .dashboard-content {
        background-image: url('{{ asset(Storage::url("public/background_images/{$customCSS->background_image}")) }}');
        border: 1px solid {{ $customCSS->table_border_color }}; /* กำหนดสีขอบตาราง */

font-size: {{ $customCSS->font_size }}px; /* กำหนดขนาดตัวอักษร */


        padding: 15px 0px;
    }
}


@media (max-width: 992px) {
    .dashboard-nav  {
        background-image: url('{{ asset(Storage::url("public/background_images/{$customCSS->background_image}")) }}');
        border: 1px solid {{ $customCSS->table_border_color }}; /* กำหนดสีขอบตาราง */

font-size: {{ $customCSS->font_size }}px; /* กำหนดขนาดตัวอักษร */

        display: none;
        position: fixed;
        top: 0;
        right: 0;
        left: 0;
        bottom: 0;
        z-index: 1070;
    }

    .dashboard-nav.mobile-show {
        background-image: url('{{ asset(Storage::url("public/background_images/{$customCSS->background_image}")) }}');
        border: 1px solid {{ $customCSS->table_border_color }}; /* กำหนดสีขอบตาราง */

font-size: {{ $customCSS->font_size }}px; /* กำหนดขนาดตัวอักษร */

        display: block;
    }
}

@media (max-width: 992px) {
    .dashboard-nav header .menu-toggle {
        background-image: url('{{ asset('storage/' . $customCSS->background_image) }}');
        border: 1px solid {{ $customCSS->table_border_color }}; /* กำหนดสีขอบตาราง */

font-size: {{ $customCSS->font_size }}px; /* กำหนดขนาดตัวอักษร */

        display: -webkit-box;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
    }
}
.responsive-image {
    max-width: 100%; /* ปรับขนาดของรูปภาพให้ไม่เกินความกว้างของพื้นที่ที่รองรับ */
    height: auto; /* ให้ความสูงของรูปภาพปรับตามอัตราส่วนเพื่อไม่เกินขนาดความสูง */
    display: block; /* จัดให้รูปภาพแสดงเป็น block element เพื่อความสมบูรณ์ */
    margin: 0 auto; /* จัดให้รูปภาพอยู่ตรงกลางของพื้นที่ที่รองรับ */
}

@media (max-width: 767.98px) {
    .navbar {

        padding-top: 0.5rem; /* ปรับค่า padding ด้านบนของ Navbar ให้เหมาะสม */
        padding-bottom: 0.5rem; /* ปรับค่า padding ด้านล่างของ Navbar ให้เหมาะสม */
    }
    .navbar-expand-md .navbar-nav {


        flex-direction: column; /* จัดเรียงเมนูแนวตั้ง */
    }
    .navbar-expand-md .navbar-nav .nav-item {

        margin-bottom: 0.25rem; /* ปรับค่า margin ของแต่ละเมนูให้มีระยะห่างน้อยลง */
    }
}
@media (min-width: 992px) {
    .dashboard-toolbar {
        background: url('{{ asset(Storage::url("public/background_images/{$customCSS->background_image}")) }}') no-repeat center center fixed,
                linear-gradient({{ $customCSS->background_color }});

font-size: {{ $customCSS->font_size }}px; /* กำหนดขนาดตัวอักษร */

        left: 238px;
    }

    .dashboard-compact .dashboard-toolbar {

        background-image: url('{{ asset(Storage::url("public/background_images/{$customCSS->background_image}")) }}');
        border: 1px solid {{ $customCSS->table_border_color }}; /* กำหนดสีขอบตาราง */

font-size: {{ $customCSS->font_size }}px; /* กำหนดขนาดตัวอักษร */

        left: 0;
    }
}

</style>


<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ALPHACOP</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">

       </script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">



</head>
<body>
   <div class='dashboard'>
    <div class="dashboard-nav">
        <header><a href="#!" class="menu-toggle"><i class="fas fa-bars"></i></a><a href="#"
                                                                                   class="brand-logo"><i
                class="fas fa-anchor"></i> <span>ALPHA COP</span></a></header>
        <nav class="dashboard-nav-list"><a href="{{ route('homeuser') }}" class="dashboard-nav-item"><i class="fas fa-home"></i>
            Home </a><a
                href="{{ route('admin.home') }}" class="dashboard-nav-item active"><i class="fas fa-tachometer-alt"></i> dashboard
        </a><a
                href="{{ route('usercom') }}" class="dashboard-nav-item"><i class="fas fa-file-upload"></i> ข้อมูลพนักงาน </a>
                <a
                href="{{ route('absentee') }}" class="dashboard-nav-item"><i class="fas fa-solid fa-bug"></i> ข้อมูลการขาดงาน </a>
            <div class='dashboard-nav-dropdown'><a href="#!" class="dashboard-nav-item dashboard-nav-dropdown-toggle"><i
                    class="fas fa-photo-video"></i> ข้อมูลการทำงาน </a>
                <div class='dashboard-nav-dropdown-menu'><a href="{{ route('loginuser') }}"
                                                            class="dashboard-nav-dropdown-item">เข้างาน-ออกงาน</a>



                    </div>


            </div>
            <div class='dashboard-nav-dropdown'><a href="#!" class="dashboard-nav-item dashboard-nav-dropdown-toggle"><i
                    class="fas fa-users"></i> รายงาน </a>
                <div class='dashboard-nav-dropdown-menu'><a href="{{ route('daily') }}"
                                                            class="dashboard-nav-dropdown-item">สรุปยอดรายวัน</a><a
                        href="{{ route('monthly') }}" class="dashboard-nav-dropdown-item">รายเดือน</a>
                    </div>
                    <div class='dashboard-nav-dropdown'><a href="#!" class="dashboard-nav-item dashboard-nav-dropdown-toggle"><i
                    class="fas  fa-user-secret"></i> สแกนจุด </a>
                <div class='dashboard-nav-dropdown-menu'><a href="{{ route('adminQRcode') }}"
                                                            class="dashboard-nav-dropdown-item">สร้าง QRcode</a><a
                        href="{{ route('QrCodecreate') }}" class="dashboard-nav-dropdown-item">เพิ่มจุดสแกนจุด</a>
                    </div>
            </div>
            <div class='dashboard-nav-dropdown'><a href="#!" class="dashboard-nav-item dashboard-nav-dropdown-toggle"><i
                    class="fas fa-money-check-alt"></i> ข้อมูลการลา </a>
                <div class='dashboard-nav-dropdown-menu'><a href="{{ route('business') }}"
                                                            class="dashboard-nav-dropdown-item">รายการลา</a><a
                        href="{{ route('business2') }}" class="dashboard-nav-dropdown-item">รออนุมัติการลา</a><a
                        href="{{ route('businesscreate') }}" class="dashboard-nav-dropdown-item"> เพิ่มการลา</a>
                </div>
            </div>
            <a  href="{{ route('csssettings') }}" class="dashboard-nav-item"><i class="fas fa-cogs"></i> Settings </a><a
                    href="{{ route('edituser')}}" class="dashboard-nav-item"><i class="fas fa-user"></i> Profile </a>
          <div class="nav-item-divider"></div>
          <a
                    href="{{ route('home') }}" class="dashboard-nav-item"><i class="fas fa-sign-out-alt"></i> Logout </a>
        </nav>
    </div>
    <div class='dashboard-app mt-0'>
<nav class="navbar navbar-expand-md navbar-light  mt-0" style="background-color: {{ $customCSS->background_color }};">
    <header class=''>
        <a href="#!" class="menu-toggle"><i class="fas fa-bars"></i></a>
    </header>
    <a class="navbar-brand" href="{{ url('/') }}">
        ALPHACOP
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <div id="current-time"><h1>เวลาปันจุบัน</h1></div>

        <!-- Left Side Of Navbar -->
        <ul class="navbar-nav ms-auto">

        </ul>

        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ms-auto">
            <!-- Authentication Links -->
            @guest
                @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                @endif

                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul>
    </div>
</nav>        <div class='dashboard-content'>
            <div class='container'>
                <div class='card'>
                    <main class="py-4">
                        @yield('content')
                    </main>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<script>

    function updateCurrentTime() {
        const currentTimeElement = document.getElementById('current-time');
        const currentTime = new Date().toLocaleTimeString();
        currentTimeElement.textContent = 'เวลาปันจุบัน: ' + currentTime;
    }

    // อัปเดตเวลาทุก 1 วินาที
    setInterval(updateCurrentTime, 1000);
    const mobileScreen = window.matchMedia("(max-width: 990px )");
$(document).ready(function () {
$(".dashboard-nav-dropdown-toggle").click(function () {
$(this).closest(".dashboard-nav-dropdown")
.toggleClass("show")
.find(".dashboard-nav-dropdown")
.removeClass("show");
$(this).parent()
.siblings()
.removeClass("show");
});
$(".menu-toggle").click(function () {
if (mobileScreen.matches) {
$(".dashboard-nav").toggleClass("mobile-show");
} else {
$(".dashboard").toggleClass("dashboard-compact");
}
});
});


    </script>

