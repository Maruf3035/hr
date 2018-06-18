<?php
if (!isset($_SESSION)) session_start();
require_once("vendor/autoload.php");
if (!(isset($_SESSION['user_email']))) {
    \App\Utility\Utility::redirect('login.php');
}
require_once('resource/header.php');
use App\Attendance\Attendance;
use App\Hr\Hr;
use App\Leave\Leave;

$object_attendance = new Attendance();
$object_hr = new Hr();
$object_leave = new Leave();

$departmentData = $object_hr->departmentData();


?>
<!DOCTYPE HTML PUBLIC"-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Document</title></head>
<body>
<form action="" method="get">
    <div class="container-fluid"><h4 style="text-align: center">Daily Summary</h4></div>
    <label for="datepicker">Date</label> <input type="text" id="datepicker"
									   value="<?php if (isset($_REQUEST['current_date'])) {
                                                    echo $_REQUEST['current_date'];
                                                } ?>" name="current_date">
    <button class="btn btn-info" value="submit" type="submit">GO</button>
</form>
<table class="table  table-condensed table-bordered ">
    <thead>
    <tr>
	   <th scope="col">Date</th>
	   <th scope="col">Department Name</th>
	   <th scope="col">No of Employee</th>
	   <th scope="col">Present</th>
	   <th scope="col">Absent</th>
    </tr>
    </thead>
    <tbody>
    <?php if (isset($departmentData)) {
        foreach ($departmentData as $data) { ?>
		  <tr>
			 <td> <?php if (isset($_REQUEST['current_date'])) {
                        echo $_REQUEST['current_date'];
                    } else echo "Date"; ?>

			 </td>
			 <td> <?php echo $data->department; ?></td>
			 <td><?php $var = $object_hr->countEmployee($data->id);
                    if (isset($var)) {
                        foreach ($var as $onedata) {
                            echo $onedata->total_user;
                        }
                    } ?></td>
			 <td><?php if (isset($_REQUEST['current_date'])) {
                        $date = "'" . $_REQUEST['current_date'] . "'";
                        $countStatus = $object_attendance->checkStatusPresent($date, $data->id);
                    }
                    if (isset($countStatus) and isset($_REQUEST['current_date'])) {
                        foreach ($countStatus as $statusCount) {
                            echo $statusCount->totalStatus;
                        }
                    }
                    ?></td>
			 <td>

                    <?php if (isset($_REQUEST['current_date'])) {
                        $date = "'" . $_REQUEST['current_date'] . "'";
                        $totalabsent = $object_attendance->checkStatusAbsent($date, $data->id);
                    }
                    if (isset($totalabsent) and isset($_REQUEST['current_date'])) {
                        foreach ($totalabsent as $absent) {
                            echo $absent->totalAbsent;
                        }
                    }
                    ?>
			 </td>
		  </tr>

        <?php }
    } ?>
    <tr>
	   <td>Total</td>
	   <td></td>
	   <td><?php if (isset($_REQUEST['current_date'])) {
                $totalEmployee = $object_hr->totalEmployee();
                if (isset($totalEmployee) and (isset($_REQUEST['current_date']))) {
                    echo "<b>" . $totalEmployee->total;
                }
            } ?></td>
	   <td><?php if (isset($_REQUEST['current_date'])) {
                $date = "'" . $_REQUEST['current_date'] . "'";
                $totalPresent = $object_attendance->totalPresent($date);
                if (isset($totalPresent) and (isset($_REQUEST['current_date']))) {
                    echo "<b>" . $totalPresent->total_present;
                }
            }
            ?>
	   </td>
	   <td><?php if (isset($_REQUEST['current_date'])) {
                $date = "'" . $_REQUEST['current_date'] . "'";
                $totalab = $object_attendance->totalAbsent($date);
                if (isset($totalab) and (isset($_REQUEST['current_date']))) {
                    echo "<b>" . $totalab->total_absent;
                }
	   }


            ?>

	   </td>
    </tr>
    </tbody>
</table>
<?php if (isset($_REQUEST['current_date'])){    $date = "'" . $_REQUEST['current_date'] . "'";
    ?>

    <a href="daily_report.php?current_date=<?php echo $_REQUEST['current_date']?>" class='btn btn-success'>Download Report</a>
<?php } ?>
</body>
</html>