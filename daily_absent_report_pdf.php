<?php
ob_start();if (!isset($_SESSION)) session_start();
require_once("vendor/autoload.php");
if (!(isset($_SESSION['user_email']))) {
    \App\Utility\Utility::redirect('login.php');
}
require_once('resource/header.php');


use App\Attendance\Attendance;
use App\Hr\Hr;

$object_attendance = new Attendance();
$object_hr = new Hr();

$current_date = $_GET['current_date'];
$departmentData = $object_attendance->absentReport($current_date);

$trs = "";

$srl = 1;
foreach ($departmentData as $row) {

    $trs .= "<tr >";
    $trs .= "</tr>";
    $trs .= "<td style=\"color: darkblue; width: 200px;border: 1px solid black; text-align: center\"> $srl </td>";
    $trs .= "<td style=\"color: darkblue; width: 200px; border: 1px solid black;text-align: center\" > $row->user_id </td>";
    $trs .= "<td style=\"color: darkblue; width: 200px;border: 1px solid black; text-align: center\" > $row->name </td>";


    $var = $object_hr->departmentAbsent($row->department_id);
    if (isset($var))

        $trs .= "<td style=\"color: darkblue;width: 100px; border: 1px solid black;text-align: center\"> $var->department</td>";




$srl++;
}


$html = <<<BITM
<h3 style="text-align: center">Isratt Technologies </h3>
<h3 style="text-align: center">Daily Absent  Report </h3>
<h3 style="text-align: center">$current_date </h3>
<hr>
<table class="table  table-condensed table-bordered table-border=20px;" style="border-collapse: collapse">
    <thead>
    <tr >
	   <th style="color: darkblue;border: 1px solid black; width: 100px; " >Serial</th>
	   <th style="color: darkblue; border: 1px solid black;width: 120px;">Employee ID</th>
	   <th style="color: darkblue;border: 1px solid black; width:  80px;" >Employee Name</th>
	   <th style="color: darkblue;border: 1px solid black; width: 80px;" >Department</th>
    </tr>
    </thead>
    $trs;
    $trsn;
  </table>
BITM;


require_once("vendor/mpdf/mpdf/mpdf.php");


$mpdf = new mPDF();

// Write some HTML code:

$mpdf->WriteHTML($html);
ob_clean();
// Output a PDF file directly to the browser
$mpdf->Output('list.pdf', 'D');
