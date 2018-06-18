<?php
if (!isset($_SESSION)) session_start();
require_once("vendor/autoload.php");
if (!(isset($_SESSION['user_email']))) {
    \App\Utility\Utility::redirect('login.php');
}
require_once ('resource/header.php');

use App\Attendance\Attendance;
use App\Hr\Hr;


$object_hr = new Hr();
$object_attendance = new Attendance();

$object_hr->setData($_GET);
$singlefield = $object_hr->employeeDetails();

$departmentDataByIdObject = $object_hr->departmentDataById($singlefield->department_id);
$designationDataByIdObject = $object_hr->designationDataById($singlefield->designation_id);
$shiftDataByIdObject = $object_hr->shiftDataById($singlefield->shift_id);


?>

<body>
<div class="container">
  <div class="row">
    <div class="col-md-10 offset-md-1">

      <h4 style="text-align: center">Personal Information of <?php echo $singlefield->name; ?></h4>
      <table class="table table-sm">

        <thead>
        <tr>
          <th scope="col">Profile Picture</th>
          <th scope="col">User ID</th>
          <th scope="col">Employee Name</th>
          <th scope="col">Father Name</th>
          <th scope="col">Mother Name</th>
          <th scope="col">Birth Date</th>
          <th scope="col">Gender</th>
          <th scope="col">Phone Number</th>
          <th scope="col">present Address</th>
          <th scope="col">permanent Address</th>

        </tr>
        </thead>
        <tbody>
        <?php
        echo "
        <tr>
          <td><img src='resource/images/$singlefield->photo' class='rounded-circle' style='align-content: center; width: 100px; height:100px'></td>
          <td>$singlefield->user_id</td>
          <td>$singlefield->name</td>
          <td>$singlefield->father_name</td>
          <td>$singlefield->mother_name</td>
          <td>$singlefield->birth_date</td>
          <td>$singlefield->gender</td>
          <td>$singlefield->phone_number</td>
          <td>$singlefield->present_address</td>
          <td>$singlefield->permanent_address</td>
        </tr>
   ";
        ?>
        </tbody>
      </table>
    </div>

  </div>
  <div class="row">
    <div class="col-md-10 offset-md-1">
      <h4 style="text-align: center">Official Information of <?php echo $singlefield->name; ?></h4>
      <table class="table table-sm">

        <thead>
        <tr>

          <th scope="col">User ID</th>
          <th scope="col">National ID</th>
          <th scope="col">Joining Date</th>
          <th scope="col">grade</th>

          <th scope="col">department</th>
          <th scope="col">designation</th>

          <th scope="col">shift</th>

        </tr>
        </thead>
        <tbody>
        <?php
        echo "
        <tr>
          
          <td>$singlefield->user_id</td>
          <td>$singlefield->national_id</td>
          <td>$singlefield->joining_date</td>
          <td>$singlefield->grade</td>
        
          <td>$departmentDataByIdObject->department</td>
          <td>$designationDataByIdObject->designation</td>
          
          <td>$shiftDataByIdObject->shift</td>
          
        </tr>
   ";

        ?>

        </tbody>
      </table>

    </div>


  </div>
  <a href="edit.php?user_id=<?php echo $singlefield->user_id;?>" class="btn btn-info" >Edit</a>
</div>
</body>
</html>


