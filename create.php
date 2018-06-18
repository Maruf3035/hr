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
$departmentdata = $object_hr->departmentData();
$designationdata = $object_hr->designationData();
$salarydata = $object_hr->salaryData();
$shiftAllData = $object_hr->shiftData();
?>

<body>
<div class="container">

    <div class="row">

	   <div class="col-6">

		  <h4 style="text-align: center">Personal Information</h4>
		  <form action="create_process.php" method="post" enctype="multipart/form-data">
			 <div class="form-group">
				<label for="name">Name</label> <input type="text" class="form-control" id="name" name="name"
											   placeholder="Enter  Full Name" required>

			 </div>
			 <div class="form-group">
				<label for="id">UserId</label> <input type="text" class="form-control" id="id" name="user_id"
											   placeholder="Enter ID" required>

			 </div>
			 <div class="form-group">
				<label for="name">Fathers Name</label> <input type="text" class="form-control" id="name"
													 name="father_name"
													 placeholder="Enter  Full Name" required>

			 </div>
			 <div class="form-group">
				<label for="name">Mothers Name</label> <input type="text" class="form-control" id="name"
													 name="mother_name"
													 placeholder="Enter  Full Name" required>
			 </div>
			 <div class="form-group">
				<label for="birthdate">Birthdate</label> <input type="date" class="form-control" required
													   id="birthdate" name="birth_date">
			 </div>
			 <div class="form-check form-check-inline">Gender <input class="form-check-input" type="radio"
														  name="gender" id="inlineRadio1" value="male">
				<label class="form-check-label" for="inlineRadio1">Male</label>
			 </div>
			 <div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="female"> <label
					   class="form-check-label" for="inlineRadio2">Female</label>
			 </div>
			 <div class="form-group">
				<label for="phone">Phone Number</label> <input type="text" class="form-control" id="phone" required
													  name="phone_number"
													  placeholder="Enter Phone Number">
			 </div>
			 <div class="form-group">
				<label for="present_address">Present Address</label> <textarea class="form-control"
																   id="present_address" required
																   name="present_address"
																   rows="3"></textarea>
			 </div>
			 <div class="form-group">
				<label for="permanet_address">Permanent Address</label> <textarea class="form-control"
																	 id="permanent_address" required
																	 name="permanent_address"
																	 rows="3"></textarea>
			 </div>
	   </div>
	   <div class="col-6">
		  <h4 style="text-align: center">Official Information</h4>
		  <div class="form-group">
			 <label for="nid">National Id</label> <input type="text" class="form-control" required id="nid"
												name="national_id"
												placeholder="Enter National Id Number">
		  </div>
		  <div class="form-group">
			 <label for="join">Enter Joining Date</label> <input type="date" class="form-control" id="join" required
													   name="joining_date"
													   placeholder="Enter Joining Date ">

		  </div>
		  <div class="form-group">
			 <label for="department">Department</label> <select name="department_id" class="form-control" required
													  id="department">
                    <?php
                    foreach ($departmentdata as $onedata) {
                        echo " <option value='$onedata->id'>$onedata->department</option>";

                    }
                    ?>
			 </select>
		  </div>
		  <div class="form-group">
			 <label for="designation">Designation</label> <select name="designation_id" class="form-control" required
													    id="department">
                    <?php
                    foreach ($designationdata as $singledata) {
                        echo " <option value='$singledata->id'>$singledata->designation</option>";

                    }
                    ?>
			 </select>
		  </div>

		  <div class="form-group">
			 <label for="salary">Salary</label> <input type="text" class="form-control" id="salary" required
												   name="salary"
												   placeholder="Enter the Salary">
		  </div>
		  <div class="form-group">
			 <label for="shift">Shift</label> <select name="shift_id" class="form-control" required id="shift">
                    <?php
                    foreach ($shiftAllData as $data) {
                        echo " <option value='$data->id'>$data->shift</option>";

                    }
                    ?>
			 </select>
		  </div>
		  <div class="form-group">
			 <label for="grade">Grade</label> <input type="text" class="form-control" id="grade" required
											 name="grade"
											 placeholder="Enter Grade">
		  </div>

		  <div class="form-group">
			 <label for="pic">Upload Profile Picture</label> <input type="file" class="form-control" name="photo"
														 required id="pic">
		  </div>

	   </div>
    </div>
    <button type="submit" class="btn btn-primary btn-lg btn-block">Submit</button>
    <button class="btn btn-warning btn-lg btn-block " type="reset" value="reset">
	   Reset
    </button>
    </form>
</div>
</body>

