<?php
if (!isset($_SESSION)) session_start();
require_once("vendor/autoload.php");
if (!(isset($_SESSION['user_email']))) {
    \App\Utility\Utility::redirect('login.php');
}
$object_attendance = new \App\Attendance\Attendance();

//var_dump($_REQUEST);
if(($_REQUEST['submit']))  {
    $id = $_REQUEST['id'];
    $employee_date = $_REQUEST['employee_date'];
    $intime = $_REQUEST['in_time'];
    $outtime = $_REQUEST['out_time'];
    $overtime = $_REQUEST['over_time'];
    $late = $_REQUEST['late'];
    $status = $_REQUEST['status'];

    foreach ($id as $k=>$v){

        $_POST['id'] = $v;
        $_POST['employee_date'] = $employee_date[$k];
        $_POST['in_time'] = $intime[$k];
        $_POST['out_time'] = $outtime[$k];
        $_POST['over_time'] = $overtime[$k];
        $_POST['late'] = $late[$k];
        $_POST['status'] = $status[$k];
        $object_attendance->setData($_POST);
        $object_attendance->updateAllAttendance();
    }
}