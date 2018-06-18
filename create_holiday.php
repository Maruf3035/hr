<?php
if (!isset($_SESSION)) session_start();
require_once("vendor/autoload.php");
if (!(isset($_SESSION['user_email']))) {
    \App\Utility\Utility::redirect('login.php');
};
//include_once "../vendor/phpclasses/php-crud-mysql/crudClass.php";
require_once("vendor/phpclasses/php-crud-mysql/crudClass.php");
require_once ('resource/header.php');
$dept = new crudClass('holiday', 'holiday_date,holiday_name');

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
			 <h2 style="padding-bottom: 20px;">Holiday Entry Form</h2>

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

















<?php
//require_once('resource/header.php');
//?>
<!--<body>-->
<!--<div class="container">-->
<!--    <div class="row">-->
<!--	   <div class="col-md-8 offset-md-2">-->
<!--		  <form method="POST" action="create_process_holiday.php">-->
<!--			 <div class="form-group">-->
<!--				<h2 style="text-align: center">Create Holiday Form</h2>-->
<!--				<label for="datepicker6">Holiday Date</label>-->
<!--				<input type="text" name="holiday_date" class="form-control" id="datepicker6" aria-describedby="emailHelp" required placeholder="Enter date">-->
<!--			 </div>-->
<!--			 <div class="form-group">-->
<!--				<label for="holiday">Name of the Holiday</label>-->
<!--				<input type="text" class="form-control" name="holiday_name" id="holiday" required placeholder="Holiday Name">-->
<!--			 </div>-->
<!---->
<!--			 <button type="submit" class="btn btn-primary" value="submit">Submit</button>-->
<!--		  </form>-->
<!--	   </div>-->
<!--    </div>-->
<!--</div>-->
<!--</body>-->