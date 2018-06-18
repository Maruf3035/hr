<?php
if (!isset($_SESSION)) session_start();
require_once("vendor/autoload.php");
if (!(isset($_SESSION['user_email']))) {
    \App\Utility\Utility::redirect('login.php');
}
$object_leave = new \App\Leave\Leave();
$object_attendance = new \App\Attendance\Attendance();

if ((isset($_REQUEST['user_id'])) and (isset($_REQUEST['leave_type_id']))) {

    $date1 = $_REQUEST['from_date'];
    $date2 = $_REQUEST['to_date'];

//    if ($_REQUEST['remaining_days'] == 0) {
//
//        header('Location: http://localhost/hr/view/employee_leave_entry.php');
//        die;
//    }


    $range = $object_leave->createDateRange($date1, $date2);
    $check_range = count($range);

    if (($check_range) <= ($_REQUEST['available_days'])) {

        $date_range = $object_leave->createDateRange($date1, $date2);

//        for ($i = 0; $i < count($date_range); $i++) {
//            $single_date = $date_range[$i];
//            $weekend = $object_attendance->isWeekend($single_date);
//            $holiday = $object_attendance->isExistHoliday($single_date);
//
//            if (($weekend == True)) {
//                unset($date_range[$i]);
//                }
//            }


        $total_leave_day = count($date_range) + 1;

        $_REQUEST['days'] = $total_leave_day;
        $_REQUEST['available_days'] = $_REQUEST['available_days'] - $_REQUEST['days'];
        $_REQUEST['remaining_days'] = $_REQUEST['available_days'];
        $var .= implode(',', $date_range);
        $_REQUEST['from_date'] = $var;
        $lastdate = "," . $_REQUEST['to_date'];
        //
        $_REQUEST['from_date'] .= $lastdate;
        $test=explode(',',$_REQUEST['from_date']);

        for ($i = 0; $i < count($test)+1; $i++) {
            $single_date = $test[$i];
            $weekend = $object_attendance->isWeekend($single_date);
            $holiday = $object_attendance->isExistHoliday($single_date);

            if (($weekend or $holiday) ==True) {
                unset($test[$i]);
            }
        }
    //    print_r($test);
        //
        $alldatestring=implode(',',$test);
            $_REQUEST['from_date']=$alldatestring;

        $object_leave->setData($_REQUEST);
        $object_leave->storeEmployeeLeave();
    } else {
        \App\Message\Message::message('Leave day not available.Enter leave day within available leave days');
        \App\Utility\Utility::redirect('employee_leave_entry.php');
    }


}

