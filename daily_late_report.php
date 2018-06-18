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

//$departmentData = $object->departmentData();
if (isset($_REQUEST['current_date'])) {
    $date = $_REQUEST['current_date'];
    $allData = $object_attendance->lateReport($date);
}

?>
<!DOCTYPE HTML PUBLIC"-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Document</title>
    <style>
	   @media print {
		  .input {
			 display: none;
		  }

		  header {
			 display: none;
		  }

		  input {
			 display: none;
		  }
	   }
    </style>
</head>
<body>
<form action="" method="get">

    <div class="container-fluid"><h3 style="text-align: center">Isratt Technologies</h3><h4 style="text-align: center">
		  Daily Late Report</h4>
	   <br></div>
    <div class="date" style="text-align: center; ">
	   <label for="datepicker">Date</label> <input type="text" id="datepicker"
										  value="<?php if (isset($_REQUEST['current_date'])) {
                                                        echo $_REQUEST['current_date'];
                                                    } ?>" name="current_date">
	   <button class="btn btn-info input" value="submit" type="submit">GO</button>
    </div>
</form>
<table class="table  table-condensed table-bordered ">
    <thead>
    <tr>
	   <th scope="col">Sl.No</th>
	   <th scope="col">Employee Id</th>
	   <th scope="col">Employee Name</th>
	   <th scope="col">Employee InTime</th>
	   <th scope="col">Late</th>
	   <th scope="col">Department</th>
    </tr>
    </thead>
    <tbody>
    <?php if ((isset($allData))) {
        $srl = 1;
        foreach ($allData as $oneData) { ?>
		  <tr>
			 <td>
                    <?php echo $srl; ?>
			 </td>
			 <td><?php echo $oneData->user_id; ?></td>
			 <td><?php echo $oneData->name; ?></td>
			 <td><?php echo $oneData->intime; ?></td>
			 <td><?php echo $oneData->late . 'Hour'; ?></td>
			 <td><?php $deptData = $object_hr->departmentLate($oneData->department_id);
                    echo $deptData->department;

                    ?></td>
		  </tr>
            <?php $srl++;
        }
    } ?>
    </tbody>
</table>
<?php if (isset($_REQUEST['current_date'])) {
    $date = "'" . $_REQUEST['current_date'] . "'";
    ?>
    <!--    <a href="daily_late_report_pdf.php?current_date=--><?php //echo $_REQUEST['current_date']?><!--" class='btn btn-success'>Download</a>-->

    <input type="button" class="input"
		 onclick="window.print()"
		 value="Print"/>
<?php } ?>
</body>
</html>
