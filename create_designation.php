<?php
if (!isset($_SESSION)) session_start();
require_once("vendor/autoload.php");
if (!(isset($_SESSION['user_email']))) {
    \App\Utility\Utility::redirect('login.php');
}
require_once("vendor/phpclasses/php-crud-mysql/crudClass.php");
require_once ('resource/header.php');

$dept = new crudClass('designation', 'designation');

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
<div class="bootstrap-iso">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-4 offset-md-4 col-sm-6 col-xs-12 ">
        <div class="myform">
          <h2 style="padding-bottom: 20px;">Designation Entry Form</h2>

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