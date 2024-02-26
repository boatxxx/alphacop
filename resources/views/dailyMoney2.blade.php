
<style>
    .clearfix:after {
  content: "";
  display: table;
  clear: both;
}
.nav-item {
  text-align: center;
}

.nav-link {
  display: flex;
  align-items: center;
  text-decoration: none;
  font-size: 18px; /* ปรับขนาดข้อความ */
  padding: 8px; /* เพิ่มขอบสัมพันธ์รอบไอคอนและข้อความ */
  border: 1px solid #ff0000; /* เพิ่มเส้นขอบ */
  border-radius: 5px; /* ทำให้มุมเรียบ */
}

.nav-link svg {
  flex-shrink: 0;
  width: 32px; /* ปรับความกว้างของ SVG */
  height: 32px; /* ปรับความสูงของ SVG */
  margin-right: 8px; /* ปรับขนาดระยะห่างระหว่าง SVG กับข้อความ */
}


a {
  color: #5D6975;
  text-decoration: underline;
}

body {
  position: relative;
  width: 21cm;
  height: 29.7cm;
  margin: 0 auto;
  color: #001028;
  background: #FFFFFF;
  font-family: Arial, sans-serif;
  font-size: 12px;
  font-family: Arial;
}

header {
  padding: 10px 0;
  margin-bottom: 30px;
}

#logo {
  text-align: center;
  margin-bottom: 10px;
}

#logo img {
  width: 90px;
}

h1 {
  border-top: 1px solid  #5D6975;
  border-bottom: 1px solid  #5D6975;
  color: #5D6975;
  font-size: 2.4em;
  line-height: 1.4em;
  font-weight: normal;
  text-align: center;
  margin: 0 0 20px 0;
  background: url(dimension.png);
}

#project {
  float: left;
}

#project span {
  color: #5D6975;
  text-align: right;
  width: 52px;
  margin-right: 10px;
  display: inline-block;
  font-size: 0.8em;
}

#company {
  float: right;
  text-align: right;
}

#project div,
#company div {
  white-space: nowrap;
}

table {
  width: 100%;
  border-collapse: collapse;
  border-spacing: 0;
  margin-bottom: 20px;
}

table tr:nth-child(2n-1) td {
  background: #F5F5F5;
}

table th,
table td {
  text-align: center;
}

table th {
  padding: 5px 20px;
  color: #5D6975;
  border-bottom: 1px solid #C1CED9;
  white-space: nowrap;
  font-weight: normal;
}

table .service,
table .desc {
  text-align: left;
}

table td {
  padding: 20px;
  text-align: right;
}

table td.service,
table td.desc {
  vertical-align: top;
}

table td.unit,
table td.qty,
table td.total {
  font-size: 1.2em;
}

table td.grand {
  border-top: 1px solid #5D6975;;
}

#notices .notice {
  color: #5D6975;
  font-size: 1.2em;
}

