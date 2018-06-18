<?php if (!isset($_SESSION)) session_start();

if (!isset($_SESSION)) session_start();
require_once("vendor/autoload.php");
if (!(isset($_SESSION['user_email']))) {
    \App\Utility\Utility::redirect('login.php');
}
require_once('resource/header.php');

use App\Message\Message;
use App\Leave\Leave;

$msg = Message::message();


$object_leave = new Leave();

$leaveTypeData = $object_leave->leaveTypeData();
if ((isset($_GET['user_id']) and ($_GET['leave_type_id']))) {
    if (($_REQUEST['user_id'] != null or '') and ($_REQUEST['leave_type_id'] != '' or null)) {
        $leaveId = $_REQUEST['leave_type_id'];
        $userId = $_REQUEST['user_id'];
        $result = $object_leave->isExistEmployeeLeaveData($userId, $leaveId);
        if ($result == TRUE) {
            $data = $object_leave->employeeLeave($userId, $leaveId);
            $data1 = $object_leave->totaldays($leaveId);
            $available_days = $data1->leave_type_day;
            $days = $data->days;

            $remaining_days = ($available_days) - ($days);
            if ($remaining_days <= 0) {

                App\Message\Message::message('No Leave Available');
                $msg = Message::message();
                echo " <div class='alert-danger '  style='text-align: center;height: 50px;' id='message'> <h3>$msg</h3> </div> ";

                die;


            } elseif ($remaining_days > 0) {
                $remaining_days = ($available_days) - ($days);
                $_REQUEST['rdays'] = $remaining_days;


            }

        } else {

            $a_days = $object_leave->availableDays($_REQUEST['leave_type_id']);
        }
    }
    }

?>
<?php
if (!empty($msg)) {
    echo "<div style='height: 30px; text-align: center'> <div class='alert-success '  style = 'text-align: center;height: 50px;' id = 'message' > <h3 > $msg</h3 > </div ></div >";
} ?>
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

		  <div class="col-md-2 ">
			 <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Leave Type</label> <select
				    name="leave_type_id" class="form-control" required>
				<option value="">Select Leave Type</option>

                    <?php
                    foreach ($leaveTypeData as $data) {
                        //$selected = ($onedata->id == $_REQUEST['department_id']) ? "selected='selected'" : "";
                        echo " <option value='$data->id' $selected>$data->leave_type</option>";
                    }
                    ?>
			 </select>
		  </div>

		  <div class="col-md-1">
			 <button style="margin-top: 32px;" class="btn btn-info" value="submit" type="submit">GO</button>
</form>
</div></div>
<?php if ((isset($_REQUEST['user_id'])) and isset($_REQUEST['leave_type_id']))
{ ?>
    <div class="row">
	   <div class="col-md-12">

		  <form action="employee_entry_leave_process.php" method="POST">

			 <table class="table table-sm table-responsive table-striped">
				<thead>
				<tr>
				    <th>User Id</th>
				    <th>Leave Type</th>
				    <th>Available Days</th>
				    <th>From Date</th>
				    <th>To Date</th>
				    <th>Days</th>
				    <th>Remaining Days</th>
				    <th>Approved By</th>
				</tr>
				</thead>

				<tbody>
                    <?php
                    if ((isset($userId)) and isset($leaveId)) { ?>

				    <td><input type="text" name="user_id" value="<?php echo $_REQUEST['user_id']; ?>"></td>

				    <td>
                            <?php $type = $object_leave->leaveTypeDataById($_REQUEST['leave_type_id']);
                            echo $type->leave_type;
                            ?><input type="hidden" name="leave_type_id" value="<?php

                            echo $_REQUEST['leave_type_id'];

                            ?>"

				    </td>
				    <td><input type="text" name="available_days" value="<?php if (isset($a_days)) {
                                echo $a_days->leave_type_day;
                            }
                            if (isset($_REQUEST['rdays'])) {
                                echo $_REQUEST['rdays'];
                            } ?>">
				    </td>
				    <td><input type="text" id="datepicker_leave1" required name="from_date"></td>
				    <td><input type="text" id="datepicker_leave2" required name="to_date"></td>
				    <td><input type="text" name= value=""></td>
				    <td><input type="text" name="remaining_days" value="<?php if (isset($a_days)) {
                                echo $a_days->leave_type_day;
                            }
                            if (isset($_REQUEST['rdays'])) {
                                echo $_REQUEST['rdays'];
                            } ?>">
				    </td>
				    <td><input type="text" name="approved_by" value="">
				    </td>

				    </tr>

                    <?php } ?>
				</tbody>
			 </table>
			 <button type="submit" class="btn btn-primary btn-lg " value="submit" name="submit">Submit
			 </button>

		  </form>
	   </div>
    </div>
    </div>
<?php } else

    die;
?></body>
