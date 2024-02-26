@extends('layouts.app')


@extends('layouts.menu')
@section('content')
<div class="container"  align="center" >
    <form method="POST"  action="{{ route('checkuser1') }}">

    <tr>
        <td>ระบุเดือน-ปี : </td>
        <td>
    <select name="txt_month">
        <option value="">--------------</option>
        <?php
        $month = array('01' => 'มกราคม', '02' => 'กุมภาพันธ์', '03' => 'มีนาคม', '04' => 'เมษายน',
                        '05' => 'พฤษภาคม', '06' => 'มิถุนายน', '07' => 'กรกฎาคม', '08' => 'สิงหาคม',
                        '09' => 'กันยายน ', '10' => 'ตุลาคม', '11' => 'พฤศจิกายน', '12' => 'ธันวาคม');
        $txtMonth = isset($_POST['txt_month']) && $_POST['txt_month'] != '' ? $_POST['txt_month'] : date('m');
        foreach($month as $i=>$mName) {
            $selected = '';
            if($txtMonth == $i) $selected = 'selected="selected"';
            echo '<option value="'.$i.'" '.$selected.'>'. $mName .'</option>'."\n";
        }
        ?>
    </select>
</td>
<td>
    <select name="txt_year">
        <option value="">--------------</option>
        <?php
        $txtYear = (isset($_POST['txt_year']) && $_POST['txt_year'] != '') ? $_POST['txt_year'] : date('Y');
        $yearStart = date('Y');
        $yearEnd = $txtYear-5;
        for($year=$yearStart;$year > $yearEnd;$year--){
            $selected = '';
            if($txtYear == $year) $selected = 'selected="selected"';
            echo '<option value="'.$year.'" '.$selected.'>'. ($year+543) .'</option>'."\n";
        }
        ?>
    </select>
    <td><input type="submit" value="ค้นหา" /></td>
    <table border='1'>
        <thead>
            <tr>
                <th>ไอดี</th>
                <th>รายชื่อพนักงาน</th>
                <!-- Days in the selected month -->
                <?php
                if (!empty($txtMonth)) {
                    echo '<th>';
                    echo '<table border="1">';
                    echo '<tr>';
                    for ($i = 1; $i <= 31; $i++) {
                        echo '<td>' . $i . '</td>';
                    }
                    echo '</tr>';
                    echo '</table>';
                    echo '</th>';
                }
                ?>
            </tr>
        </thead>
        <tbody>
            <!-- Loop through users -->
            @foreach($users as $Company)
            <tr>
                <td>{{ $Company->id }}</td>
                <td>{{ $Company->name }}</td>
                <!-- Other data for each user -->
            </tr>
            @endforeach
            @foreach($attendance as $day => $status)
            <tr>
                <td>{{ $day }}</td>
                <td>{{ $status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</form>

</div>
@endsection
