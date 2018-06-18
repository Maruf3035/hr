<?php
namespace App\Attendance;

use App\Model\Database as DB;
use App\Utility\Utility;
use App\Message\Message;
use PDO;


class Attendance extends DB

{
    private $user_id;
    private $departmentId;
    private $inTime;
    private $outTime;
    private $graceTime;
    private $employeeInTime;
    private $employeeOutTime;
    private $employeeOverTime;
    private $employeeStatus;
    private $employeeInDate;
    private $lateTime;
    private $updateId;


    public function setData($postData)
    {

        if (array_key_exists("user_id", $postData)) {
            $this->user_id = $postData["user_id"];
        }
        if (array_key_exists("department_id", $postData)) {
            $this->departmentId = $postData["department_id"];
        }
        if (array_key_exists("intime", $postData)) {
            $this->inTime = $postData["intime"];
        }
        if (array_key_exists("outtime", $postData)) {
            $this->outTime = $postData["outtime"];
        }
        if (array_key_exists("gracetime", $postData)) {
            $this->graceTime = $postData["gracetime"];
        }
        if (array_key_exists("employee_date", $postData)) {
            $this->employeeInDate = $postData["employee_date"];
        }
        if (array_key_exists("in_time", $postData)) {
            $this->employeeInTime = $postData["in_time"];
        }
        if (array_key_exists("out_time", $postData)) {
            $this->employeeOutTime = $postData["out_time"];
        }
        if (array_key_exists("over_time", $postData)) {
            $this->employeeOverTime = $postData["over_time"];
        }
        if (array_key_exists("status", $postData)) {
            $this->employeeStatus = $postData["status"];
        }

        if (array_key_exists("update_id", $postData)) {
            $this->updateId = $postData["update_id"];
        }
        if (array_key_exists("late", $postData)) {
            $this->lateTime = $postData["late"];
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

        if (array_key_exists("approved_by", $postData)) {
            $this->approvedBy = $postData["approved_by"];
        }

    }


    public function storeAttendance()
    {

        $dataArray = array($this->user_id, $this->employeeInDate, $this->employeeInTime, $this->employeeOutTime,
            $this->employeeOverTime, $this->employeeStatus, $this->lateTime);


        $sql = "insert into attendance(user_id,date,intime,outtime,overtime,status,late) VALUES (?,?,?,?,?,?,?)";

        $STH = $this->DBH->prepare($sql);

        $result = $STH->execute($dataArray);

        if ($result) {
            Message::message("Success! :) Attendance Has Been Inserted!<br>");
        } else {
            Message::message("Failed! :( Attendance Has Not Been Inserted!<br>");
        }
        Utility::redirect('index.php');

    }


    public function updateAttendance()
    {
        $dataArray = array($this->user_id, $this->employeeInDate, $this->employeeInTime, $this->employeeOutTime, $this->employeeOverTime,
            $this->employeeStatus);
        $sql = "update  attendance set user_id=?,date=?,intime=?,outtime=?,overtime=?,status=? where user_id=" . $this->updateId;
        $STH = $this->DBH->prepare($sql);
        $result = $STH->execute($dataArray);
        if ($result) {
            Utility::redirect('index.php');

        }

    }

//    public function updateAllAttendance()
//    {
//        $dataArray = array($this->employeeInTime, $this->employeeOutTime, $this->employeeOverTime, $this->late, $this->employeeStatus);
//        $sql = "update  attendance set intime=?,outtime=?,overtime=?,late=?,status=? where user_id=$this->id and  date=" . $this->employeeInDate;
//
//        $STH = $this->DBH->prepare($sql);
//        $result = $STH->execute($dataArray);
//        if ($result) {
//            Utility::redirect('http://localhost/hr/view/');
//
//        }
//    }
    public function updateAllAttendance()
    {

        $dataArray = array($this->employeeInTime, $this->employeeOutTime, $this->employeeOverTime, $this->employeeStatus, $this->lateTime);
        $sql = "update  attendance set intime='$this->employeeInTime',outtime='$this->employeeOutTime',
          overtime='$this->employeeOverTime',status='$this->employeeStatus',late='$this->lateTime' where user_id='$this->user_id' and  date='$this->employeeInDate'";

        //echo $sql;die;
        $STH = $this->DBH->prepare($sql);
        $result = $STH->execute();
        if ($result) {
            Message::message("Success! :) Data Has Been Updated!<br>");
        } else {
            Message::message("Failed! :(  Data Has Not Been updated!<br>");
        }
        Utility::redirect('index.php');

    }

    public function isWeekend($currentDate)
    {
        return (date('N', strtotime($currentDate)) == 5);
    }

    public function checkLeave($user_id, $date)
    {
        $query = "select from_date from leave_entry where user_id='$user_id' and from_date LIKE '%$date%'";

        $STH = $this->DBH->prepare($query);
        $STH->execute(array('user_id' => '$user_id', 'from_date' => '$date'));
        $count = $STH->rowCount();
        if ($count > 0) {
            return True;
        } else {
            return False;
        }
    }

    public function isExistHoliday($date)
    {
        $query = "SELECT * FROM holiday where holiday_date='$date'";
        $STH = $this->DBH->prepare($query);
        $STH->execute(array('holiday_date' => '$date'));
        $count = $STH->rowCount();
        if ($count > 0) {
            return True;
        } else {
            return False;
        }
    }

    public function isExistDateAll($date)
    {

        $query = "SELECT  * FROM attendance WHERE attendance.date=$date";
        $STH = $this->DBH->prepare($query);
        $STH->execute(array('date' => $date));
        $count = $STH->rowCount();
        if ($count > 0) {
            return True;
        } else {
            return False;
        }
    }

    public function isExistDate($department_id, $att_date)
    {
        $query = "SELECT 	* FROM 	official_info as t1  JOIN	attendance as t2 ON	t1.user_id = t2.user_id WHERE t1.department_id=$department_id and t2.date=$att_date";
        $STH = $this->DBH->prepare($query);
        $STH->execute(array('department_id' => $department_id, 'date' => $att_date));
        $count = $STH->rowCount();
        if ($count > 0) {
            return True;
        } else {
            return False;
        }
    }


    public function dataFilter($where_param)
    {

        $sql = "SELECT * FROM attendance " . $where_param;

        $statement = $this->DBH->query($sql);
        $statement->setFetchMode(PDO::FETCH_OBJ);
        return $statement->fetchAll();

    }

    public function attendanceDetails($department_id, $att_date)
    {
        $sql = "SELECT 	* FROM 	official_info as t1  JOIN	attendance as t2 ON	t1.user_id = t2.user_id WHERE t1.department_id=$department_id and t2.date=$att_date";
        $statement = $this->DBH->query($sql);
        $statement->setFetchMode(PDO::FETCH_OBJ);
        return $statement->fetchAll();

    }

    public function attendanceDetailsById($id, $att_date)
    {
        $sql = "SELECT 	* FROM 	official_info as t1  JOIN	attendance as t2 ON	t1.user_id = t2.user_id WHERE t1.user_id='$id' and t2.date=$att_date";
        $statement = $this->DBH->query($sql);
        $statement->setFetchMode(PDO::FETCH_OBJ);
        return $statement->fetchAll();

    }

    public function singleAllAttendance($id)
    {
        $sql = "SELECT 	* FROM 	official_info as t1  JOIN	attendance as t2 ON	t1.user_id = t2.user_id WHERE t1.user_id='$id'";
        $statement = $this->DBH->query($sql);
        $statement->setFetchMode(PDO::FETCH_OBJ);
        return $statement->fetchAll();

    }

    public function attendanceDetailsAll()
    {
        $sql = "SELECT 	* FROM 	official_info as t1  JOIN	attendance as t2 ON	t1.user_id = t2.user_id";
        $statement = $this->DBH->query($sql);
        $statement->setFetchMode(PDO::FETCH_OBJ);
        return $statement->fetchAll();

    }


    public function attendanceData()
    {
        $sql = "select * from attendance";

        $STH = $this->DBH->query($sql);

        $STH->setFetchMode(PDO::FETCH_OBJ);

        return $STH->fetchAll();

    }


    public function attendanceViewAllByDate($data)

    {
        $sql = "select * from attendance where date=" . $data;

        $statement = $this->DBH->query($sql);
        $statement->setFetchMode(PDO::FETCH_OBJ);
        return $statement->fetchAll();
    }

    public function attendanceView($id)

    {
        $sql = "select * from attendance where user_id='$id'";
        $statement = $this->DBH->query($sql);
        $statement->setFetchMode(PDO::FETCH_OBJ);
        return $statement->fetchAll();
    }

    public function attendanceViewForedit($id)
    {
        $sql = "select * from attendance where user_id=$id";
        $statement = $this->DBH->query($sql);
        $statement->setFetchMode(PDO::FETCH_OBJ);
        return $statement->fetch();

    }


    public function viewDate($date)
    {
        $sql = "select * from attendance where date=" . $date;
        //echo $sql;die;
        $STH = $this->DBH->query($sql);

        $STH->setFetchMode(PDO::FETCH_OBJ);

        return $STH->fetchAll();

        Utility::redirect('test.php');


    }


    public function attendanceSingleData($id)
    {
        $sql = "select * from attendance where user_id=$id";
        $statement = $this->DBH->query($sql);
        $statement->setFetchMode(PDO::FETCH_OBJ);
        return $statement->fetchAll();
    }


    public function checkStatusPresent($date, $department_id)
    {

        $sql = "SELECT 	COUNT(status)as totalStatus FROM	official_info as t1  JOIN	attendance as t2 ON	t1.user_id = t2.user_id where date=$date and department_id=$department_id and (status='Present'or status='Late')";

//        echo $sql;die;
        $STH = $this->DBH->query($sql);

        $STH->setFetchMode(PDO::FETCH_OBJ);

        return $STH->fetchAll();

    }

    public function checkStatusAbsent($date, $department_id)
    {

        $sql = "SELECT 	COUNT(status)as totalAbsent FROM	official_info as t1  JOIN	attendance as t2 ON	t1.user_id = t2.user_id where date=$date and department_id=$department_id and status='Absent'";

//        echo $sql;die;
        $STH = $this->DBH->query($sql);

        $STH->setFetchMode(PDO::FETCH_OBJ);

        return $STH->fetchAll();

    }

    public function totalAbsent($date)
    {

        $sql = "SELECT 	COUNT(status)as total_absent  from attendance  where date=$date  and status='Absent'";

//        echo $sql;die;
        $STH = $this->DBH->query($sql);

        $STH->setFetchMode(PDO::FETCH_OBJ);

        return $STH->fetch();

    }

    public function totalPresent($date)
    {

        $sql = "SELECT 	COUNT(status)as total_present  from attendance  where date=$date  and (status='Present'or status='Late')";

//        echo $sql;die;
        $STH = $this->DBH->query($sql);

        $STH->setFetchMode(PDO::FETCH_OBJ);

        return $STH->fetch();

    }

    public function totalPresentOnlyId($id, $date1, $date2)

    {

        $sql = "SELECT 	COUNT(status)as total_present  from attendance  where  status='Present' and user_id='$id' and (date BETWEEN '$date1' and '$date2')";

//    echo $sql;die;
        $STH = $this->DBH->query($sql);

        $STH->setFetchMode(PDO::FETCH_OBJ);

        return $STH->fetch();

    }

    public function totalAbsentOnlyId($id, $date1, $date2)
    {

        $sql = "SELECT 	COUNT(status)as total_absent  from attendance  where  (status='Absent') and user_id='$id' and (date BETWEEN '$date1' and '$date2')";

//        echo $sql;die;
        $STH = $this->DBH->query($sql);

        $STH->setFetchMode(PDO::FETCH_OBJ);

        return $STH->fetch();

    }

    public function totalLateOnlyId($id, $date1, $date2)
    {

        $sql = "SELECT 	COUNT(status)as total_late  from attendance  where  (status='Late') and user_id='$id' and (date BETWEEN '$date1' and '$date2')";

//        echo $sql;die;
        $STH = $this->DBH->query($sql);

        $STH->setFetchMode(PDO::FETCH_OBJ);

        return $STH->fetch();

    }

    public function totalWeekendOnlyId($id, $date1, $date2)
    {

        $sql = "SELECT 	COUNT(status)as total_weekend  from attendance  where  (status='Friday') and user_id='$id' and (date BETWEEN '$date1' and '$date2')";

//        echo $sql;die;
        $STH = $this->DBH->query($sql);

        $STH->setFetchMode(PDO::FETCH_OBJ);

        return $STH->fetch();

    }

    public function totalHolidayOnlyId($id, $date1, $date2)
    {

        $sql = "SELECT 	COUNT(status)as total_holiday  from attendance  where  (status='Holiday') and user_id='$id' and (date BETWEEN '$date1' and '$date2')";

//        echo $sql;die;
        $STH = $this->DBH->query($sql);

        $STH->setFetchMode(PDO::FETCH_OBJ);

        return $STH->fetch();

    }

    public function totalLeaveOnlyId($id, $date1, $date2)
    {

        $sql = "SELECT 	COUNT(status)as total_leave  from attendance  where  (status='Leave') and user_id='$id' and (date BETWEEN '$date1' and '$date2')";

//        echo $sql;die;
        $STH = $this->DBH->query($sql);

        $STH->setFetchMode(PDO::FETCH_OBJ);

        return $STH->fetch();

    }

    public function totalOverTimeById($id, $date1, $date2)
    {

        $sql = "SELECT 	sum(overtime)as total_overTime  from attendance  where   user_id='$id' and (date BETWEEN '$date1' and '$date2')";

//        echo $sql;die;
        $STH = $this->DBH->query($sql);

        $STH->setFetchMode(PDO::FETCH_OBJ);

        return $STH->fetch();

    }


    public function dateFilterDataById($id, $date1, $date2)
    {
        $sql = "SELECT 	* FROM 	attendance as t1  JOIN	official_info as t2 ON	t1.user_id = t2.user_id WHERE  t1.user_id='$id' and  t1.date 
      BETWEEN $date1 and date=$date2 ";
//    echo $sql;
//    die;
        $statement = $this->DBH->query($sql);
        $statement->setFetchMode(PDO::FETCH_OBJ);
        return $statement->fetchAll();

    }

    public function dateFilterData($date1, $date2)
    {
        $sql = "SELECT 	* FROM 	attendance  WHERE  date BETWEEN $date1 and $date2 ";
//    echo $sql;
//    die;
        $statement = $this->DBH->query($sql);
        $statement->setFetchMode(PDO::FETCH_OBJ);
        return $statement->fetchAll();

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

    public function dateRangeAllData($date1, $date2)
    {
        $sql = "SELECT 	* FROM 	attendance   WHERE  date BETWEEN '$date1' and '$date2'  ";
//    echo $sql;
//    die;
        $statement = $this->DBH->query($sql);
        $statement->setFetchMode(PDO::FETCH_OBJ);
        return $statement->fetchAll();

    }

    public function overTime($date, $overtime)
    {
        $sql = "SELECT 	* FROM 	attendance  WHERE  date=$date and overtime  $overtime  ";
//    echo $sql;
//    die;
        $statement = $this->DBH->query($sql);
        $statement->setFetchMode(PDO::FETCH_OBJ);
        return $statement->fetchAll();

    }

    public function overTimeById($id, $date_attendance, $date_attendance_to, $overtime)
    {
        $sql = "SELECT 	* FROM 	attendance  WHERE  date BETWEEN '$date_attendance' and '$date_attendance_to'  and overtime  $overtime and user_id='$id' ";
//    echo $sql;
//    die;
        $statement = $this->DBH->query($sql);
        $statement->setFetchMode(PDO::FETCH_OBJ);
        return $statement->fetchAll();

    }

    public function overTimeAll($overtime)
    {
        $sql = "SELECT 	* FROM 	attendance  WHERE  overtime  $overtime ";
//    echo $sql;
//    die;
        $statement = $this->DBH->query($sql);
        $statement->setFetchMode(PDO::FETCH_OBJ);
        return $statement->fetchAll();

    }

    public function lateReport($date)
    {
        $sql = "SELECT 	* FROM 	attendance as t1  JOIN	official_info as t2  ON	t1.user_id = t2.user_id
                JOIN personal_info as t3 on t1.user_id=t3.user_id
                WHERE  date='$date' and status='Late'";

        $statement = $this->DBH->query($sql);
        $statement->setFetchMode(PDO::FETCH_OBJ);
        return $statement->fetchAll();

    }

    public function absentReport($date)
    {
        $sql = "SELECT 	* FROM 	attendance as t1  JOIN	official_info as t2  ON	t1.user_id = t2.user_id
                JOIN personal_info as t3 on t1.user_id=t3.user_id
                WHERE  date='$date' and status='Absent'";

        $statement = $this->DBH->query($sql);
        $statement->setFetchMode(PDO::FETCH_OBJ);
        return $statement->fetchAll();

    }


    public function totalPresentId($date1, $date2, $id)
    {

        $sql = "SELECT 	COUNT(status)as total_present  from attendance  where date BETWEEN '$date1' and '$date2' and status='Present' and user_id='$id'";

//        echo $sql;die;
        $STH = $this->DBH->query($sql);

        $STH->setFetchMode(PDO::FETCH_OBJ);

        return $STH->fetchall();

    }

    public function totalPresentIdByDept($id)
    {

        $sql = "SELECT 	COUNT(status)as total_present  from attendance  where  status='Present' and user_id='$id'";

//        echo $sql;die;
        $STH = $this->DBH->query($sql);

        $STH->setFetchMode(PDO::FETCH_OBJ);

        return $STH->fetchall();

    }

    public function totalAbsentId($date1, $date2, $id)
    {

        $sql = "SELECT 	COUNT(status)as total_absent  from attendance  where date BETWEEN '$date1' and '$date2' and status='Absent' and user_id='$id'";

//        echo $sql;die;
        $STH = $this->DBH->query($sql);

        $STH->setFetchMode(PDO::FETCH_OBJ);

        return $STH->fetchall();

    }

    public function totalLateId($date1, $date2, $id)
    {

        $sql = "SELECT 	COUNT(status)as total_late  from attendance  where date BETWEEN '$date1' and '$date2' and status='Late' and user_id='$id'";

//        echo $sql;die;
        $STH = $this->DBH->query($sql);

        $STH->setFetchMode(PDO::FETCH_OBJ);

        return $STH->fetchall();

    }

    public function attendanceDataReport($date1, $date2, $user_id)
    {
        $sql = "select * from attendance  where (date BETWEEN '$date1' and '$date2') and user_id='$user_id'";

        $STH = $this->DBH->query($sql);

        $STH->setFetchMode(PDO::FETCH_OBJ);

        return $STH->fetchAll();


    }
}


