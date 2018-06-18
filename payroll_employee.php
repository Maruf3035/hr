<?php



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

if (isset($_REQUEST['month'])) {
    $monthNumber = $_REQUEST['month'];
    if (($monthNumber == 1) or ($monthNumber == 0)) {
        $date1 = '01/01/2018';
        $date2 = '01/31/2018';
        $day = 31;
    } elseif ($monthNumber == 2) {
        $date1 = '02/01/2018';
        $date2 = '02/28/2018';
        $day = 28;
    } elseif ($monthNumber == 3) {
        $date1 = '03/01/2018';
        $date2 = '03/31/2018';
        $day = 31;
    } elseif ($monthNumber == 4) {
        $date1 = '04/01/2018';
        $date2 = '04/30/2018';
        $day = 30;
    } elseif ($monthNumber == 5) {
        $date1 = '05/01/2018';
        $date2 = '05/31/2018';
        $day = 31;
    } elseif ($monthNumber == 6) {
        $date1 = '06/01/2018';
        $date2 = '06/30/2018';
        $day = 30;
    } elseif ($monthNumber == 7) {
        $date1 = '07/01/2018';
        $date2 = '07/30/2018';
        $day = 30;
    } elseif ($monthNumber == 8) {
        $date1 = '08/01/2018';
        $date2 = '08/31/2018';
        $day = 31;
    } elseif ($monthNumber == 9) {
        $date1 = '09/01/2018';
        $date2 = '09/30/2018';
        $day = 30;
    } elseif ($monthNumber == 10) {
        $date1 = '10/01/2018';
        $date2 = '10/31/2018';
        $day = 31;
    } elseif ($monthNumber == 11) {
        $date1 = '11/01/2018';
        $date2 = '11/30/2018';
        $day = 30;
    } elseif ($monthNumber == 12) {
        $date1 = '12/01/2018';
        $date2 = '12/31/2018';
        $day = 31;
    }

}

