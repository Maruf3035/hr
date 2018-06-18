<?php
/**
 * Created by PhpStorm.
 * User: IsrattsTech
 * Date: 1/29/2018
 * Time: 6:38 PM
 */
if(isset($_GET['user_id'])){
$u_id = $_GET['user_id'];
$d_from = $_GET['date_attendance'];
$d_to = $_GET['date_attendance_to'];
$dept = $_GET['department_id'];
$ot = $_GET['over_time'];
$no_of_param = 0;
$where_param = "WHERE ";
if($u_id != null || $u_id != ''){
    $where_param .= "user_id = "."'".$u_id."'";
    $no_of_param++;
}

$d_from = ($d_from == null || $d_from == "")? "01/01/2018": $d_from;
$d_to = ($d_to == null || $d_to == "")? date("m/d/Y"): $d_to;

$where_param .= ($no_of_param > 0)? " AND ":"";
$where_param .= " date BETWEEN '$d_from' and '$d_to' ";
$no_of_param++;

$ot_first_char = (strlen($ot) > 1)?$ot[0]:"";
if($ot != null || $ot != '') {
    $where_param .= ($no_of_param > 0) ? " AND " : "";
    if ($ot_first_char == ">" || $ot_first_char == "<") {
        $where_param .= " overtime " . $ot;
    } else {
        $where_param .= " overtime =" . $ot;
    }
}

if($dept != null || $dept != ''){
    $where_param .= ($no_of_param > 0) ? " AND " : "";
    if($dept == 0)
        $where_param .= "user_id IN (SELECT user_id FROM official_info)";
    else
        $where_param .= "user_id IN (SELECT user_id FROM official_info WHERE department_id=$dept)";
}
    //echo "SELECT * FROM attendance ".$where_param;die;
    $deptdata = $object_attendance->dataFilter($where_param);
if(empty($deptdata)){
    $deptdata = $object_hr->officialInfo();
}

}