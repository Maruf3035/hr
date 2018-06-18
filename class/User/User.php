<?php namespace App\USER;

use App\Model\Database as DB;
use PDO;
use App\Message\Message;
use App\Utility\Utility;

Class User extends DB
{
    private $userName;
    private $userPhone;
    private $userEmail;
    private $userPassword;
    private $userPassword2;

    public function setData($postData = array())
    {
        if (array_key_exists("user_name", $postData)) {
            $this->userName = $this->testInput($postData["user_name"]);
        }
        if (array_key_exists("user_phone", $postData)) {
            $this->userPhone = $this->testInput($postData["user_phone"]);
        }
        if (array_key_exists("user_email", $postData)) {
            $this->userEmail = $this->testInput($postData["user_email"]);
        }
        if (array_key_exists("user_password", $postData)) {
            $this->userPassword = md5($this->testInput($postData["user_password"]));
        }
        if (array_key_exists("user_password2", $postData)) {
            $this->userPassword2 = md5($this->testInput($postData["user_password2"]));
        }
    }

    public function testInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
//
//    public function create($sql,$dataArray)
//    {
//        $STH = $this->DBH->prepare($sql);
//        $result = $STH->execute($dataArray);
//
//    }


    public function insertUser()
    {
        $dataArray = array($this->userName, $this->userPhone, $this->userEmail, $this->userPassword);
        $sql = "INSERT INTO user(name,phone,email,password,password2) VALUES (?,?,?,?,?)";
//       die;
        $STH = $this->DBH->prepare($sql);
        $result = $STH->execute($dataArray);
        if ($result) {
            Message::message("Success! :) Data Has Been Inserted Successfully!<br>");
        } else {
            Message::message("Failed! :(  Data Has Not Been Inserted<br>");
        }
        Utility::redirect('create_user.php');
    }

    public function updateUser($id)
    {
        $dataArray = array($this->userName, $this->userPhone, $this->userEmail, $this->userPassword);
        $sql = "update  user set name='$this->userName',phone='$this->userPhone',
                email ='$this->userEmail',password ='$this->userPassword',password2 ='$this->userPassword2'
                where id='$id'";
        $STH = $this->DBH->prepare($sql);
        $result = $STH->execute();
    }

    public function allData($table)
    {
        $sql = "SELECT * FROM $table";
        $STH = $this->DBH->query($sql) or die("failed!");
        $STH->setFetchMode(PDO::FETCH_OBJ);
        return $STH->fetchAll();
    }

    public function singleData($id, $table)
    {
        $sql = "SELECT * FROM $table WHERE id = :id";
        $STH = $this->DBH->prepare($sql);
        $STH->execute(array(':id' => $id));
        $STH->setFetchMode(PDO::FETCH_OBJ);
        return $STH->fetch();
    }

    public function deleteSingleData($id, $table)
    {
        $sql = "DELETE FROM $table WHERE id=:id";
        $STH = $this->DBH->prepare($sql);
        $STH->execute(array(':id' => $id));
        return true;
    }
    //user management
    public function is_existUser($email,$password){

        $query="SELECT email,password from user where email='$email' and password='$password'";
        $STH=$this->DBH->prepare($query);
        $STH->execute(array('email' => $email, 'password' => $password));
        $count = $STH->rowCount();
        if ($count > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}