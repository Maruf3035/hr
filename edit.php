<?php
if (!isset($_SESSION)) session_start();
require_once("vendor/autoload.php");
if (!(isset($_SESSION['user_email']))) {
    \App\Utility\Utility::redirect('login.php');
}

use App\Attendance\Attendance;
use App\Hr\Hr;

$object_attendance = new Attendance();
$object_hr = new Hr();
$object_hr->setData($_GET);
$editabledata = $object_hr->employeeDetails();
$departmentdata = $object_hr->departmentData();
$designationdata = $object_hr->designationData();
$salarydata = $object_hr->salaryData();
$shiftAllData = $object_hr->shiftData();

require_once('resource/header.php');
?>

<body>
<div class="container">

    <div class="row">

	   <div class="col-6">

		  <h4 style="text-align: center">Edit Information</h4>
		  <form action="edit_process.php" method="post" enctype="multipart/form-data">
			 <div class="form-group">
				<label for="name">Name</label> <input type="text" class="form-control" id="name" name="name"
											   value="<?php echo $editabledata->name ?> "
											   placeholder="Enter  Full Name">

			 </div>

			 <input type="hidden" class="form-control" id="user_id" name="user_id"
				   value="<?php echo $editabledata->user_id ?> ">

			 <div class="form-group">
				<label for="name">Fathers Name</label> <input type="text" class="form-control" id="name"
													 name="father_name"
													 value="<?php echo $editabledata->father_name ?> "
													 placeholder="Enter  Full Name">

			 </div>
			 <div class="form-group">
				<label for="name">Mothers Name</label> <input type="text" class="form-control" id="name"
													 name="mother_name"
													 value="<?php echo $editabledata->mother_name ?> "
													 placeholder="Enter  Full Name">
			 </div>
			 <div class="form-group">
				<label for="datepicker4">Birthdate</label> <input type="text" class="form-control" id="datepicker4"
														name="birth_date"
														value="<?php echo $editabledata->birth_date ?> ">
			 </div>
			 <div class="form-check form-check-inline">Gender <input class="form-check-input" type="radio"

														  name="gender"
                                                                        <?php if ($editabledata->gender == "male") { ?>checked <?php } ?>
														  id="inlineRadio1" value="male "> <label
					   class="form-check-label"
					   for="inlineRadio1">Male</label>
			 </div>
			 <div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="female"
                           <?php if ($editabledata->gender == "female") { ?>checked <?php } ?>> <label
					   class="form-check-label" for="inlineRadio2">Female</label>
			 </div>
			 <div class="form-group">
				<label for="phone">Phone Number</label> <input type="text" class="form-control" id="phone"
													  name="phone_number"
													  value="<?php echo $editabledata->phone_number ?> "
													  placeholder="Enter Phone Number">
			 </div>
			 <div class="form-group">
				<label for="present_address">Present Address</label> <textarea class="form-control"
																   id="present_address"
																   name="present_address"
																   rows="3"><?php echo $editabledata->present_address; ?></textarea>
			 </div>
			 <div class="form-group">
				<label for="permanet_address">Permanent Address</label> <textarea class="form-control"

																	 id="permanent_address"
																	 name="permanent_address"
																	 rows="3"> <?php echo $editabledata->permanent_address; ?>  </textarea>
			 </div>
	   </div>
	   <div class="col-6">
		  <h4 style="text-align: center">Official Information</h4>
		  <div class="form-group">
			 <label for="nid">National Id</label> <input type="text" class="form-control" id="nid" name="national_id"
												value="<?php echo $editabledata->national_id ?> "
												placeholder="Enter National Id Number">
		  </div>
		  <div class="form-group">
			 <label for="datepicker5">Enter Joining Date</label> <input type="text" class="form-control"
															id="datepicker5" name="joining_date"
															value="<?php echo $editabledata->joining_date; ?> "
															placeholder="Enter Joining Date ">

		  </div>
		  <div class="form-group">

			 <label for="department">Department</label> <select name="department_id" class="form-control"
													  id="department">
                    <?php

                    foreach ($departmentdata as $onedata) {
                        $dep = $editabledata->department_id;

                        $selected = ($onedata->id == $dep) ? "selected='selected'" : "";

                        echo " <option value='$onedata->id' $selected>$onedata->department</option>";

                    }
                    ?>
			 </select>
		  </div>
		  <div class="form-group">
			 <label for="designation">Designation</label> <select name="designation_id" class="form-control"
													    id="designation">
                    <?php
                    foreach ($designationdata as $singledata) {

                        $des = $editabledata->designation_id;

                        $selected = ($singledata->id == $des) ? "selected='selected'" : "";


                        echo " <option value=$singledata->id $selected> $singledata->designation</option>";

                    }
                    ?>
			 </select>
		  </div>

		  <div class="form-group">
			 <label for="salary">Salary</label> <input type="text" class="form-control" id="salary" required
											   name="salary"
											   placeholder="Enter the Salary"
											   value="<?php echo $editabledata->salary_emp ?>">
		  </div>
		  <div class="form-group">
			 <label for="shift">Shift</label> <select name="shift_id" class="form-control" id="shift">
                    <?php
                    foreach ($shiftAllData as $data) {

                        $sh = $editabledata->shift_id;

                        $selected = ($data->id == $sh) ? "selected='selected'" : "";

                        echo " <option value='$data->id' $selected>$data->shift</option>";

                    }
                    ?>
			 </select>
		  </div>
		  <div class="form-group">
			 <label for="grade">Grade</label> <input type="text" class="form-control" id="grade" name="grade"
											 placeholder="Enter Grade"
											 value="<?php echo $editabledata->grade; ?>">
		  </div>


		  <div class="form-group">
			Change the Photo:
			 <input class="form-control" type="file" name="photo" value=" "><br>
			 <img src="resource/images/<?php echo $editabledata->photo; ?>" style='align-content: center; width: 100px; height:100px'>

			 <br> <input type="hidden" name="prev_photo" value="<?php   echo $editabledata->photo; ?>">
		  </div>

	   </div>
    </div>
    <button type="submit" class="btn btn-primary btn-lg btn-block">Update</button>
    </form>
</div>
</body>

