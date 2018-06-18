<?php
if (!isset($_SESSION)) session_start();
require_once("vendor/autoload.php");
if (!(isset($_SESSION['user_email']))) {
    \App\Utility\Utility::redirect('login.php');
}

use App\Attendance\Attendance;
use App\Hr\Hr;

$object = new Attendance();

//$var=$object->setData('$_GET');

$var = $_GET['user_id'];
$alldata = $object->attendanceView($var);

?>

<body>

<div class="container">
    <?php require_once('resource/header.php'); ?>
  <div class="row">
    <div class="col-md-8 offset-md-2">

      <h4 style="text-align: center">Attendance list </h4>
      <table class="table table-sm">

        <thead>
        <tr>
          <th scope="col">User ID</th>
          <th scope="col">Date</th>
          <th scope="col">In Time</th>
          <th scope="col">Out Time</th>
          <th scope="col">Over Time</th>

          <th scope="col">Status</th>
        </tr>
        </thead>
        <tbody>
        <?php

        foreach ($alldata as $singledata) {
            echo "
        <tr>
          <td >$singledata->user_id </td>
          <td> $singledata->date </td>
          <td>  $singledata->intime </td>
          <td> $singledata->outtime </td>
          <td> $singledata->overtime </td>
          <td> $singledata->status </td>
        </tr>
        ";
        } ?>
        </tbody>
      </table>

    </div>

  </div>
</div>
</body>
</html>


