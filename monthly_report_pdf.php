<?php
ob_start();

if (!isset($_SESSION)) session_start();

if (!isset($_SESSION)) session_start();
require_once("vendor/autoload.php");
if (!(isset($_SESSION['user_email']))) {
    \App\Utility\Utility::redirect('login.php');
}
require_once('resource/header.php');
use App\Attendance\Attendance;
use App\Hr\Hr;

$object_attendance = new Attendance();
$object_hr = new Hr();

$date1 = $_GET['date1'];
$date2 = $_GET['date2'];
$official_info = $object_hr->officialInfo();


$trs = "";

$srl = 1;
foreach ($official_info as $row) {

    $trs .= "<tr >";
    $trs .= "</tr>";
    $trs .= "<td style=\"color: darkblue; width: 200px;border: 1px solid black; text-align: center\"> $srl </td>";
    $trs .= "<td style=\"color: darkblue; width: 200px;border: 1px solid black; text-align: center\"> $date1 to $date2 </td>";

    $trs .= "<td style=\"color: darkblue; width: 200px; border: 1px solid black;text-align: center\" > $row->user_id </td>";


    if ((isset($date1)) and isset($date2)) {
        $var = $object_attendance->totalPresentId($date1, $date2, $row->user_id);
        foreach ($var as $data) {
            //echo $data->total_present;
            $trs .= "<td style=\"color: darkblue; width: 200px;border: 1px solid black; text-align: center\" > $data->total_present </td>";
        }

        $var = $object_attendance->totalAbsentId($date1, $date2, $row->user_id);
        foreach ($var as $data) {
            echo $data->total_absent;
            $trs .= "<td style=\"color: darkblue; width: 200px;border: 1px solid black; text-align: center\" > $data->total_absent </td>";

        }
        $var_late = $object_attendance->totalLateId($date1, $date2, $row->user_id);
        foreach ($var_late as $data_late) {
            //echo $data->total_absent;
            $trs .= "<td style=\"color: darkblue; width: 200px;border: 1px solid black; text-align: center\" > $data_late->total_late </td>";

        }

    }

    $srl++;
}


$html = <<<BITM
<h3 style="text-align: center">Isratt Technologies </h3>
<h3 style="text-align: center">Monthly Report </h3>
<h3 style="text-align: center">$date1 to $date2 </h3>
<hr>
<table class="table  table-condensed table-bordered table-border=20px;" style="border-collapse: collapse">
    <thead>
    <tr >
	   <th style="color: darkblue;border: 1px solid black; width: 100px; " >Serial</th>
	   <th style="color: darkblue;border: 1px solid black; width: 100px; " >Date</th>
	   <th style="color: darkblue; border: 1px solid black;width: 120px;">Employee ID</th>
	   <th style="color: darkblue;border: 1px solid black; width:  80px;" >Total Present</th>
	   <th style="color: darkblue;border: 1px solid black; width: 80px;" >Total Absent</th>
	   <th style="color: darkblue;border: 1px solid black; width: 80px;" >Total Late</th>
    </tr>
    </thead>
    $trs;
   
  </table>
BITM;


require_once("vendor/mpdf/mpdf/mpdf.php");


$mpdf = new mPDF();

// Write some HTML code:

$mpdf->WriteHTML($html);
ob_clean();
// Output a PDF file directly to the browser
$mpdf->Output('list.pdf', 'D');
