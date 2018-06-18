<?php

namespace App\Hr;

use App\Model\Database as DB;
use App\Utility\Utility;
use App\Message\Message;
use PDO;


class Hr extends DB

{
    private $user_id;
    private $departmentId;
    private $designationId;
    private $salaryEmp;
    private $shiftId;
    private $name;
    private $fatherName;
    private $motherName;
    private $birthDate;
    private $gender;
    private $phoneNumber;
    private $presentAddress;
    private $permenentAddress;
    private $nationalId;
    private $joiningDate;
    private $departmentName;
    private $designationName;
    private $salary;
    private $grade;
    private $shift;
    private $inTime;
    private $outTime;
    private $graceTime;
    private $shiftName;
    private $photo;
    private $updateId;
    private $holiday_date;
    private $holiday_name;
    private $approvedBy;


    public function setData($postData)
    {

        if (array_key_exists("user_id", $postData)) {
            $data_userId = $postData["user_id"];
            $data_userId=trim($data_userId);
            $data_userId=stripcslashes($data_userId);
            $data_userId=htmlspecialchars($data_userId);
            $this->user_id = $data_userId;
        }
        if (array_key_exists("department_id", $postData)) {
            $this->departmentId = $postData["department_id"];
            }
        if (array_key_exists("designation_id", $postData)) {
            $this->designationId = $postData["designation_id"];
        }
        if (array_key_exists("shift_id", $postData)) {
            $this->shiftId = $postData["shift_id"];
        }
        if (array_key_exists("name", $postData)) {
            $this->name = $postData["name"];
        }

        if (array_key_exists("father_name", $postData)) {
            $this->fatherName = $postData["father_name"];
        }
        if (array_key_exists("mother_name", $postData)) {
            $this->motherName = $postData["mother_name"];
        }

        if (array_key_exists("birth_date", $postData)) {
            $this->birthDate = $postData["birth_date"];
        }
        if (array_key_exists("gender", $postData)) {
            $this->gender = $postData["gender"];
        }
        if (array_key_exists("phone_number", $postData)) {
            $this->phoneNumber = $postData["phone_number"];
        }
        if (array_key_exists("present_address", $postData)) {
            $this->presentAddress = $postData["present_address"];
        }
        if (array_key_exists("permanent_address", $postData)) {
            $this->permenentAddress = $postData["permanent_address"];
        }
        if (array_key_exists("national_id", $postData)) {
            $this->nationalId = $postData["national_id"];
        }
        if (array_key_exists("joining_date", $postData)) {
            $this->joiningDate = $postData["joining_date"];
        }
        if (array_key_exists("department_name", $postData)) {
            $this->departmentName = $postData["department_name"];
        }
        if (array_key_exists("designation_name", $postData)) {
            $this->designationName = $postData["designation_name"];
        }
        if (array_key_exists("salary", $postData)) {
            $this->salaryEmp = $postData["salary"];
        }
        if (array_key_exists("salary", $postData)) {
            $this->salary = $postData["salary"];
        }
        if (array_key_exists("grade", $postData)) {
            $this->grade = $postData["grade"];
        }
        if (array_key_exists("shift", $postData)) {
            $this->shift = $postData["shift"];
        }
        if (array_key_exists("shift_name", $postData)) {
            $this->shiftName = $postData["shift_name"];
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
        if (array_key_exists("intime", $postData)) {
            $this->inTime = $postData["intime"];
        }
        if (array_key_exists("photo", $postData)) {
            $this->photo = $postData["photo"];
        }

        if (array_key_exists("update_id", $postData)) {
            $this->updateId = $postData["update_id"];
        }
               if (array_key_exists("holiday_date", $postData)) {
            $this->holiday_date = $postData["holiday_date"];
        }
        if (array_key_exists("holiday_name", $postData)) {
            $this->holiday_name = $postData["holiday_name"];
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

    public function storePersonalInfo()
    {

        $dataArray = array($this->user_id, $this->name, $this->fatherName, $this->motherName,
            $this->birthDate, $this->gender, $this->phoneNumber, $this->presentAddress, $this->permenentAddress, $this->photo);


        $sql = "insert into personal_info(user_id,name,father_name,mother_name,birth_date,gender,phone_number,present_address,permanent_address,photo) VALUES (?,?,?,?,?,?,?,?,?,?)";

        $STH = $this->DBH->prepare($sql);

        $result = $STH->execute($dataArray);

        //$last_id = $this->DBH->lastInsertId();

    }

    public function storeOfficialInfo()
    {

        $dataArray = array($this->user_id, $this->nationalId, $this->joiningDate, $this->departmentId, $this->designationId, $this->salaryEmp, $this->grade, $this->shiftId);


        $sql = "insert into official_info(user_id,national_id,joining_date,department_id,designation_id,salary_emp,grade,shift_id) VALUES (?,?,?,?,?,?,?,?)";

        $STH = $this->DBH->prepare($sql);

        $result = $STH->execute($dataArray);
        if ($result) {
            Message::message("Success! :)  Data Has Been Inserted!<br>");
        } else {
            Message::message("Failed! :(  Data Has Not Been Inserted!<br>");
        }
        Utility::redirect('index.php');

    }

    public function storeShift()
    {

        $dataArray = array($this->shiftName, $this->inTime, $this->outTime, $this->graceTime);


        $sql = "insert into shift(shift,in_time,out_time,grace_time) VALUES (?,?,?,?)";

        $STH = $this->DBH->prepare($sql);

        $result = $STH->execute($dataArray);

        if ($result) {
            Message::message("Success! :) Shift Data Has Been Inserted!<br>");
        } else {
            Message::message("Failed! :(  Shift Data Has Not Been Inserted!<br>");
        }
        Utility::redirect('index.php');

    }




    public function updatePersonalInfo()
    {
        $dataArray = array($this->name, $this->fatherName, $this->motherName, $this->birthDate, $this->gender, $this->phoneNumber, $this->presentAddress, $this->permenentAddress, $this->photo);
        //  $sql = "update personal_info set name=?,father_name=?,mother_name=?,birth_date=?,gender=?,phone_number=?,present_address=?,permanent_address=?,photo=? where user_id=" . $this->user_id;

        $sql = "update  personal_info set name='$this->name',father_name='$this->fatherName',
          mother_name='$this->motherName',birth_date='$this->birthDate',phone_number='$this->phoneNumber',present_address='$this->presentAddress',
              permanent_address='$this->permenentAddress',photo='$this->photo'
              where user_id='$this->user_id'";
//echo $sql;die;

        $STH = $this->DBH->prepare($sql);
        $result = $STH->execute();

        if ($result) {
            Utility::redirect('index.php');

        }
        if ($result) {
            Utility::redirect('index.php');

        }
    }

    public function updateOfficialInfo()
    {
        $dataArray = array($this->user_id, $this->nationalId, $this->joiningDate, $this->departmentId, $this->designationId, $this->salaryEmp, $this->grade, $this->shiftId);
        $sql = "update  official_info set user_id=?,national_id=?,joining_date=?,department_id=?,designation_id=?,salary_emp=?,grade=?,shift_id=? where user_id=" . $this->user_id;
        $STH = $this->DBH->prepare($sql);
        $result = $STH->execute($dataArray);

        if ($result) {
            Message::message("Success! :) Data Has Been Updated!<br>");
        } else {
            Message::message("Failed! :(  Data Has Not Been Update!<br>");
        }
        Utility::redirect('index.php');

    }

    public function isNotExist($data)
    {

        $query = "SELECT  * FROM personal_info WHERE personal_info.user_id='$data'";
        $STH = $this->DBH->prepare($query);
        $STH->execute(array('user_id' => $data));
        $count = $STH->rowCount();
        if ($count > 0) {
            return True;
        } else {
            return False;
        }
    }



    public function employeeIndex()
    {
        $sql = "select * from personal_info";
        $statement = $this->DBH->query($sql);
        $statement->setFetchMode(PDO::FETCH_OBJ);
        return $statement->fetchAll();
    }

    public function officialInfo()
    {
        $sql = "select * from official_info";
        $statement = $this->DBH->query($sql);
        $statement->setFetchMode(PDO::FETCH_OBJ);
        return $statement->fetchAll();
    }

    public function officialInfoById($id)
    {
        $sql = "select * from official_info where user_id='$id'";
        $statement = $this->DBH->query($sql);
        $statement->setFetchMode(PDO::FETCH_OBJ);
        return $statement->fetchAll();
    }

    public function employeeDetails()
    {
        $sql = "SELECT 	* FROM 	personal_info as t1  JOIN	official_info as t2 ON	t1.user_id = t2.user_id  WHERE	t1.user_id='$this->user_id'";
//        echo $sql;
//        die;
        $statement = $this->DBH->query($sql);
        $statement->setFetchMode(PDO::FETCH_OBJ);
        return $statement->fetch();

    }

    public function personalOfficial()
    {
        $sql = "SELECT 	* FROM 	personal_info as t1  JOIN	official_info as t2 ON	t1.user_id = t2.user_id ";
//        echo $sql;
//        die;
        $statement = $this->DBH->query($sql);
        $statement->setFetchMode(PDO::FETCH_OBJ);
        return $statement->fetchAll();

    }


    public function departmentData()
    {
        $sql = "select * from department";

        $STH = $this->DBH->query($sql);

        $STH->setFetchMode(PDO::FETCH_OBJ);

        return $STH->fetchAll();

    }


    public function departmentDataById($id)
    {
        $sql = "select * from department where id=$id";

        $STH = $this->DBH->query($sql);

        $STH->setFetchMode(PDO::FETCH_OBJ);

        return $STH->fetch();

    }

    public function designationDataById($id)
    {
        $sql = "select * from designation where id=$id";

        $STH = $this->DBH->query($sql);

        $STH->setFetchMode(PDO::FETCH_OBJ);

        return $STH->fetch();

    }

    public function salaryDataById($id)
    {
        $sql = "select * from salary where id=$id";

        $STH = $this->DBH->query($sql);

        $STH->setFetchMode(PDO::FETCH_OBJ);

        return $STH->fetch();

    }

    public function shiftDataById($id)
    {
        $sql = "select * from shift where id=$id";

        $STH = $this->DBH->query($sql);

        $STH->setFetchMode(PDO::FETCH_OBJ);

        return $STH->fetch();

    }

    public function designationData()
    {
        $sql = "select * from designation";

        $STH = $this->DBH->query($sql);

        $STH->setFetchMode(PDO::FETCH_OBJ);

        return $STH->fetchAll();

    }

    public function salaryData()
    {
        $sql = "select * from salary";

        $STH = $this->DBH->query($sql);

        $STH->setFetchMode(PDO::FETCH_OBJ);

        return $STH->fetchAll();

    }

    public function shiftData()
    {
        $sql = "select * from shift";

        $STH = $this->DBH->query($sql);

        $STH->setFetchMode(PDO::FETCH_OBJ);

        return $STH->fetchAll();

    }


    public function viewEmployee($dept_id)
    {
        $sql = "select * from official_info where department_id=" . $dept_id;
        //echo $sql;die;
        $STH = $this->DBH->query($sql);

        $STH->setFetchMode(PDO::FETCH_OBJ);

        return $STH->fetchAll();

        Utility::redirect('test.php');


    }

    public function viewAllEmployeeByDept($department_id)
    {
        $sql = "SELECT 	* FROM 	official_info where department_id=$department_id";
//        echo $sql;die;
        $STH = $this->DBH->query($sql);

        $STH->setFetchMode(PDO::FETCH_OBJ);

        return $STH->fetchAll();


    }

    public function checkShift($id)
    {
        $sql = "SELECT 	* FROM 	official_info as t1  JOIN shift as t2 ON	t1.shift_id = t2.id where user_id='$id'";
        $STH = $this->DBH->query($sql);
        $STH->setFetchMode(PDO::FETCH_OBJ);
        return $STH->fetch();

    }

    public function salaryById($user_id)
    {
        $sql = "SELECT 	* FROM 	official_info where user_id='$user_id'";
        $STH = $this->DBH->query($sql);
        $STH->setFetchMode(PDO::FETCH_OBJ);
        return $STH->fetch();

    }



    public function reportAttendanceById($id, $dept_id, $date1, $date2)
    {
        $sql = "SELECT 	* FROM 	attendance as t1  JOIN	official_info as t2 ON	t1.user_id = t2.user_id WHERE t2.user_id=$id and  t2.department_id=$dept_id and  t1.date 
      BETWEEN $date1 and date=$date2 ";
//    echo $sql;
//    die;
        $statement = $this->DBH->query($sql);
        $statement->setFetchMode(PDO::FETCH_OBJ);
        return $statement->fetchAll();

    }

    public function reportAttendanceDept($dept_id)
    {
        $sql = "SELECT 	* FROM 	attendance as t1  JOIN	official_info as t2 ON	t1.user_id = t2.user_id WHERE  t2.department_id=$dept_id ";
        $statement = $this->DBH->query($sql);
        $statement->setFetchMode(PDO::FETCH_OBJ);
        return $statement->fetchAll();

    }


    public function countEmployee($id)
    {
        $sql = "select   COUNT(user_id )as total_user   from official_info   where department_id=$id";

        $STH = $this->DBH->query($sql);

        $STH->setFetchMode(PDO::FETCH_OBJ);

        return $STH->fetchAll();

    }

    public function totalEmployee()
    {
        $sql = "select   COUNT(user_id )as total   from official_info ";

        $STH = $this->DBH->query($sql);

        $STH->setFetchMode(PDO::FETCH_OBJ);

        return $STH->fetch();

    }







    public function departmentLate($department_id)
    {
        $sql = "Select department from department where id=$department_id";

        $statement = $this->DBH->query($sql);
        $statement->setFetchMode(PDO::FETCH_OBJ);
        return $statement->fetch();

    }

    public function departmentAbsent($department_id)
    {
        $sql = "Select department from department where id=$department_id";

        $statement = $this->DBH->query($sql);
        $statement->setFetchMode(PDO::FETCH_OBJ);
        return $statement->fetch();

    }

    public function empDataByDept($departmentId)
    {
        $sql = "select * from official_info where department_id=$departmentId";

        $STH = $this->DBH->query($sql);

        $STH->setFetchMode(PDO::FETCH_OBJ);

        return $STH->fetchall();

    }

    public function findDepartment($id)
    {

        $sql = "select department from department where id=$id";

        $STH = $this->DBH->query($sql);

        $STH->setFetchMode(PDO::FETCH_OBJ);

        return $STH->fetch();

    }


    public function storeHoliday()
    {
        $dataArray = array($this->holiday_date, $this->holiday_name);

        $sql = "insert into holiday(holiday_date,holiday_name) VALUES (?,?)";
//echo $sql;
//die;
        $STH = $this->DBH->prepare($sql);

        $result = $STH->execute($dataArray);
        if ($result) {
            Message::message("Success! :) Holiday Data Has Been Updated!<br>");
        } else {
            Message::message("Failed! :(  Holiday Data Has Not Been updated!<br>");
        }
        Utility::redirect('index.php');


    }


}


