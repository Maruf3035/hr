<?php
require_once("vendor/autoload.php");
if (!(isset($_SESSION['user_email']))) {
    \App\Utility\Utility::redirect('login.php');
    require_once('resource/header.php');
}

use App\Attendance\Attendance;
use App\Hr\Hr;
use App\Leave\Leave;

$object_attendance = new Attendance();
$object_hr = new Hr();
$departmentData = $object_hr->departmentData();
$attendanceData = $object_attendance->attendanceData();
$employeeData = $object_attendance->attendanceData();//include "request_checker.php";
?>
<body><h4 style="text-align: center;color: darkblue">Attendance Management</h4>
<form action="" method="get" class="form-control">
    <div class="container-fluid">
	   <div class="row">
		  <div class="col-md-2 ">
			 <label for="datepicker">User ID</label> <input type="text" name="user_id"
												   class="form-control">
		  </div>
		  <div class="col-md-2 mb-3">
			 <form action="" method="get" class="form-control">
                    <?php if (isset($_REQUEST['date_attendance'])) { ?>
				    <label for="datepicker2">Date From</label>
				    <input type="text" id="datepicker2" name="date_attendance"
						 value="<?php echo $_REQUEST['date_attendance']; ?>"
						 class="form-control">
                    <?php } else { ?>
				    <label for="datepicker">Date From</label>
				    <input type="text" id="datepicker" name="date_attendance"
						 value="<?php echo date("m/d/Y") ?>"
						 class="form-control">
                    <?php } ?>
		  </div>
		  <div class="col-md-2 mb-3">
			 <form action="" method="get" class="form-control">
				<label for="datepicker3">Date To</label> <input type="text" id="datepicker3"
													   name="date_attendance_to" class="form-control">
		  </div>
		  <div class="col-md-2 ">
			 <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Department</label> <select
				    name="department_id" class="form-control">
				<option value="">Select Department</option>
				<option value="0">ALL</option>
                    <?php
                    foreach ($departmentData as $onedata) {
                        $selected = ($onedata->id == $_REQUEST['department_id']) ? "selected='selected'" : "";
                        echo " <option value='$onedata->id' $selected>$onedata->department</option>";
                    }
                    ?>
			 </select>
		  </div>
		  <div class="col-md-2 ">
			 <label for="overtime">Over Time</label> <input type="text" id="overtime" name="over_time"
												   class="form-control">
		  </div>
		  <div class="col-md-1">
			 <button style="margin-top: 32px;" class="btn btn-info" value="submit" type="submit">GO</button>
</form>
</div></div></div></div><?php
include "get_checker.php";
if (isset($deptdata)) { ?>
    <div class="container-fluid">
	   <div class="row">
		  <div class="col-md-12">
			 <div class="style" style="background-color: #006600;height: 50px;
			 padding: 10px;
			 border-radius: 10px;color: white;">
				Employee Attendance
			 </div>
			 <form action="create_process_attendance.php" method="POST">
				<table class="table  table-bordered">
				    <thead>
				    <tr>
					   <th>User ID</th>
					   <th>Date</th>
					   <th>In Time</th>
					   <th>Out Time</th>
					   <th>Over Time</th>
					   <th>Status</th>
				    </tr>
				    </thead>
				    <tbody>
                        <?php
                        foreach ($deptdata

                        as $value) {
                        ?>
				    <tr>
					   <td><input type='text' style="width:120px;height: 40px; text-align: center" name='user_id[]'
							    value=<?php echo $value->user_id; ?>></td>
					   <td><input type='text' style="width:200px;height: 40px; text-align: center"
							    name='employee_date[]'
							    value= <?php if (isset($value->date)) {
                                    echo $value->date;
                                } else {
                                    echo $value = $_REQUEST['date_attendance'];
                                } ?>></td>
					   <td><input type='text' style="width:200px;height: 40px; text-align: center" name='in_time[]'
							    pattern="([01]?[0-9]|2[0-4]).[0-5][0-9]"
							    placeholder="24 Hour Format EX.13.30 "
							    value= <?php if (isset($value->intime)) {
                                    echo $value->intime;
                                } ?>></td>
					   <td><input type='text' style="width:200px;height: 40px; text-align: center"
							    name='out_time[]' pattern="([01]?[0-9]|2[0-4]).[0-5][0-9]"
							    placeholder="24 Hour Format EX.13.30"
							    value= <?php if (isset($value->outtime)) {
                                    echo $value->outtime;
                                } ?>></td>
					   <td><input type='text' style="width:120px;height: 40px; text-align: center"
							    name='over_time[]' disabled placeholder="Hour"
							    value= <?php if (isset($value->overtime) && ($value->outtime)
                                    && ($value->status != 'Friday') && ($value->status != 'Absent')) {
                                    echo ($value->overtime) . 'Hour';
                                } ?>></td>
					   <td><input type="text" style="width:120px;height: 40px; text-align: center" name="status[]"
							    disabled value=<?php if (isset($value->status)) {
                                    echo $value->status;
                                } ?>></td>
					   <td>                  <?php } ?>
				    </tbody>
				</table>
                    <?php if (isset($value->intime)) { ?>
				    <button type="submit" class="btn btn-primary btn-lg " value="update" name="update">Update
				    </button>
                    <?php } else { ?>
				    <button type="submit" class="btn btn-primary btn-lg " value="submit" name="submit">Submit
				    </button>                    <?php } ?>        </form>
		  </div>
	   </div>
    </div>
<?php }
?></body>
