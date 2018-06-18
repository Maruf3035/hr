<?php
if (!isset($_SESSION)) session_start();
require_once("vendor/autoload.php");
if (!(isset($_SESSION['user_email']))) {
    \App\Utility\Utility::redirect('login.php');
}
//include_once "../vendor/phpclasses/php-crud-mysql/crudClass.php";
require_once("vendor/phpclasses/php-crud-mysql/crudClass.php");
require_once ('resource/header.php');
$dept = new crudClass('shift', 'shift,in_time,out_time,grace_time');

$con = $dept->db_con("localhost", "root", "", "hr");

if (isset($_POST['submit'])) {
    $create_sql = $dept->create();//Fetch INSERT query
    mysqli_query($con, $create_sql);
}
if (isset($_POST['update'])) {
    $update_sql = $dept->update($_POST['id']);//Fetch UPDATE query
    mysqli_query($con, $update_sql);
}
if (isset($_POST['delete'])) {
    $delete_sql = $dept->delete($_POST['id']);//Fetch DELETE query
    mysqli_query($con, $delete_sql);
}

?>

<body>
<div class="container-fluid">
    <div class="row">
	   <div class="col-md-4 offset-md-4 col-sm-6 col-xs-12 ">
		  <div class="myform">
			 <h2 style="padding-bottom: 20px;">Shift Entry Form</h2>

                <?php echo $dept->create_form();

                echo $dept->renderVertically();//READ and SHOW data

                if (isset($_POST['edit'])) {
                    echo '<hr>';
                    echo $dept->renderEditor($_POST['id']);//Prepare data edit form
                }
                ?>
		  </div>
	   </div>
    </div>
</div>
</body>
</html>

<!---->
<!--<body>-->
<!--<div class="bootstrap-iso">-->
<!--  <div class="container-fluid">-->
<!--    <div class="row">-->
<!--      <div class="col-md-4 offset-md-4 col-sm-6 col-xs-12 ">-->
<!--        <div class="myform">-->
<!--          <h2 style="padding-bottom: 20px;">Shift Entry Form</h2>-->
<!--          <form method="post" action="create_process_shift.php">-->
<!--            <div class="form-group">-->
<!--              <label for="shift_name">Shift Name</label>-->
<!--              <input type="text" class="form-control" id="shift_name"  name="shift_name" placeholder="Enter Shift Name" required>-->
<!--            </div>-->
<!---->
<!--            <div class="form-group">-->
<!--              <label for="intime">In Time</label>-->
<!--              <input type="text" class="form-control" pattern="([01]?[0-9]|2[0-4]).[0-5][0-9]" id="intime" placeholder="24 Hour Format Ex.18.30" name="intime" required-->
<!--                     placeholder="Enter Intime">-->
<!--            </div>-->
<!--            <div class="form-group">-->
<!--              <label for="text">Out Time</label>-->
<!--              <input type="text" class="form-control" id="outtime" pattern="([01]?[0-9]|2[0-4]).[0-5][0-9]" name="outtime" placeholder="24 Hour Format Ex.18.30" required>-->
<!--            </div>-->
<!--            <div class="form-group">-->
<!--              <label for="graceTime">Grace Time</label>-->
<!--              <input type="text"  class="form-control" id="gracetime"  pattern="([01]?).[0-5][0-9]" name="gracetime" placeholder="Ex.0.15" required>-->
<!--            </div>-->
<!--            <div class="form-group">-->
<!--              <div>-->
<!--                <button class="btn btn-primary " name="submit" type="submit">-->
<!--                  Submit-->
<!--                </button>-->
<!--                <button class="btn btn-warning "  type="reset"  value="reset">-->
<!--                  Reset-->
<!--                </button>-->
<!--              </div>-->
<!--            </div>-->
<!--          </form>-->
<!---->
<!--        </div>-->
<!--      </div>-->
<!--    </div>-->
<!--  </div>-->
<!---->
<!---->
<!---->
<!---->
<!--  <script>-->
<!---->
<!--      $('#basicExample').timepicker();-->
<!--  </script>-->
<!--</body>-->
<!--</html>-->