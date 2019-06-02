<?php
class Employee extends Db {
    //Fix input with escape characters
    function escape($value){
        $search = array("\\",  "\x00", "\n",  "\r",  "'",  '"', "\x1a");
        $replace = array("\\\\","\\0","\\n", "\\r", "\'", '\"', "\\Z");
    
        return str_replace($search, $replace, $value);
    }
    //Insert a new employee's data
    public function insert_data($firstName, $lastName, $osuid, $email, $hash, $rfid, $blocks){
        $sql = "INSERT INTO employees (firstName, lastName, email, password, rfid, blocks, osu_id, store_access) VALUES ('$firstName', '$lastName', '$email', '$hash', '$rfid', '$blocks', '$osuid', 1)";
        $this->connect()->query($sql);
    }
    //Check if login info is correct
    public function check_credentials($email, $password){
        $sql = "SELECT * FROM employees WHERE email='$email'";
        $result = $this->connect()->query($sql);
        return $result;
    }
    //Get from id
    public function get_from_id($id){
        $sql = "SELECT * FROM employees WHERE id='$id'";
        $result = $this->connect()->query($sql);
        if($result->rowCount() > 0){
            while($row = $result->fetch()){
                $data[] = $row;
            }
            return $data;
        }
    }
    //Check if rfid number exists
    public function search_rfid($rfid){
        $sql = "SELECT * FROM employees WHERE rfid='$rfid'";
        $result = $this->connect()->query($sql);
        if($result->rowCount() > 0){
            while($row = $result->fetch()){
                $data[] = $row;
            }
            return $data;
        }
    }
    //Check if login info is correct
    public function get_from_email($email){
        $sql = "SELECT id FROM employees WHERE email='$email'";
        $result = $this->connect()->query($sql);
        return $result;
    }
    //Check if login info is correct
    public function get_from_emandsp($email, $sp){
        $sql = "SELECT id FROM employees WHERE email='$email' AND sp='$sp'";
        $result = $this->connect()->query($sql);
        if($result->rowCount() > 0){
            while($row = $result->fetch()){
                $data[] = $row;
            }
            return $data[0][0];
        }
    }
    //Update an employee password
    public function update_pass($id, $hash){
        $sql = "UPDATE employees SET password='$hash', sp=NULL WHERE id='$id'";
        $this->connect()->query($sql);
    }
    public function update_test($id){
        $sql = "UPDATE employees SET rfid='420' WHERE id='$id'";
        $this->connect()->query($sql);
    }
    //Update an employee hours
    public function update_blocks($id, $blocks){
        $sql = "UPDATE employees SET blocks='$blocks' WHERE id='$id'";
        $this->connect()->query($sql);
    }
    //Give Employee a sp value
    public function sp_set($str, $email){
        $sql = "UPDATE employees SET sp='$str' WHERE email='$email'";
        $this->connect()->query($sql);
    }
    //Get it all!
    public function select(){
        $sql = "SELECT * FROM employees";
        $result = $this->connect()->query($sql);
        if($result->rowCount() > 0){
            while($row = $result->fetch()){
                $data[] = $row;
            }
            return $data;
        }
    }
    //Delete employee
    public function delete($id){
        $sql = "DELETE FROM employees WHERE id='$id'";
        $this->connect()->query($sql);
    }
    //Make a different volunteer manager
    public function transfer_sudo($id_next, $id_curr){
        $sql = "UPDATE employees SET sudo='1' WHERE id='$id_next'";
        $this->connect()->query($sql);
        $sql = "UPDATE employees SET sudo=NULL WHERE id='$id_curr'";
        $this->connect()->query($sql);
    }
    //Get the hours!
    public function get_blocks(){
        $sql = "SELECT blocks FROM employees";
        $result = $this->connect()->query($sql);
        if($result->rowCount() > 0){
            while($row = $result->fetch()){
                $data[] = $row;
            }
            return $data;
        }
    }
    //Check Password
    public function check_pass($input){
        return 0;
    }
    //Check Email
    public function check_email($input){
        return 0;
    }
}
?>