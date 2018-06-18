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
$officialData = $object_hr->personalOfficial();

$date1 = $_GET['date1'];
$date2 = $_GET['date2'];
$day = $_GET['day'];
$monthNumber=$_GET['monthNumber'];
if (isset($_REQUEST['date1'])) {
    if ($monthNumber == 1)  {
       $month='January';
    }  elseif ($monthNumber == 2)  {
       $month='February';
    } elseif ($monthNumber == 3)  {
       $month='March';
    } elseif ($monthNumber == 4)  {
        $month='April';
    }elseif ($monthNumber == 5)  {
        $month='May';
    }
    elseif ($monthNumber == 6)  {
        $month='June';
    }
    elseif ($monthNumber == 7)  {
        $month='July';
    }
    elseif ($monthNumber == 8)  {
        $month='August';
    }
    elseif ($monthNumber == 9)  {
        $month='September';
    }
    elseif ($monthNumber == 10)  {
        $month='October';
    }
    elseif ($monthNumber == 11)  {
        $month='November';
    }
    elseif ($monthNumber == 12)  {
        $month='December';
    }

}

$trs = "";


foreach ($officialData as $row) {

    $trs .= "<tr >";
    $trs .= "</tr>";
    $trs .= "<td style=\"color: darkblue; border: 1px solid black; text-align: center\"> $row->user_id </td>";
    $trs .= "<td style=\"color: darkblue;  border: 1px solid black;text-align: center\" > $row->name </td>";
    $trs .= "<td style=\"color: darkblue; border: 1px solid black;text-align: center\" > $day </td>";
    if ((isset($_REQUEST['day'])) and (isset($date1)) and (isset($date2))) {
        $weekend = $object_attendance->totalWeekendOnlyId($row->user_id, $date1, $date2);
        //echo $weekend->total_weekend;
        $trs .= "<td style=\"color: darkblue; border: 1px solid black;text-align: center\" > $weekend->total_weekend </td>";
        }if ((isset($_REQUEST['day'])) and (isset($date1)) and (isset($date2))) {
        $weekend = $object_attendance->totalWeekendOnlyId($row->user_id, $date1, $date2);
        //echo $weekend->total_weekend;
        $trs .= "<td style=\"color: darkblue;  border: 1px solid black;text-align: center\" > $weekend->total_weekend </td>";
        }
    $trs .= "<td style=\"color: darkblue;  border: 1px solid black;text-align: center\" > 0 </td>";

    if ((isset($_REQUEST['day'])) and (isset($date1)) and (isset($date2))) {

        $var = $object_attendance->totalPresentOnlyId($row->user_id, $date1, $date2);

//        echo $var->total_present;
        $trs .= "<td style=\"color: darkblue;  border: 1px solid black;text-align: center\" > $var->total_present </td>";

    }
if ((isset($_REQUEST['day'])) and (isset($date1)) and (isset($date2))) {

    $var2 = $object_attendance->totalAbsentOnlyId($row->user_id, $date1, $date2);

//    echo $var2->total_absent;
    $trs .= "<td style=\"color: darkblue;  border: 1px solid black;text-align: center\" > $var2->total_absent </td>";

} if ((isset($_REQUEST['day'])) and (isset($date1)) and (isset($date2))) {

        $var3 = $object_attendance->totalLateOnlyId($row->user_id, $date1, $date2);

        //echo $var3->total_late;
        $trs .= "<td style=\"color: darkblue; border: 1px solid black;text-align: center\" > $var3->total_late </td>";

    }
    if ((isset($_REQUEST['day'])) and (isset($date1)) and (isset($date2))) {

        $var3 = $object_attendance->totalOverTimeById($row->user_id, $date1, $date2);

        $overTime = ($var3->total_overTime);
        $ot= round($overTime, 2);

        $trs .= "<td style=\"color: darkblue;  border: 1px solid black;text-align: center\" > $ot </td>";

        }
    if ((isset($_REQUEST['day'])) and (isset($date1)) and (isset($date2))) {

        $var4 = $object_attendance->totalLateOnlyId($row->user_id, $date1, $date2);
        $var_test = floor(($var4->total_late) / 3);
//        echo $var_test;
        $trs .= "<td style=\"color: darkblue; border: 1px solid black;text-align: center\" > $var_test </td>";

    }
    if ((isset($_REQUEST['day'])) and (isset($date1)) and (isset($date2))) {
        $salary = $object_hr->SalaryById($row->user_id);
        $fixedSalary = $salary->salary_emp;
        $dailySalary = (($fixedSalary) / $day);
        $hourlySalary = $dailySalary / 8;
        $var3 = $object_attendance->totalOverTimeById($row->user_id, $date1, $date2);
        $overTime = ($var3->total_overTime);
        $overTimeSalary = ($hourlySalary * $overTime);
       $ots= round($overTimeSalary, 2);
        $trs .= "<td style=\"color: darkblue;  border: 1px solid black;text-align: center\" > $ots </td>";

    }
    if ((isset($_REQUEST['day'])) and (isset($date1)) and (isset($date2))) {


        $salary = $object_hr->SalaryById($row->user_id);
      $fixedSalary = $salary->salary_emp;
        $trs .= "<td style=\"color: darkblue;  border: 1px solid black;text-align: center\" > $fixedSalary</td>";
        }
    if ((isset($_REQUEST['day'])) and (isset($date1)) and (isset($date2))) {

        $var2 = $object_attendance->totalAbsentOnlyId($row->user_id, $date1, $date2);
        $var4 = $object_attendance->totalLateOnlyId($row->user_id, $date1, $date2);
        $var_test = floor(($var4->total_late) / 3);

        $salary = $object_hr->SalaryById($row->user_id);
        $fixedSalary = $salary->salary_emp;
        $dailySalary = (($fixedSalary) / $day);
        $minusSalary = ($var_test + ($var2->total_absent)) * $dailySalary;
        $ms= round($minusSalary, 2);
        $trs .= "<td style=\"color: darkblue;  border: 1px solid black;text-align: center\" > $ms</td>";

    }
    if ((isset($_REQUEST['day'])) and (isset($date1)) and (isset($date2))) {

        $var2 = $object_attendance->totalAbsentOnlyId($row->user_id, $date1, $date2);
        $var4 = $object_attendance->totalLateOnlyId($row->user_id, $date1, $date2);
        $var_test = floor(($var4->total_late) / 3);

        $salary = $object_hr->SalaryById($row->user_id);
        $fixedSalary = $salary->salary_emp;
        $dailySalary = (($fixedSalary) / $day);
        $minusSalary = ($var_test + ($var2->total_absent)) * $dailySalary;
        $totalSalary = ($fixedSalary - $minusSalary) + $overTimeSalary;
        $ts= round($totalSalary, 2);
        $trs .= "<td style=\"color: darkblue;  border: 1px solid black;text-align: center\" > $ts</td>";
        }




    }






