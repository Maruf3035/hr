<?php

ob_start();

if (!isset($_SESSION)) session_start();
require_once("vendor/autoload.php");
if (!(isset($_SESSION['user_email']))) {
    \App\Utility\Utility::redirect('login.php');
}
require_once('resource/header.php');

use App\Hr\Hr;
use App\Attendance\Attendance;

$object_attendance = new Attendance();
$object_hr = new Hr();

$departmentData = $object_hr->departmentData();

$current_date = $_GET['current_date'];
$trs = "";


foreach ($departmentData as $row) {
    $department = $row->department;
    $trs .= "<tr >";
    $trs .= "<td style=\"color: darkblue; width: 200px; text-align: center\"> $current_date </td>";
    $trs .= "<td style=\"color: darkblue; width: 200px; text-align: center\" > $department </td>";


    $var = $object_hr->countEmployee($row->id);
    if (isset($var)) {
        foreach ($var as $onedata) {
            $trs .= "<td style=\"color: darkblue;width: 100px; text-align: center\"> $onedata->total_user</td>";

        }
    }
    $trs .= "</tr>";
    if (isset($current_date)) {
        $date = "'" . $current_date . "'";
        $countStatus = $object_attendance->checkStatusPresent($date, $row->id);
    }
    if (isset($countStatus) and isset($current_date)) {
        foreach ($countStatus as $statusCount) {
            $trs .= "<td style=\"color: darkblue; width: 100px; text-align: center\"> $statusCount->totalStatus</td>";
        }
    }
    if (isset($current_date)) {
        $date = "'" . $current_date . "'";
        $totalabsent = $object_attendance->checkStatusAbsent($date, $row->id);
    }
    if (isset($totalabsent) and isset($current_date)) {
        foreach ($totalabsent as $absent) {
            $trs .= "<td style=\"color: darkblue; width: 100px; text-align: center\"> $absent->totalAbsent</td>";
        }
    }


}

$trsn = "";
$trsn .= "<tr>";
$trsn .= "<td style='width: 100px;text-align: center' > Total </td>";
$trsn .= "</tr>";

if (isset($current_date)) {
    $totalEmployee = $object_hr->totalEmployee();
    if (isset($totalEmployee) and (isset($current_date))) {
        $trsn .= "<td style='width: 100px;text-align: center'> ---</td>";
        $trsn .= "<td style='width: 100px;text-align: center'> $totalEmployee->total</td>";
    }
}
if (isset($current_date)) {
    $date = "'" . $current_date . "'";
    $totalPresent = $object_attendance->totalPresent($date);
    if (isset($totalPresent) and (isset($current_date))) {
        $trsn .= "<td style='width: 100px;text-align: center'> $totalPresent->total_present</td>";

    }

}
if (isset($current_date)) {
    $date = "'" . $current_date . "'";
    $totalab = $object_attendance->totalAbsent($date);
    if (isset($totalab) and (isset($current_date))) {
        $trsn .= "<td style='width: 100px;text-align: center'> $totalab->total_absent</td>";


    }
}


$html = <<<BITM
<h3 style="text-align: center">Daily Report for $current_date</h3>
<hr>
<table class="table  table-condensed table-bordered table-border=20px;">
    <thead>
    <tr >
	   <th style="color: darkblue; width: 100px; " >Date</th>
	   <th style="color: darkblue; width: 120px;">Department</th>
	   <th style="color: darkblue;width:  80px;" >No of Employee</th>
	   <th style="color: darkblue; width: 80px;" >Present</th>
	   <th style="color: darkblue; width: 80px;">Absent</th>
    </tr>
    </thead>
    $trs;
    $trsn;
  </table>
BITM;


require_once("../vendor/mpdf/mpdf/mpdf.php");


$mpdf = new mPDF();

// Write some HTML code:

$mpdf->WriteHTML($html);
ob_clean();
// Output a PDF file directly to the browser
$mpdf->Output('list.pdf', 'D');
