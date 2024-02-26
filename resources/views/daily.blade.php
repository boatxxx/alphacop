@extends('layouts.app')


@extends('layouts.menu')
@section('content')
<div class="container"  align="center" >
    <main>
        <section>
            <h2>บันทึกรายวันการทำงาน</h2>

            <form action="{{ route('daily.store') }}" method="post">
                @csrf
            <div class="search-group">
                <label for="company-select">เลือกพนักงาน :</label>
                <select name="company-select" id="company-select" class="search-input">
                    <option value="">-- เลือกพนักงาน --</option>
                    @foreach ($allUsers as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
                @csrf <!-- ใน Laravel ใช้ตัวนี้เพื่อรับรองความถูกต้องของแบบฟอร์ม -->
                <label for="start_date">รอบตั้งแต่:</label>
                <input type="date" id="start_date" name="start_date"><br>

                <label for="end_date">ถึง:</label>
                <input type="date" id="end_date" name="end_date"><br>
                <label for="daily">จำนวนค่าแรงต่อวัน</label>
                <input type="number" id="daily" name="daily" required><br>

                <div id="temporaryDeductionsContainer1">
                    <!-- พื้นที่สำหรับรายการหักเงินชั่วคราวที่ถูกเพิ่ม -->
                </div>

                <br>

                <div id="temporaryDeductionsContainer1">
                    <!-- พื้นที่สำหรับรายการหักเงินชั่วคราวที่ถูกเพิ่ม -->
                </div>
                <button id="addTemporaryDeduction1">เพิ่มรายได้</button><br>

                </select>


                <label for="deduction_amount">หักภาษี3%</label><br>


                <br>
<label for="work_details">รายละเอียดการทำงาน:</label>
                <textarea id="work_details" name="work_details" required></textarea><br>
                <div id="temporaryDeductionsContainer">
                    <!-- พื้นที่สำหรับรายการหักเงินชั่วคราวที่ถูกเพิ่ม -->
                </div>
                   <button id="addTemporaryDeduction">เพิ่มรายการหักเงิน</button><br>

                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        const addTemporaryDeductionBtn = document.getElementById("addTemporaryDeduction");
                        const temporaryDeductionsContainer = document.getElementById("temporaryDeductionsContainer");

                        addTemporaryDeductionBtn.addEventListener("click", function() {
                            const temporaryDeductionDiv = document.createElement("div");
                            temporaryDeductionDiv.innerHTML = `
                                <label for="temporary_deduction_name">ชื่อหักเงิน:</label>
                                <input type="text" name="deduction_name[]" required>

                                <label for="temporary_deduction_amount">จำนวนเงินที่หัก:</label>
                                <input type="number" name="deduction_amount[]" required>
                                <br>
                            `;
                            temporaryDeductionsContainer.appendChild(temporaryDeductionDiv);
                        });
                    });
                </script>

                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        const addTemporaryDeductionBtn = document.getElementById("addTemporaryDeduction1");
                        const temporaryDeductionsContainer = document.getElementById("temporaryDeductionsContainer1");

                        addTemporaryDeductionBtn.addEventListener("click", function() {
                            const temporaryDeductionDiv = document.createElement("div");
                            temporaryDeductionDiv.innerHTML = `
                                <label for="temporary_deduction_name">รายได้จากอะไร:</label>
                                <input type="text" name="deduction_name1[]" required>

                                <label for="temporary_deduction_amount">จำนวนเงิน:</label>
                                <input type="number" name="deduction_amount1[]" required>
                                <br>
                            `;
                            temporaryDeductionsContainer.appendChild(temporaryDeductionDiv);
                        });
                    });
                </script>
                <button type="submit" id="clickButton">สรุปรายงาน</button>
                <script>
                    const button = document.getElementById('clickButton');
                    button.addEventListener('click', async () => {
                      const response = await fetch('/get-current-date'); // ส่งคำร้องขอไปยัง URL '/get-current-date'
                      const data = await response.json();
                      console.log(data.currentDate);
                    });
                  </script>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2023 บริษัทคุณ. สงวนลิขสิทธิ์ทั้งหมด.</p>
    </footer>
</div>
@endsection
