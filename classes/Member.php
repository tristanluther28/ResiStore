<?php
class Member extends Db {
    //Fix input with escape characters
    function escape($value){
        $search = array("\\",  "\x00", "\n",  "\r",  "'",  '"', "\x1a");
        $replace = array("\\\\","\\0","\\n", "\\r", "\'", '\"', "\\Z");
    
        return str_replace($search, $replace, $value);
    }
    //Get it all!
    public function select(){
        $sql = "SELECT * FROM members";
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
        $sql = "SELECT * FROM members WHERE rfid='$rfid'";
        $result = $this->connect()->query($sql);
        if($result->rowCount() > 0){
            while($row = $result->fetch()){
                $data[] = $row;
            }
            return $data;
        }
    }
    //Get from id
    public function search_id($id){
        $sql = "SELECT * FROM members WHERE id='$id'";
        $result = $this->connect()->query($sql);
        if($result->rowCount() > 0){
            while($row = $result->fetch()){
                $data[] = $row;
            }
            return $data;
        }
    }
    //Remove an employee access to the store
    public function revoke_access($id){
        $sql = "UPDATE members SET clab_access=0 WHERE id='$id'";
        $this->connect()->query($sql);
    }
    //Give an employee access to the store
    public function grant_access($id){
        $sql = "UPDATE members SET clab_access=1 WHERE id='$id'";
        $this->connect()->query($sql);
    }
    //Update a member
    public function update($id, $firstName, $lastName, $email, $osu_id, $major, $rfid, $opt){
        $sql = "UPDATE members SET firstName='$firstName', lastName='$lastName', 
        email='$email', osu_id='$osu_id', major='$major', rfid='$rfid', opt='$opt' WHERE id='$id'"; 
        $this->connect()->query($sql);
    }
    //Delete employee
    public function delete($id){
        $sql = "DELETE FROM members WHERE id='$id'";
        $this->connect()->query($sql);
    }
    //Insert a new members data
    public function insert_data($firstName, $lastName, $osuid, $email, $rfid, $interests, $major, $standing, $option, $approved){
        if($option == '$0 - Payment Pending'){
            $sql = "INSERT INTO members (firstName, lastName, email, rfid, osu_id, interests, major, standing, opt, clab_access, approved) VALUES ('$firstName', '$lastName', '$email', '$rfid', '$osuid', '$interests', '$major', '$standing', '$option', 0, '$approved')";
        }
        else{
            $sql = "INSERT INTO members (firstName, lastName, email, rfid, osu_id, interests, major, standing, opt, clab_access, approved) VALUES ('$firstName', '$lastName', '$email', '$rfid', '$osuid', '$interests', '$major', '$standing', '$option', 1, '$approved')";
        }
        $this->connect()->query($sql);
    }
    //Delete everything besides officers
    public function nuclear_option(){
        $sql = "DELETE FROM members WHERE officer_class IS NULL";
        $this->connect()->query($sql);
    }
}
?>