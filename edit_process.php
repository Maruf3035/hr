<?php
if (!isset($_SESSION)) session_start();
require_once("vendor/autoload.php");
if (!(isset($_SESSION['user_email']))) {
    \App\Utility\Utility::redirect('login.php');
}

$object_attendance = new \App\Attendance\Attendance();

$object_hr = new \App\HR\Hr();

//echo $_REQUEST['prev_photo'];
//die;
if ((isset($_FILES) )and ($_FILES['photo']['name']) ) {
    $fileName = time() . $_FILES['photo']['name'];//filename with time function
    $_POST['photo'] = $fileName;// set file name for sending link to database

    $source = $_FILES['photo']['tmp_name'];   //set current location
    $destination = "../resource/images/" . $fileName;  //set destination
    move_uploaded_file($source, $destination);
   // echo 555;
  //  die;
}

    else {
        //$_POST = 0;
        //echo 777;

        $_POST['photo'] = $_REQUEST['prev_photo'];
        echo $_POST['photo'];
       // die;
    }


$object_hr->setData($_POST);
$object_hr->updatePersonalInfo();
$object_hr->updateOfficialInfo();


//\App\Utility\Utility::redirect('create.php');