footer {
  color: #5D6975;
  width: 100%;
  height: 30px;
  position: absolute;
  bottom: 0;
  border-top: 1px solid #C1CED9;
  padding: 8px 0;
  text-align: center;
}
.print-button {
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 10px 15px;
  font-size: 18px;
  background-color: #007bff;
  color: #fff;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.printer-logo {
  width: 30px; /* ปรับขนาดของโลโก้ตามที่ต้องการ */
  height: auto;
  margin-right: 10px; /* ระยะห่างของโลโก้กับข้อความ */
}

    </style>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>สรุปยอด</title>
    <link rel="stylesheet" href="style.css" media="all" />
  </head>
  <body>
    <div>
    <header class="clearfix">
      <div id="logo">
        <img src="logo.png">
      </div>
      <h1>ใบแจ้งรายได้</h1>
      <div id="company" class="clearfix">
        <div>บริษัทแห่งนึง</div>
        <div>ถนน 566<br /> ประเทศไทย</div>
        <div>08-999-74-036</div>
        <div><a href="mailto:company@example.com">company@example.com</a></div>
        <div><span>วันที่ประกาศ </span>{{ $currentDate }}</div>
      </div>
      <div id="project">
        <div><span>บริษัท</span> ---</div>
        <div><span>ชื่อพนักงาน</span> {{ $Users->name }} </div>
        <div><span>รหัสพนักงาน</span> {{ $Users->id_name }} </div>
        <div><span>สาขา</span> {{ $Users->branch }}</div>
        <div><span>ตำแหน่ง</span> {{ $Users->position }}</div>
        <div><span>เริ่มต้น</span>{{ $startDate }}</div>
        <div><span>สิ้นสุด</span>{{ $endDate }}</div>

      </div>
    </header>
    <main>
      <table>
        <thead>
          <tr>
            <th class="service">รายการ</th>
            <th class="desc">คำอธิบาย</th>
            <th>ราคา</th>
            <th>จำนวน</th>
            <th>ยอด</th>
          </tr>
        </thead>
        <tbody>
            <tr>
                <td class="service" colspan="5">รายได้</td>
              </tr>
              <tr>
                <td class="desc"></td>
                <td class="desc"><p>ทำงาน {{ $workDays }} วัน  * ค่าแรงต่อวัน {{ $daily }} </p></td>
                <td class="unit">{{ $daily }} </td>
                <td class="qty">{{ $workDays }}</td>
                <td class="total">{{ $totalWages }}</td>
                @foreach ($deductionamount1 as $index => $amount1)
 @if (isset($deductionname1[$index]))



                    <tr>
                        <td bgcolor="#CCCCCC" class="asd1"></td>

                        <td bgcolor="#CCCCCC" class="asd">{{ $deductionname1[$index]  ?? '' }}</td>
                        <td bgcolor="#CCCCCC" class="asd">{{ $amount1 }}</td>
                        <td bgcolor="#CCCCCC" class="asd">{{ $amount1 }}</td>
                        <td bgcolor="#CCCCCC" class="asd">{{ $amount1 }}</td>

                    </tr>
                    {{-- แสดงผลอันที่สอง --}}

@endif

@endforeach




              </tr>
              <tr>
                <td colspan="4">รวมยอดรายได้</td>
                <td class="total">{{ $moneyall2 =$totalWages+ ($amount1 ?? 0)}}</td>
              </tr>
              <tr>
                <td class="service" colspan="5">รายการหัก</td>
              </tr>

              @foreach ($deductionamount as $index => $amount)
              @if (isset($deductionname[$index]))
                  <tr>
                      <td bgcolor="#CCCCCC" class="asd1"></td>
                      <td bgcolor="#CCCCCC" class="asd">{{ $deductionname[$index] ?? '' }}</td>
                      <td bgcolor="#CCCCCC" class="asd">{{ $amount }}</td>
                      <td bgcolor="#CCCCCC" class="asd">{{ $amount }}</td>
                      <td bgcolor="#CCCCCC" class="asd">{{ $amount }}</td>
                  </tr>
                  {{-- แสดงผลอันที่สอง --}}
              @endif
          @endforeach
          <tr>
              <td colspan="4">ภาษี 3%</td>
              <td class="total">{{ $tax = $totalWages * 0.03 }}</td>
          </tr>
          <tr>
              <td colspan="4">รวมยอดรายการหัก</td>
              <td class="total">{{ $moneyall3 = array_sum($deductionamount) + $tax }}</td>
          </tr>


          <tr>
            <td colspan="4" class="grand total">ยอดสุทธิ</td>
            <td class="grand total">{{  $moneyall2-$moneyall3 }}</td>
          </tr>
        </tbody>


      </table>
      <div id="notices">
        <div>ลงชื่อ:</div>
        <div class="notice">บริษัทแห่งนึง
            ถนน 566
            ประเทศไทย
            08-999-74-036
            company@example.com</div>
      </div>
    </main>
    <footer>
     เอกสารสำคัญพบเจอโปรดส่งคืนบริษัท
    </footer>
    <button onclick="printContent()" class="print-button">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
        พิมพ์
    </button>



    </div>
  </body>
</html>

<script>

function printContent() {
  window.print();
}

  </script>
