<?php
if (!isset($_SESSION)) session_start();
require_once("vendor/autoload.php");
if (!(isset($_SESSION['user_email']))) {
    \App\Utility\Utility::redirect('login.php');
}
$object_attendance = new \App\Attendance\Attendance();
$object_hr = new \App\HR\Hr();

//$status = $object->is_not_exist($_POST['id']);
//if ($status) {
    $object_hr->setData($_POST);
    $object_hr->storeShift();

//} else {
//    \App\Utility\Utility::redirect('create.php');
//}
