<?php

namespace App\Leave;

use App\Model\Database as DB;
use App\Utility\Utility;
use App\Message\Message;
use PDO;

use datetime;
use dateInterval;
use dateperiod;
use format;


class Leave extends DB

{
    private $user_id;

    private $leaveType;
    private $leaveTypeDays;
    private $leaveTypeId;
    private $availableDays;
    private $dateL1;
    private $dateL2;
    private $leaveDay;
    private $remaingingDays;
    private $approvedBy;


    public function setData($postData)
    {

        if (array_key_exists("user_id", $postData)) {
            $this->user_id = $postData["user_id"];
        }

        if (array_key_exists("update_id", $postData)) {
            $this->updateId = $postData["update_id"];
        }
        if (array_key_exists("late", $postData)) {
            $this->lateTime = $postData["late"];
        }
        if (array_key_exists("holiday_date", $postData)) {
            $this->holiday_date = $postData["holiday_date"];
        }
        if (array_key_exists("holiday_name", $postData)) {
            $this->holiday_name = $postData["holiday_name"];
        }
        if (array_key_exists("leave_type", $postData)) {
            $this->leaveType = $postData["leave_type"];
        }
        if (array_key_exists("leave_type_days", $postData)) {
            $this->leaveTypeDays = $postData["leave_type_days"];
        }
        if (array_key_exists("leave_type_id", $postData)) {
            $this->leaveTypeId = $postData["leave_type_id"];
        }
        if (array_key_exists("available_days", $postData)) {
            $this->availableDays = $postData["available_days"];
        }
        if (array_key_exists("from_date", $postData)) {
            $this->dateL1 = $postData["from_date"];
        }
        if (array_key_exists("to_date", $postData)) {
            $this->dateL2 = $postData["to_date"];
        }
        if (array_key_exists("days", $postData)) {
            $this->leaveDay = $postData["days"];
        }
        if (array_key_exists("remaining_days", $postData)) {
            $this->remaingingDays = $postData["remaining_days"];
        }
        if (array_key_exists("approved_by", $postData)) {
            $this->approvedBy = $postData["approved_by"];
        }

    }


    public function dateRangeData($date1, $date2, $departmentId)
    {
        $sql = "SELECT 	* FROM 	attendance as t1  JOIN	official_info as t2 ON	t1.user_id = t2.user_id 
                WHERE  date BETWEEN '$date1' and '$date2'   and t2.department_id='$departmentId' ";
//    echo $sql;
//    die;
        $statement = $this->DBH->query($sql);
        $statement->setFetchMode(PDO::FETCH_OBJ);
        return $statement->fetchAll();

    }

    public function storeLeaveSetup()
    {
        $dataArray = array($this->leaveType, $this->leaveTypeDays);

        $sql = "insert into leave_type(leave_type,leave_type_day) VALUES (?,?)";

        $STH = $this->DBH->prepare($sql);

        $result = $STH->execute($dataArray);
        if ($result) {
            Message::message("Success! :) Leave Data Has Been Inserted!<br>");
        } else {
            Message::message("Failed! :(  Leave Data Has Not Been Inserted!<br>");
        }
        Utility::redirect('index.php');

    }

    public function storeEmployeeLeave()
    {
        $dataArray = array($this->user_id, $this->leaveTypeId, $this->availableDays, $this->dateL1, $this->dateL2,
            $this->leaveDay, $this->remaingingDays, $this->approvedBy);

        $sql = "insert into leave_entry(user_id,leave_type_id,available_days,from_date,to_date,days,remaining_days,approved_by) VALUES (?,?,?,?,?,?,?,?)";
//echo $sql;
//die;
        $STH = $this->DBH->prepare($sql);

        $result = $STH->execute($dataArray);
        if ($result) {
            Message::message("Success! :) Leave Data Has Been Inserted!<br>");
        } else {
            Message::message("Failed! :( Leave Data Has Not Been Inserted!<br>");
        }
        Utility::redirect('index.php');


    }

    public function employeeLeave($user_id, $leaveId)
    {
        $sql = "select sum(days)as days from leave_entry where user_id=$user_id and leave_type_id=$leaveId";

//        echo $sql;
//        die;
        $STH = $this->DBH->query($sql);

        $STH->setFetchMode(PDO::FETCH_OBJ);

        return $STH->fetch();

    }

    public function employeeLeaveOnlyId()
    {
        $sql = "select * from leave_entry ";

        $STH = $this->DBH->query($sql);

        $STH->setFetchMode(PDO::FETCH_OBJ);

        return $STH->fetchAll();

    }

    public function availableDays($id)
    {
        $sql = "select  leave_type_day from leave_type where id=$id ";

        $STH = $this->DBH->query($sql);

        $STH->setFetchMode(PDO::FETCH_OBJ);

        return $STH->fetch();

    }

    public function leaveTypeData()
    {
        $sql = "select * from leave_type";

        $STH = $this->DBH->query($sql);

        $STH->setFetchMode(PDO::FETCH_OBJ);

        return $STH->fetchall();

    }

    public function totaldays($id)
    {
        $sql = "select leave_type_day from leave_type where id=$id";

        $STH = $this->DBH->query($sql);

        $STH->setFetchMode(PDO::FETCH_OBJ);

        return $STH->fetch();

    }

    /* @param $id
    @return leave_type
     */
    public function leaveTypeDataById($id)
    {
        $sql = "select leave_type from leave_type where id=$id";

        $STH = $this->DBH->query($sql);

        $STH->setFetchMode(PDO::FETCH_OBJ);

        return $STH->fetch();

    }

    /*@param $date
    @return holiday*/


    public function isExistEmployeeLeaveData($user_id, $leaveId)
    {
        $query = "select * from leave_entry where user_id='$user_id' and leave_type_id=$leaveId";
        $STH = $this->DBH->prepare($query);
        $STH->execute(array('user_id' => '$user_id', 'leave_type_id' => '$leaveId'));
        $count = $STH->rowCount();
        if ($count > 0) {
            return True;
        } else {
            return False;
        }
    }

    public function createDateRange($date1, $date2, $format = "m/d/Y")
    {
        $begin = new DateTime($date1);
        $end = new DateTime($date2);

        $interval = new DateInterval('P1D'); // 1 Day
        $dateRange = new DatePeriod($begin, $interval, $end);

        $range = [];
        foreach ($dateRange as $date) {
            $range[] = $date->format($format);
        }

        return $range;
    }


    public function employeeLeavById($id)
    {
        $sql = "select * from leave_entry where user_id='$id' ";

        $STH = $this->DBH->query($sql);

        $STH->setFetchMode(PDO::FETCH_OBJ);

        return $STH->fetchAll();

    }

}


