<?php
if (!isset($_SESSION)) session_start();
require_once("vendor/autoload.php");
if (!(isset($_SESSION['user_email']))) {
    \App\Utility\Utility::redirect('login.php');
}

$object_attendance = new \App\Attendance\Attendance();

if (isset($_REQUEST)) {
    $fileName = time() . $_FILES['photo']['name'];//filename with time function
    $_POST['photo'] = $fileName;// set file name for sending link to database

    $source = $_FILES['photo']['tmp_name'];   //set current location
    $destination = "../resource/images/" . $fileName;  //set destination
    move_uploaded_file($source, $destination);
}

$object_attendance->setData($_POST);
$object_attendance->updateAttendance();



//\App\Utility\Utility::redirect('create.php');

