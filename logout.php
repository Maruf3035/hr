<?php
require_once("vendor/autoload.php");

use App\User\User;
use App\Utility\Utility;
use App\Message\Message;

session_destroy();
session_start();
Utility::redirect('login.php');
Message::message(" Successfuly Log out!<br>");