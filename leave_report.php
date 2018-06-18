<?php if (!isset($_SESSION)) session_start();

if (!isset($_SESSION)) session_start();
require_once("vendor/autoload.php");
if (!(isset($_SESSION['user_email']))) {
    \App\Utility\Utility::redirect('login.php');
}
require_once('resource/header.php');

use App\Message\Message;
use App\Attendance\Attendance;
use App\Leave\Leave;
use App\Hr\Hr;

$msg = Message::message();


$object_attendance = new Attendance();
$object_hr = new Hr();
$object_leave = new Leave();

$leaveTypeData = $object_leave->leaveTypeData();
if ((isset($_GET['user_id']))) {
    $alldata = $object_leave->employeeLeavById($_GET['user_id']);
} ?>
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
<form action="" method="get" class="form-control">
    <div class="container-fluid">
	   <div class="row">
		  <div class="col-md-2 ">
			 <label for="user_id">User ID</label> <input type="text" name="user_id"
												value="<?php if (isset($_REQUEST['user_id'])) {
                                                                echo $_REQUEST['user_id'];
                                                            } ?>"
												class="form-control" required>
		  </div>

		  <div class="col-md-1">
			 <button style="margin-top: 32px;" class="btn btn-info but_hidden" value="submit" type="submit">GO
			 </button>
</form>
</div></div>
<?php if (isset($alldata)) { ?>
    <div class="row">
	   <div class="col-md-12">
		  <h3 style="text-align: center">Employee Leave Report</h3>
		  <form action="employee_entry_leave_process.php" method="POST">

			 <table class="table table-sm table-responsive table-striped ">
				<thead>
				<tr>
				    <th>Id</th>
				    <th>Leave</th>
				    <th>Available Days</th>
				    <th>Leave Date</th>
				    <th>Leave Spend</th>
				    <th>Remaining Days</th>

				</tr>
				</thead>

				<tbody>
                    <?php

                    foreach ($alldata as $singledata) {
                        ?>
				    <tr>
					   <td><?php echo $singledata->user_id; ?></td>
					   <td><?php
                                $type = $object_leave->leaveTypeDataById($singledata->leave_type_id);
                                echo $type->leave_type; ?></td>
					   <td><?php

						  $add1 = $singledata->remaining_days;
                                $add2 = $singledata->days;
                                echo $add = $add1 + $add2;
                                ?>
					   </td>

					   <td>
						  <?php

						  $arrdate=explode(',',$singledata->from_date);
						  echo current($arrdate)." To ".end($arrdate); ?></td>
					   <td><?php echo $singledata->days; ?></td>
					   <td><?php echo $singledata->remaining_days; ?></td>

				    </tr>

                    <?php } ?>
				</tbody>
			 </table>
			 <input type="button" class="but_hidden"
				   onclick="window.print()"
				   value="Print"/>               </button>

		  </form>
	   </div>
    </div>
    </div>
<?php } else

    die;
?></body>
