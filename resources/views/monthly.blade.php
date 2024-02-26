@extends('layouts.app')


@extends('layouts.menu')
@section('content')
<div class="container"  align="center" >
    <form method="post" action="{{ route('calculateSalary') }}">
        @csrf
        <label for="user">พนักงาน:</label>
        <select name="user" id="user" required>
            @foreach($monthlyUsers as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>

        <br>

        <label for="salary">เงินเดือน:</label>
        <input type="number" name="salary" id="salary" required>
        <div id="temporaryDeductionsContainer1">
            <!-- พื้นที่สำหรับรายการหักเงินชั่วคราวที่ถูกเพิ่ม -->
        </div>
        <button id="addTemporaryDeduction1">เพิ่มรายได้</button><br>
        <br>
        <div id="temporaryDeductionsContainer">
                    <!-- พื้นที่สำหรับรายการหักเงินชั่วคราวที่ถูกเพิ่ม -->
                </div>
                   <button id="addTemporaryDeduction">เพิ่มรายการหักเงิน</button><br>
        <label for="start_date">รอบตั้งแต่:</label>
        <input type="date" id="start_date" name="start_date"><br>

        <label for="end_date">ถึง:</label>
        <input type="date" id="end_date" name="end_date"><br>

        <button type="submit">Calculate</button>
    </form>

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
    </div>
@endsection
