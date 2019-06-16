<?php
class Door extends Db {
    //Fix input with escape characters
    function escape($value){
        $search = array("\\",  "\x00", "\n",  "\r",  "'",  '"', "\x1a");
        $replace = array("\\\\","\\0","\\n", "\\r", "\'", '\"', "\\Z");
    
        return str_replace($search, $replace, $value);
    }
    //Insert a new door data
    public function insert_data($firstName, $lastName, $rfid, $successful){
        $sql = "INSERT INTO door (firstName, lastName, rfid, successful) VALUES ('$firstName', '$lastName', '$rfid', '$successful')";
        $this->connect()->query($sql);
    }
    //Get it all!
    public function select(){
        $sql = "SELECT * FROM door";
        $result = $this->connect()->query($sql);
        if($result->rowCount() > 0){
            while($row = $result->fetch()){
                $data[] = $row;
            }
            return $data;
        }
    }
    //Delete employee
    public function delete(){
        $sql = "DELETE FROM door";
        $this->connect()->query($sql);
    }
}