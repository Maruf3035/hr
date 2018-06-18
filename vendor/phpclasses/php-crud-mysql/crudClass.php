<?php
//namespace crudClass;
/**
 * Author: Mahbub
 * Author URI: mahboobz.com
 */

class crudClass {
    /*
     * @var $host string : db host name
     */
    public $host;

    /*
     * @var $user string : db user name
     */
    public $user;

    /*
     * @var $pass string : db password
     */
    public $pass;

    /*
     * @var $db string : database name
     */
    public $db;

    /*
     * @var $table string : table name
     */
    public $table;

    /*
     * @var $raw_fields string : columns name
     */
    public $raw_fields;

    /*
     * @var $fields array : columns name array
     */
    public $fields = array();

    public function __construct($table, $fields){
        $this->table = $table;
        $this->raw_fields = $fields;
        $this->fields = explode(',', $fields);
    }

    /*
     * db_con function is used to connect with database
     * */
    function db_con($host, $user, $pass, $db){
        $this->host = $host;
        $this->user = $user;
        $this->pass = $pass;
        $this->db = $db;

        return mysqli_connect($this->host,$this->user,$this->pass,$this->db);
    }

    /*
     * create function is used to create new row of information
     * */
    public function create(){
        $post_fields = array();
        foreach($this->fields as $field){
            $post_fields[] = $_POST[$field];
        }
        $values = implode("','", $post_fields);// Form Post values to Insert

        $create_sql = "INSERT into `".$this->table."` (".$this->raw_fields.") VALUES ('$values')";
        return $create_sql;
    }

    /*
     * read function is used to read rows of the table
     * additionally it takes WHERE clause value as $where variable
     * */
    public function read($where = ''){
        $read_sql = "SELECT * FROM `".$this->table."` ".$where;
        return $read_sql;
    }

    /*
     * update function is used to update a row
     * */
    public function update($id){
        $update_array = array();
        foreach($this->fields as $field){
            $update_array[] = "`$field` = '$_POST[$field]'";
        }
        $values = implode(", ", $update_array);// Form Post values to update

        $update_sql = "UPDATE `".$this->table."` SET $values WHERE `id`='$id'";
        return $update_sql;
    }

    /*
     * delete function is used to delete a row
     * */
    public function delete($id){
        $delete_sql = "DELETE FROM `".$this->table."` WHERE `id` = '$id'";
        return $delete_sql;
    }

    /*
     * create_form function is used to develop a form according to given attributes
     * */
    public function create_form(){
        $form = '
                <form method="post" action="create_'.$this->table.'.php">';
        foreach($this->fields as $field){
            $form .=  $field.' <input class="form-control" type="text" name="'.$field.'"/>';
        }

        $form .= '<input type="submit" class="form-control btn btn-primary" name="submit" value="Submit"/>
                </form>
                ';

        return $form;
    }

    /*
     * render function is used to show the read information horizontally
     * */
    public function render(){
        $read_sql = self::read();
        $con = self::db_con($this->host,$this->user,$this->pass,$this->db);

        $read_value = mysqli_query($con,$read_sql);
        $render = '';
        while($user = mysqli_fetch_array($read_value)){
            $render .= '<form method="post" action="create_'.$this->table.'.php">';
            foreach($this->fields as $field){
                $render .= $field.' <input type="text" name="'.$field.'"  value="'.$user[$field].'"/>';
            }
            $render .= '
                <input type="hidden" name="id" value="'.$user['id'].'"/>
                <input type="submit" name="update" value="UPDATE"/>
                <input type="submit" name="delete" value="DELETE"/>
            </form>
            ';
        }

        return $render;
    }

    /*
     * renderVertically function is used to show the read information vertically
     * */
    public function renderVertically(){
        $read_sql = self::read();
        $con = self::db_con($this->host,$this->user,$this->pass,$this->db);

        $read_value = mysqli_query($con,$read_sql);
        $render = '<table>';
        $render .= '<tr>';
        foreach($this->fields as $field){
            $render .= '<td>'.ucfirst($field).'</td>';
        }
        $render .='<td>Action</td></tr>';
        while($user = mysqli_fetch_array($read_value)){
            $render .= '<tr>';
            foreach($this->fields as $field){
                $render .= '<td>'.$user[$field].'</td>';
            }
            $render .= '<td><form method="post" action="create_'.$this->table.'.php">
                <input type="hidden" name="id" value="'.$user['id'].'"/>
                <input type="submit" name="edit" value="EDIT"/>
                <input type="submit" name="delete" value="DELETE"/>
            </form></td>
            ';
            $render .='</tr>';
        }
        $render .='</table>';

        return $render;
    }

    /*
     * renderEditor function is used to ready the row edit form
     * */
    public function renderEditor($id){
        $where = "WHERE id='".$id."'";
        $read_sql = self::read($where);
        $con = self::db_con($this->host,$this->user,$this->pass,$this->db);

        $read_value = mysqli_query($con,$read_sql);
        $render = '';
        while($user = mysqli_fetch_array($read_value)){
            $render .= '<form method="post" action="create_'.$this->table.'.php">';
            foreach($this->fields as $field){
                $render .= $field.' <input type="text" name="'.$field.'"  value="'.$user[$field].'"/><br>';
            }
            $render .= '
                <input type="hidden" name="id" value="'.$user['id'].'"/>
                <input type="submit" name="update" value="UPDATE"/>
            </form>
            ';
        }

        return $render;
    }

}