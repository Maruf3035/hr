
<?php if (!isset($_SESSION)) session_start();
require_once("vendor/autoload.php");
if (!(isset($_SESSION['user_email']))) {
    \App\Utility\Utility::redirect('login.php');
}
 require_once("resource/header.php");
use App\Hr\Hr;
use App\Attendance\Attendance;

$object_attendance = new Attendance();
$object_hr = new Hr();
$departmentData = $object_hr->departmentData();
?>
<head>
    <style>
	   @media print {
		  .input {
			 display: none;
		  }

		  .but_hidden {
			 display: none;
		  }

	   }
    </style>
</head>
<body>

<div class="container"><h3 style="text-align: center">Isratt Technologies</h3><h4 style="text-align: center">
	   Monthly Report for Employee</h4>
    <br>
    <div class="row">
	   <div class="col-md-2 ">
		  <form action="" method="get">

			 <label for="datepicker">User ID</label> <input type="text" name="user_id"
												   class="form-control"
												   value="<?php if (isset($_REQUEST['user_id'])) {
                                                                   echo $_REQUEST['user_id'];
                                                               } ?>">
	   </div>
	   <div class="col-md-2">
		  <label for="datepicker">Date From</label> <input type="text" id="datepicker" name="date1"
												 value="<?php if (isset($_REQUEST['date1'])) {
                                                                 echo $_REQUEST['date1'];
                                                             } ?>">
	   </div>
	   <div class="col-md-2 offset-md-1">
		  <label for="datepicker2">Date To</label> <input
				type="text" id="datepicker2" name="date2"
				value="<?php if (isset($_REQUEST['date2'])) {
                        echo $_REQUEST['date2'];
                    } ?>">
	   </div>

	   <div class="col-md-1 offset-md-1">
		  <button style="margin-top: 32px;" class="btn btn-info input" value="submit" type="submit">GO</button>

	   </div>
	   </form>
    </div>


<table class="table  table-condensed table-bordered ">
    <thead>
    <tr>
	   <th scope="col">Sl.No</th>
	   <th scope="col">Date</th>
	   <th scope="col">In Time</th>
	   <th scope="col">Out Time</th>
	   <th scope="col">Over Time</th>
	   <!--	   <th scope="col">Late</th>-->
	   <th scope="col">Status</th>
    </tr>
    </thead>
    <tbody>
    <?php if (isset($_REQUEST['user_id']) and ($_REQUEST['date1']) and ($_REQUEST['date2'])) {
    $user_id = $_REQUEST['user_id'];
    $date1 = $_REQUEST['date1'];
    $date2 = $_REQUEST['date2'];
    $allData = $object_attendance->attendanceDataReport($date1, $date2, $user_id);


    $srl = 1;
    foreach ($allData as $data) {
        ?>
	   <tr>
		  <td><?php echo $srl; ?></td>

		  <td><?php echo $data->date ?></td>
		  <td><?php echo $data->intime ?></td>
		  <td><?php echo $data->outtime ?></td>
		  <td><?php echo $data->overtime ?></td>


		  <td>
                <?php echo $data->status; ?>
		  </td>

	   </tr>

        <?php $srl++;
    } ?>

    </tbody>
</table>

    <input type="button" class="but_hidden"
		 onclick="window.print()"
		 value="Print"/>               </button>
<?php
} ?>
</div>
</body>
</html>