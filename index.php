<?php
if (!isset($_SESSION)) session_start();
require_once("vendor/autoload.php");
if (!(isset($_SESSION['user_email']))) {
    \App\Utility\Utility::redirect('login.php');
}
require_once('resource/header.php');

use App\Attendance\Attendance;
use App\Leave\Leave;
use App\Hr\Hr;
use App\Message\Message;
use App\User\User;


$msg = Message::message();

$object_attendance = new Attendance();
$object_hr = new Hr();
$object_leave = new Leave();
$alldata = $object_hr->employeeIndex();

?>

<body>
<div class="container">

    <div class="row">
	   <div class="col - md - 8 offset - md - 2">

		  <h4 style="text-align: center">Employee List</h4>
		  <table class="table table-sm">

                <?php
                if (!empty($msg)) {
                    echo "<div style='height: 30px; text-align: center'> <div class='alert-success '  style = 'text-align: center;height: 50px;' id = 'message' > <h3 > $msg</h3 > </div ></div >";
                } ?>
			 <thead>
			 <tr>
				<th scope="col">User ID</th>
				<th scope="col">Employee Name</th>
				<th scope="col">Employee Details</th>
				<th scope="col">Attendance</th>
			 </tr>
			 </thead>
			 <tbody>

                <?php foreach ($alldata as $singledata) {


                    echo "
		<tr>
          <td > $singledata->user_id</td > 
          <td > $singledata->name</td >
          <td > <a href = 'employee_details.php?user_id=$singledata->user_id' class='btn btn-success' > Details</a ></td >
      <td > <a href = 'view_attendance.php?user_id=$singledata->user_id' class='btn btn-success' > View Attendance </a ></td >
        </tr >
            
        <?php ";
                } ?>
			 </tbody>
		  </table>
	   </div>
    </div>
</div>
</body>



