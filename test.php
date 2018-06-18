<?php
if (!isset($_SESSION)) session_start();
require_once("vendor/autoload.php");
if (!(isset($_SESSION['user_email']))) {
    \App\Utility\Utility::redirect('login.php');
}
use App\Hr\Hr;
use App\Attendance\Attendance;
$object_attendance=new Attendance();

if (isset($_REQUEST['month'])){
    $var=$_REQUEST['month'];
    echo $var;

}