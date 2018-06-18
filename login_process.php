<?php
if (!isset($_SESSION)) session_start();

if (!isset($_SESSION)) session_start();
require_once("vendor/autoload.php");
if (!(isset($_SESSION['user_email']))) {
    \App\Utility\Utility::redirect('login.php');
}

use App\User\User;
use App\Utility\Utility;
use App\Message\Message;
if (isset($_REQUEST)) {
    $object_user = new User();
    $status = $object_user->is_existUser($_REQUEST['user_email'], $_REQUEST['user_password']);

    if ($status) {
        $_SESSION['user_email'] = $_REQUEST['user_email'];
    Utility::redirect('index.php');
    } else {
        Message::message(" Wrong User Email or Password!<br>");
        Utility::redirect('login.php');
    }

}