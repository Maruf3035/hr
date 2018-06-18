<?php

if ((isset($_REQUEST['department_id'])) and ($_REQUEST['date_attendance_to'] == null) and ($_REQUEST['over_time'] == null)
    and ($_REQUEST['id'] == null) and ($_REQUEST['date_attendance'])) {

    if (($_REQUEST['department_id'] != '0') or ($_REQUEST['department_id'] != '00')) {
        $dept_id = $_REQUEST['department_id'];
        $date = "'" . $_REQUEST['date_attendance'] . "'";
        $result = $object->isExistDate($dept_id, $date);
        if ($result == TRUE) {
            $deptdata = $object->attendanceDetails($dept_id, $date);
        } else {
            $deptdata = $object->viewAllEmployeeByDept($dept_id);//form submit
        }

    } elseif (($_REQUEST['department_id'] == '00') or ($_REQUEST['department_id'] == '0')) {
        $date = "'" . $_REQUEST['date_attendance'] . "'";
        $result = $object->isExistDateAll($date);
        if ($result == True) {
            $deptdata = $object->viewAllEmployee($date);
        } else {
            $deptdata = $object->officialInfo();

        }
    }
}

////attendance input form and single view by id
//
elseif ((isset($_REQUEST['id']) and (isset($_REQUEST['date_attendance']))
    and ($_REQUEST['date_attendance_to'] == null) and ($_REQUEST['over_time'] == null) and ($_REQUEST['department_id'] == '00'))) {

    $id = $_REQUEST['id'];
    $date = "'" . $_REQUEST['date_attendance'] . "'";
    $result = $object->isExistDateAll($date);
    if ($result == True) {
        $deptdata = $object->attendanceDetailsById($id, $date);
    } else {
        $deptdata = $object->officialInfoById($id);
    }

}
//
//
////attendance detail by id
////conflict
elseif ((isset($_REQUEST['id']))
    and (($_REQUEST['date_attendance']) == null) and (($_REQUEST['date_attendance_to']) == null)
    and (($_REQUEST['over_time']) == null) and (($_REQUEST['department_id']))) {

    $id = $_REQUEST['id'];
    $deptdata = $object->singleAllAttendance($id);

}


//
////date1 and date2 and deparmentid all data
elseif ((isset($_REQUEST['date_attendance'])) and (isset($_REQUEST['department_id'])) and (isset($_REQUEST['date_attendance_to']))
    and ($_REQUEST['over_time'] == null) and ($_REQUEST['id'] == null) and ($_REQUEST['over_time'] == null)) {
    if (($_REQUEST['department_id'] == 00) or ($_REQUEST['department_id'] == 0)) {
        $date1 = $_REQUEST['date_attendance'];
        $date2 = $_REQUEST['date_attendance_to'];
        $departmentId = $_REQUEST['department_id'];
        $deptdata = $object->dateRangeAllData($date1, $date2);

    } else {
        $date1 = $_REQUEST['date_attendance'];
        $date2 = $_REQUEST['date_attendance_to'];
        $departmentId = $_REQUEST['department_id'];
        $deptdata = $object->dateRangeData($date1, $date2, $departmentId);
    }
}


////id,date1 and date2 attendance data
////conflict
elseif ((isset($_REQUEST['date_attendance'])) and (isset($_REQUEST['date_attendance_to'])) and (isset($_REQUEST['id']))
    and ($_REQUEST['department_id']) and ($_REQUEST['over_time'] == null)) {

    $date = "'" . $_REQUEST['date_attendance'] . "'";
    $dateTo = "'" . $_REQUEST['date_attendance_to'] . "'";
    $id = $_REQUEST['id'];
    $deptdata = $object->dateFilterDataById($id, $date, $dateTo);

}
//
////date and overtime data
//
////conflict
elseif ((isset($_REQUEST['date_attendance'])) and (isset($_REQUEST['over_time']))
    and ($_REQUEST['department_id']) and ($_REQUEST['date_attendance_to'] == null) and ($_REQUEST['id'] == null) and ($_REQUEST['over_time'])) {
    $date = "'" . $_REQUEST['date_attendance'] . "'";
    $overtime = $_REQUEST['over_time'];
    $deptdata = $object->overTime($date, $overtime);
}
//
//
////id,date1,date2,overtime data
//
elseif ((isset($_REQUEST['id'])) and (isset($_REQUEST['over_time'])) and (isset($_REQUEST['date_attendance']))
    and (isset($_REQUEST['date_attendance_to'])) and ($_REQUEST['department_id'])) {

    $date1 = $_REQUEST['date_attendance'];
    $date2 = $_REQUEST['date_attendance_to'];
    $id = $_REQUEST['id'];
    $overtime = $_REQUEST['over_time'];

    $deptdata = $object->overTimeById($id, $date1, $date2, $overtime);

} elseif (($_REQUEST['id'] == null) and (isset($_REQUEST['over_time'])) and ($_REQUEST['date_attendance'] == null)
    and ($_REQUEST['date_attendance_to'] == null) and ($_REQUEST['department_id'] == null)) {

    $overtime = $_REQUEST['over_time'];
    $deptdata = $object->overTimeAll($overtime);

}

