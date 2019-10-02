<?php
class Member extends Db {
    //Fix input with escape characters
    function escape($value){
        $search = array("\\",  "\x00", "\n",  "\r",  "'",  '"', "\x1a");
        $replace = array("\\\\","\\0","\\n", "\\r", "\'", '\"', "\\Z");
    
        return str_replace($search, $replace, $value);
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
    //Delete employee
    public function delete($id){
        $sql = "DELETE FROM members WHERE id='$id'";
        $this->connect()->query($sql);
    }
    //Insert a new employee's data
    public function insert_data($firstName, $lastName, $osuid, $email, $rfid, $interests, $major, $standing, $option, $approved){
        $sql = "INSERT INTO members (firstName, lastName, email, rfid, osu_id, interests, major, standing, opt, clab_access, approved) VALUES ('$firstName', '$lastName', '$email', '$rfid', '$osuid', '$interests', '$major', '$standing', '$option', 1, '$approved')";
        $this->connect()->query($sql);
    }
}
?>