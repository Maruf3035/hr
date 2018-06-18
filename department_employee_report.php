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
$departmentData = $object_hr->departmentData();


?>

<body>

<div class="container"><h3 style="text-align: center">Isratt Technologies</h3><h4 style="text-align: center">
	   Departmentwise Report</h4>
    <br>
    <form action="" method="get">
	   <div class="row">
		  <div class="col-md-2 ">
			 <label for="dept">Select Department</label> <select
				    name="department_id" class="form-control">
				<option>Department</option>
                    <?php
                    foreach ($departmentData as $onedata) {
                        $selected = ($onedata->id == $_REQUEST['department_id']) ? "selected='selected'" : "";
                        echo " <option value='$onedata->id' $selected>$onedata->department</option>";
                    }
                    ?>
			 </select>
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
			 <button style="margin-top: 32px;" class="btn btn-info" value="submit" type="submit">GO</button>
    </form>
</div>
</div></div>

<table class="table  table-condensed table-bordered ">
    <thead>
    <tr>
	   <th scope="col">Sl.No</th>
	   <th scope="col">Employee ID</th>
	   <th scope="col">Present</th>
	   <th scope="col">Absent</th>
	   <th scope="col">Late</th>
    </tr>
    </thead>
    <tbody>
    <?php if (isset($_REQUEST['department_id']) and ($_REQUEST['date1']) and ($_REQUEST['date2'])) {
    $departmentId = $_REQUEST['department_id'];
    $date1 = $_REQUEST['date1'];
    $date2 = $_REQUEST['date2'];
    $official_info = $object_hr->empDataByDept($departmentId);


    $srl = 1;
    foreach ($official_info as $data) {
        ?>
	   <tr>
		  <td><?php echo $srl; ?></td>
		  
		  <td><?php echo $data->user_id; ?></td>

            <?php $var = $object_attendance->totalPresentId($date1, $date2, $data->user_id); ?>
		  <td><?php foreach ($var as $present) {
                    echo $present->total_present;
                } ?> </td>
            <?php $var = $object_attendance->totalAbsentId($date1, $date2, $data->user_id); ?>
		  <td>
                <?php foreach ($var as $absent) {
                    echo $absent->total_absent;
                } ?>
		  
		  </td>
		  <td>
                <?php $var3 = $object_attendance->totalLateId($date1, $date2, $data->user_id); ?>
                <?php foreach ($var3 as $late) {
                    echo $late->total_late;
                } ?>
		  
		  </td>
	   
	   </tr>

        <?php $srl++;
    } ?>
    
    </tbody>
</table>

<a href="department_employee_report_pdf.php?date1=<?php echo $_REQUEST['date1']; ?>&& date2=<?php echo $_REQUEST['date2'] ?>&& department_id=<?php echo $_REQUEST['department_id'] ?>"
   class='btn btn-success'>Download Report</a>
<?php
} ?>
</body>
</html>