$html = <<<BITM
<h3 style="text-align: center">Isratt Technologies </h3>
<h3 style="text-align: center">Payroll for $month  </h3>
<hr>
<table class="table  table-condensed table-bordered table-border=20px;" style="border-collapse: collapse">
    <thead>
    <tr >
	   <th style="color: darkblue;border: 1px solid black; " >ID</th>
	   <th style="color: darkblue; border: 1px solid black;">Name</th>
	   <th style="color: darkblue;border: 1px solid black; " >Days</th>
	   <th style="color: darkblue;border: 1px solid black; " >W</th>
	   <th style="color: darkblue;border: 1px solid black; " >H</th>
	   <th style="color: darkblue;border: 1px solid black; " >Leave</th>
	   <th style="color: darkblue;border: 1px solid black; " >P</th>
	   <th style="color: darkblue;border: 1px solid black; " >A</th>
	   <th style="color: darkblue;border: 1px solid black; " >L</th>
	   <th style="color: darkblue;border: 1px solid black; " >OT</th>
	   <th style="color: darkblue;border: 1px solid black; " >AoL</th>
	   <th style="color: darkblue;border: 1px solid black; " >OT Salary</th>
	   <th style="color: darkblue;border: 1px solid black; " >Fixed Salary</th>
	   <th style="color: darkblue;border: 1px solid black; " >Decrease Salary</th>
	   <th style="color: darkblue;border: 1px solid black; " >Total Salary</th>
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
$mpdf->Output('payroll.pdf', 'D');
?>