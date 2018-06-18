<?php
if (!isset($_SESSION)) session_start();

if (!isset($_SESSION)) session_start();
require_once("vendor/autoload.php");
if (!(isset($_SESSION['user_email']))) {
    \App\Utility\Utility::redirect('login.php');
}
$object_leave = new \App\Leave\Leave();

$object_leave->setData($_POST);
$object_leave->storeLeaveSetup();


