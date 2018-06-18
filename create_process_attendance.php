<?php
if (!isset($_SESSION)) session_start();
require_once("vendor/autoload.php");
if (!(isset($_SESSION['user_email']))) {
    \App\Utility\Utility::redirect('login.php');
}
$object_hr = new \App\HR\Hr();
$object_attendance = new \App\Attendance\Attendance();


if (isset($_REQUEST['submit'])) {

    $user_id = $_REQUEST['user_id'];
    $employee_date = $_REQUEST['employee_date'];
    $intime = $_REQUEST['in_time'];
    $outtime = $_REQUEST['out_time'];
    // $overtime = $_REQUEST['over_time'];
    //$status = $_REQUEST['status'];

    foreach ($user_id as $k => $v) {
        $_POST['user_id'] = $v;
        $_POST['employee_date'] = $employee_date[$k];
        $_POST['in_time'] = $intime[$k];
        $_POST['out_time'] = $outtime[$k];
        //  $_POST['over_time'] = $overtime[$k];

        $currentDate = $_POST['employee_date'];
        /*code block for set status*/
        $dateCheck = $object_attendance->isWeekend($currentDate);
        $holidayCheck = $object_attendance->isExistHoliday($currentDate);
        $leave_data = $object_attendance->checkLeave($v, $currentDate);
        $data = $object_hr->checkShift($v);

        $fixedTime = $data->in_time;
        $outTime = $data->out_time;
        $graceTime = $data->grace_time;
        $currentTime = $_POST['in_time'];

        if ($leave_data == True) {

            $_POST['status'] = 'Leave';
            $_POST['in_time'] = '';
            $_POST['out_time'] = '';
            $_POST['late'] = '';


        } elseif ($dateCheck == True) {
            $_POST['status'] = 'Friday';
            $_POST['in_time'] = '';
            $_POST['out_time'] = '';
        } elseif ($holidayCheck == True) {
            $_POST['status'] = 'Holiday';
            $_POST['in_time'] = '';
            $_POST['out_time'] = '';
            $_POST['late'] = '';
        } elseif (($_POST['in_time']) == NULL) {
            echo $_POST['status'] = 'Absent';
        } elseif ((($fixedTime) + ($graceTime)) > ($currentTime)) {
            $_POST['status'] = 'Present';
        } elseif (($currentTime) >= ($fixedTime)) {
            $_POST['status'] = 'Late';
            $lateTime = (($_POST['in_time']) - ($fixedTime));
            $_POST['late'] = $lateTime;
        }


        /*code block for set overtime*/
        $currentOutTime = 0;
        $fixedOutTime = 0;
        $data = $object_hr->checkShift($v);
        $fixedOutTime = $data->out_time;
        $currentOutTime = $_POST['out_time'];
        if ($currentOutTime == null) {
            $_POST['over_time'] = '';

        } else {
            $overTime = (($currentOutTime) - ($fixedOutTime)) / 60 * 60;
            $_POST['over_time'] = $overTime;
        }
        $object_attendance->setData($_POST);
        $object_attendance->storeAttendance();
    }
}

/*code block for requsting update*/

if (isset($_REQUEST['update'])) {
    $user_id = $_REQUEST['user_id'];
    $employee_date = $_REQUEST['employee_date'];
    $intime = $_REQUEST['in_time'];
    $outtime = $_REQUEST['out_time'];
    // $overtime = $_REQUEST['over_time'];
    //$status = $_REQUEST['status'];

    foreach ($user_id as $k => $v) {
        $_POST['user_id'] = $v;
        $_POST['employee_date'] = $employee_date[$k];
        $_POST['in_time'] = $intime[$k];
        $_POST['out_time'] = $outtime[$k];

        $currentDate = $_POST['employee_date'];
        /*code block for set status*/
        $dateCheck = $object_attendance->isWeekend($currentDate);
        $data = $object_hr->checkShift($v);
        $fixedTime = $data->in_time;
        $graceTime = $data->grace_time;
        $holidayCheck = $object_attendance->isExistHoliday($currentDate);

        $lateTime = (($_POST['in_time']) - (($fixedTime)));
        $currentTime = $_POST['in_time'];
        $leave_data = $object_attendance->checkLeave($_POST['user_id'], $currentDate);

        if ($leave_data == True) {

                $_POST['status'] = 'Leave';
                $_POST['in_time'] = '';
                $_POST['out_time'] = '';
                $_POST['late'] = '';

        } elseif ($dateCheck == 5) {
            $_POST['status'] = 'Friday';
            $_POST['in_time'] = '';
            $_POST['out_time'] = '';
            $_POST['late'] = '';
        } elseif ($holidayCheck == True) {
            $_POST['status'] = 'Holiday';
            $_POST['in_time'] = '';
            $_POST['out_time'] = '';
            $_POST['late'] = '';
        } elseif (($_POST['in_time']) == NULL) {
            $_POST['status'] = 'Absent';
        } elseif ((($fixedTime) + ($graceTime)) > ($currentTime)) {
            $_POST['status'] = 'Present';
        } elseif (($currentTime) >= ($fixedTime)) {
            $_POST['status'] = 'Late';
            $lateTime = (($_POST['in_time']) - ($fixedTime));
            $_POST['late'] = $lateTime;
        }

        $data = $object_hr->checkShift($v);
        $fixedOutTime = $data->out_time;
        $currentOutTime = $_POST['out_time'];
        if ($currentOutTime == null) {
            $_POST['over_time'] = null;

        } else {
            $overTime = (($currentOutTime) - ($fixedOutTime)) / 60 * 60;
            $_POST['over_time'] = $overTime;

        }


        //end code block of overtime


        $object_attendance->setData($_POST);
        $object_attendance->updateAllAttendance();
    }
}

