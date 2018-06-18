<?php 
if (!isset($_SESSION)) session_start();

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

$official_info = $object_hr->officialInfo();
if (isset($_REQUEST['date1'])) {
    $date1 = $_REQUEST['date1'];
    $date2 = $_REQUEST['date2'];
//    $allData = $object->lateReport($date);
}

?>
<!DOCTYPE HTML PUBLIC"-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Document</title></head>
<body>
<form action="" method="get">
    <div class="container-fluid"><h3 style="text-align: center">Isratt Technologies</h3><h4 style="text-align: center">
		  Monthly Report</h4>
	   <br></div>
    <div class="date" style="text-align: center">
	   <label for="datepicker">Date From</label> <input type="text" id="datepicker" name="date1"
											  value="<?php if (isset($_REQUEST['date1'])) {
                                                             echo $_REQUEST['date1'];
                                                         } ?>"> <label for="datepicker2">Date To</label> <input
			 type="text" id="datepicker2" name="date2"
			 value="<?php if (isset($_REQUEST['date2'])) {
                    echo $_REQUEST['date2'];
                } ?>">
	   <button class="btn btn-info" value="submit" type="submit">GO</button>
    </div>
</form>
<table class="table  table-condensed table-bordered ">
    <thead>
    <tr>
	   <th scope="col">Sl.No</th>
	   <th scope="col">Date</th>
	   <th scope="col">Employee ID</th>
	   <th scope="col">Present</th>
	   <th scope="col">Absent</th>
	   <th scope="col">Late</th>
    </tr>
    </thead>
    <tbody>
    <?php if ((isset($official_info))) {
    $srl = 1;
    foreach ($official_info

    as $oneData) { ?>
    <tr>
	   <td>
            <?php echo $srl; ?>
	   </td>
	   <td> <?php if ((isset($date1)) and isset($date2)) echo $_REQUEST['date1'] . "   to    " . $_REQUEST['date2']; ?> </td>
	   <td><?php echo $oneData->user_id; ?></td>

	    <td>
            <?php if ((isset($date1)) and isset($date2)){
            $var = $object_attendance->totalPresentId($date1, $date2, $oneData->user_id);
            foreach ($var as $data) {
                echo $data->total_present;
            } ?>
	   </td>

	   <td>
            <?php $var = $object_attendance->totalAbsentId($date1, $date2, $oneData->user_id);
            foreach ($var as $data) {
                echo $data->total_absent;
            } ?>
	   </td>
	   <td>
            <?php $var = $object_attendance->totalLateId($date1, $date2, $oneData->user_id);
            foreach ($var as $data) {
                echo $data->total_late;
            } ?>
	   </td>

        <?php $srl++;
        }
        } ?>
    </tbody>
</table>
<?php if (isset($_REQUEST['date1'])) {
//    $date1 = "'" . $_REQUEST['date1'] . "'";
//    $date1 = "'" . $_REQUEST['date1'] . "'";
//    ?>

    <a href="monthly_report_pdf.php?date1=<?php echo $_REQUEST['date1'];?>&& date2=<?php echo $_REQUEST['date2']  ?>" class='btn btn-success'>Download
																							  Report</a>
<?php }
} ?>
</body>
</html>