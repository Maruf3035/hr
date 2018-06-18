<?php
include("crudClass.php");

$con = $crud->db_con('localhost','root','mysql','crud');// Connect Database

$crud = new crudClass('kitchen','instrument,code,type');// Initiate the class with table information

if($_POST['submit']){
    $create_sql = $crud->create();//Fetch INSERT query
    mysqli_query($con,$create_sql);
}
if($_POST['update']){
    $update_sql = $crud->update($_POST['id']);//Fetch UPDATE query
    mysqli_query($con,$update_sql);
}
if($_POST['delete']){
    $delete_sql = $crud->delete($_POST['id']);//Fetch DELETE query
    mysqli_query($con,$delete_sql);
}

echo $crud->create_form();//Prepare data entry form
echo '<hr>';
echo $crud->renderVertically();//READ and SHOW data

if($_POST['edit']){
    echo '<hr>';
    echo $crud->renderEditor($_POST['id']);//Prepare data edit form
}
?>
