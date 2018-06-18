
<?php
ob_start();
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

$current_date = $_GET['current_date'];
$departmentData = $object_attendance->lateReport($current_date);

$trs = "style=\"border: 1px solid black;\"";

$srl = 1;
foreach ($departmentData as $row) {

    $trs .= "<tr style=\"border: 1px solid black;\" >";
    $trs .= "<td style=\"color: darkblue; width: 200px; border: 1px solid black; text-align: center\"> $srl </td>";
    $trs .= "<td style=\"color: darkblue; width: 200px; border: 1px solid black; text-align: center\" > $row->user_id </td>";
    $trs .= "<td style=\"color: darkblue; width: 200px;  border: 1px solid black;text-align: center\" > $row->name </td>";
    $trs .= "<td style=\"color: darkblue; width: 200px; border: 1px solid black; text-align: center\" > $row->intime </td>";
    $trs .= "<td style=\"color: darkblue; width: 200px;  border: 1px solid black; text-align: center\" > $row->late </td>";


    $var = $object_hr->departmentLate($row->department_id);
    if (isset($var))

        $trs .= "<td style=\"color: darkblue;width: 100px;border: 1px solid black; text-align: center\"> $var->department</td>";


    $trs .= "</tr>";

$srl++;
    }


$html = <<<BITM
<h3 style="text-align: center">Isratt Technologies </h3>
<h3 style="text-align: center">Daily Late  Report </h3>
<h3 style="text-align: center">$current_date </h3>
<hr>
<table class="table table-striped" style="border-collapse: collapse;border: 1px solid black;">
   <thead>
    <tr  style="border: 1px solid black;">
	   <th style="color: darkblue; width: 100px;border: 1px solid black; " >Serial</th>
	   <th style="color: darkblue; width: 120px;border: 1px solid black;">Employee ID</th>
	   <th style="color: darkblue;width:  80px;border: 1px solid black;" >Employee Name</th>
	   <th style="color: darkblue;width:  80px;border: 1px solid black;" >Employee In Time</th>
	   <th style="color: darkblue;width:  80px;border: 1px solid black;" >Late</th>
	   <th style="color: darkblue; width: 80px;border: 1px solid black;" >Department</th>
	  
    </tr>
   </thead>
   <tbody>
    $trs;
   
   </tbody>
  </table>
BITM;


require_once("vendor/mpdf/mpdf/mpdf.php");


$mpdf = new mPDF();

// Write some HTML code:

$mpdf->WriteHTML($html);
ob_clean();
// Output a PDF file directly to the browser
$mpdf->Output('list.pdf', 'D');
