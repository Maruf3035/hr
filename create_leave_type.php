
<?php
if (!isset($_SESSION)) session_start();
require_once("vendor/autoload.php");
if (!(isset($_SESSION['user_email']))) {
    \App\Utility\Utility::redirect('login.php');
}
//include_once "../vendor/phpclasses/php-crud-mysql/crudClass.php";
require_once("vendor/phpclasses/php-crud-mysql/crudClass.php");
require_once ('resource/header.php');
$dept = new crudClass('leave_type', 'leave_type,leave_type_day');

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


<?php
//require_once('resource/header.php');
//?>
<!--<body>-->
<!--<div class="container">-->
<!--    <div class="row">-->
<!--	   <div class="col-md-8 offset-md-2">-->
<!--		  <div class="form-group">-->
<!--			 <h2 style="text-align: center">Create Leave Type</h2>-->
<!--			 <form method="POST" action="leave_setup_process.php">-->
<!--				<div class="form-group">-->
<!--				    <label for="leave_type">Leave Type</label> <input type="text" class="form-control" name="leave_type"-->
<!--													   id="leave_type" required placeholder="Enter Leave Type">-->
<!--				</div>-->
<!---->
<!--				<label for="days">Days</label> <input type="text" name="leave_type_days"-->
<!--														   class="form-control" id="days"-->
<!--														   aria-describedby="emailHelp" required-->
<!--														   placeholder="Enter Days">-->
<!--		  </div>-->
<!---->
<!--		  <button type="submit" class="btn btn-primary" value="submit">Submit</button>-->
<!--		  </form>-->
<!--	   </div>-->
<!--    </div>-->
<!--</div>-->
<!--</body>-->