?>
<body>
<div class="container-fluid">
    <div class="row">
	   <div class="col-md-12" style="text-align: center">

		  <form method="get">
			 <label for="date"> <select name="month" id="date" class="form-control">
				    <option value="">Choose Month</option>

				    <option value="1" <?php if (isset($monthNumber)) {
                            echo $selected = ($monthNumber == 1) ? "selected='selected'" : "";
                        } ?>>January
				    </option>
				    <option value="2" <?php if (isset($monthNumber)) {
                            echo $selected = ($monthNumber == 2) ? "selected='selected'" : "";
                        } ?>>February
				    </option>
				    <option value="3" <?php if (isset($monthNumber)) {
                            echo $selected = ($monthNumber == 3) ? "selected='selected'" : "";
                        } ?>>March
				    </option>
				    <option value="4" <?php if (isset($monthNumber)) {
                            echo $selected = ($monthNumber == 4) ? "selected='selected'" : "";
                        } ?>>April
				    </option>
				    <option value="5" <?php if (isset($monthNumber)) {
                            echo $selected = ($monthNumber == 5) ? "selected='selected'" : "";
                        } ?>>May
				    </option>
				    <option value="6" <?php if (isset($monthNumber)) {
                            echo $selected = ($monthNumber == 6) ? "selected='selected'" : "";
                        } ?>>June
				    </option>
				    <option value="7" <?php if (isset($monthNumber)) {
                            echo $selected = ($monthNumber == 7) ? "selected='selected'" : "";
                        } ?>>July
				    </option>
				    <option value="8" <?php if (isset($monthNumber)) {
                            echo $selected = ($monthNumber == 8) ? "selected='selected'" : "";
                        } ?>>August
				    </option>
				    <option value="9" <?php if (isset($monthNumber)) {
                            echo $selected = ($monthNumber == 9) ? "selected='selected'" : "";
                        } ?>>September
				    </option>
				    <option value="10" <?php if (isset($monthNumber)) {
                            echo $selected = ($monthNumber == 10) ? "selected='selected'" : "";
                        } ?>>October
				    </option>
				    <option value="11" <?php if (isset($monthNumber)) {
                            echo $selected = ($monthNumber == 11) ? "selected='selected'" : "";
                        } ?>>November
				    </option>
				    <option value="12" <?php if (isset($monthNumber)) {
                            echo $selected = ($monthNumber == 12) ? "selected='selected'" : "";
                        } ?>>December
				    </option>
				</select></label>
			 <button class="btn btn-info" value="submit" type="submit">Submit</button>
		  </form>

	   </div>
    </div>

    <table class="table  table-condensed table-bordered ">
	   <thead>
	   <tr>

		  <th scope="col">User ID</th>
		  <th scope="col">Name</th>
		  <th scope="col">Total Days</th>
		  <th scope="col">Weekend</th>
		  <th scope="col">Holiday</th>
		  <th scope="col">Leave</th>
		  <th scope="col">Present</th>
		  <th scope="col">Absent</th>
		  <th scope="col">Late</th>
		  <th scope="col">Over Time</th>
		  <th scope="col">AoL</th>

		  <th scope="col">Over Time Salary</th>
		  <th scope="col">Fixed Salary</th>
		  <th scope="col">Decrease Salary</th>

		  <th scope="col">Total Salary</th>
	   </tr>
	   </thead>
	   <tbody>
        <?php foreach ($officialData as $data) { ?>
		  <tr>

			 <td>
                    <?php echo $data->user_id; ?>
			 </td>

			 <td>
                    <?php echo $data->name; ?>

			 </td>
			 <td>
                    <?php if ((isset($_REQUEST['month'])) and (isset($officialData))) {
                        echo $day;
                    }
                    ?>
			 </td>
			 <td>
                    <?php
                    if ((isset($_REQUEST['month'])) and (isset($date1)) and (isset($date2))) {

                        $weekend = $object_attendance->totalWeekendOnlyId($data->user_id, $date1, $date2);

                        echo $weekend->total_weekend;
                    } ?>
			 </td>
			 <td>
                    <?php
                    if ((isset($_REQUEST['month'])) and (isset($date1)) and (isset($date2))) {

                        $weekend = $object_attendance->totalHolidayOnlyId($data->user_id, $date1, $date2);

                        echo $weekend->total_holiday;
                    } ?>
			 </td>
			 <td>
                    <?php
                    if ((isset($_REQUEST['month'])) and (isset($date1)) and (isset($date2))) {

                        $weekend = $object_attendance->totalLeaveOnlyId($data->user_id, $date1, $date2);

                        echo $weekend->total_leave;
                    } ?>

			 </td>
			 <td>
                    <?php
                    if ((isset($_REQUEST['month'])) and (isset($date1)) and (isset($date2))) {

                        $var = $object_attendance->totalPresentOnlyId($data->user_id, $date1, $date2);

                        echo $var->total_present;
                    } ?>
			 </td>
			 <td>
                    <?php
                    if ((isset($_REQUEST['month'])) and (isset($date1)) and (isset($date2))) {

                        $var2 = $object_attendance->totalAbsentOnlyId($data->user_id, $date1, $date2);

                        echo $var2->total_absent;
                        
                    } ?>
			 </td>
			 <td>
                    <?php
                    if ((isset($_REQUEST['month'])) and (isset($date1)) and (isset($date2))) {

                        $var3 = $object_attendance->totalLateOnlyId($data->user_id, $date1, $date2);

                        echo $var3->total_late;
                    }
                    ?>
			 </td>
			 <td>

                    <?php
                    if ((isset($_REQUEST['month'])) and (isset($date1)) and (isset($date2))) {

                        $var3 = $object_attendance->totalOverTimeById($data->user_id, $date1, $date2);

                        $overTime = ($var3->total_overTime);
                        echo round($overTime, 2);
//                        echo $var3->total_overTime;
                    } ?>

			 </td>
			 <td>
                    <?php
                    if ((isset($_REQUEST['month'])) and (isset($date1)) and (isset($date2))) {

                        $var4 = $object_attendance->totalLateOnlyId($data->user_id, $date1, $date2);
                        $var_test = floor(($var4->total_late) / 3);
                        echo $var_test;
                    } ?>
			 </td>

			 <td>
                    <?php
                    if ((isset($_REQUEST['month'])) and (isset($date1)) and (isset($date2))) {
                        $salary = $object_hr->SalaryById($data->user_id);
                        $fixedSalary = $salary->salary_emp;
                        $dailySalary = (($fixedSalary) / $day);
                        $hourlySalary = $dailySalary / 8;
                        $var3 = $object_attendance->totalOverTimeById($data->user_id, $date1, $date2);
                        $overTime = ($var3->total_overTime);
                        $overTimeSalary = (($hourlySalary*1.5) *( $overTime));
                        echo round($overTimeSalary, 2);
                    }
                    ?>

			 </td>
			 <td>
                    <?php

                    if ((isset($_REQUEST['month'])) and (isset($date1)) and (isset($date2))) {


                        $salary = $object_hr->SalaryById($data->user_id);
                        echo $fixedSalary = $salary->salary_emp;


                    }
                    ?>

			 </td>
			 <td>

                    <?php

                    if ((isset($_REQUEST['month'])) and (isset($date1)) and (isset($date2))) {

                        $var2 = $object_attendance->totalAbsentOnlyId($data->user_id, $date1, $date2);
                        $var4 = $object_attendance->totalLateOnlyId($data->user_id, $date1, $date2);
                        $var_test = floor(($var4->total_late) / 3);

                        $salary = $object_hr->SalaryById($data->user_id);
                        $fixedSalary = $salary->salary_emp;
                        $dailySalary = (($fixedSalary) / $day);
                        $minusSalary = ($var_test + ($var2->total_absent)) * $dailySalary;
                        echo round($minusSalary, 2);
                    }
                    ?>
			 </td>
			 <td>
                    <?php

                    if ((isset($_REQUEST['month'])) and (isset($date1)) and (isset($date2))) {

                        $var2 = $object_attendance->totalAbsentOnlyId($data->user_id, $date1, $date2);
                        $var4 = $object_attendance->totalLateOnlyId($data->user_id, $date1, $date2);
                        $var_test = floor(($var4->total_late) / 3);

                        $salary = $object_hr->SalaryById($data->user_id);
                        $fixedSalary = $salary->salary_emp;
                        $dailySalary = (($fixedSalary) / $day);
                        $minusSalary = ($var_test + ($var2->total_absent)) * $dailySalary;
                        $totalSalary = ($fixedSalary - $minusSalary) + $overTimeSalary;
                        echo round($totalSalary, 2);
                    }
                    ?>
			 </td>
		  </tr>

        <?php } ?>
	   </tbody>
    </table>
    <?php if ((isset($_REQUEST['month'])) and (isset($date1)) and (isset($date2))) {?>
        <a href = "payroll_employee_report_pdf.php?date1=<?php echo $date1; ?>&& date2=<?php echo $date2; ?>&& day=<?php echo $day; ?>&& monthNumber=<?php echo $monthNumber?>"
	  class='btn btn-success' > Download Report </a >
   <?php  } ?>
</div>
</body>