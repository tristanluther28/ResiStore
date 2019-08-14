<?php
    /*  
        Filename: auth_v3.php
        Author: Tristan Luther
        Date: 05/21/2019
        Purpose: Grant access to club rooms from data in club SQL database/Replace google scripts/sheets system.
    */

    /*
        Function for autoloading all of the classes located in the classes folder. 
        The classes folder includes the employee object (may change to member object...)
    */
    function __autoload($class){
        require_once "../resi.store/classes/$class.php";
    }

    date_default_timezone_set("America/Los_Angeles");

    header('Content-Type: application/json');

    $employee = new Employee(); //New employee object for ResiStore
    $member = new Member(); //New member object for Clab
    $door = new Door(); //New door object for tracking of who enters where and when (Currently only applies for ResiStore)

    $rfid_recieved = $employee->escape($_GET['rfid_number']); //Recieve RFID number via GET request
    $access_name = $_GET['access_name']; //Recieve requested room via GET request (clab or store)

    if($access_name == 'club_store'){ //The string 'club_store' was determined by the particle script to determine what is being accessed (more locations can be added in the future)
        $rows = $employee->search_rfid($rfid_recieved); //From the Employee (member) class called the function to see if they have an rfid number in the database
        //Check if returned value is not NULL
        if($rows != NULL){
            //Access Granted
            $row = $rows[0]; //The first element of the array returned by the function will be the members information
            //Check if this person has permissions
            if($row['store_access'] == 1){
                //JSON data follows the following template: exists in database, first name, last name, has access
                $data = array('known' => 'True', 'first' => $row['firstName'], 'last' => $row['lastName'], 'has_auth' => true);
                echo (json_encode($data));
                $door->insert_data($row['firstName'], $row['lastName'], $rfid_recieved, 1);
                return json_encode($data);

            }
            //User is in database but doesn't have store access
            else{
                //Unauthorized User: Access Denied
                //JSON data follows the following template: exists in database, first name, last name, has access
                $data = array('known' => 'True', 'first' => $row['firstName'], 'last' => $row['lastName'], 'has_auth' => false);
                echo (json_encode($data));
                $door->insert_data($row['firstName'], $row['lastName'], $rfid_recieved, 0);
                return json_encode($data);
            }
        }
        //If returned value is NULL then user is not in database
        else{
            //Unauthorized User: Access Denied
            //JSON data follows the following template: exists in database, first name, last name, has access
            $data = array('known' => 'False', 'first' => $row['firstName'], 'last' => $row['lastName'], 'has_auth' => false);
            echo (json_encode($data));
            $door->insert_data("Unknown", NULL, $rfid_recieved, 0);
            return json_encode($data);
        } 
    }
    else if($access_name == 'clab'){ //The string 'clab' was determined by the particle script to determine what is being accessed (more locations can be added in the future)
        $rows = $member->search_rfid($rfid_recieved); //From the Employee (member) class called the function to see if they have an rfid number in the database
        //Check if returned value is not NULL
        if($rows != NULL){
            //Access Granted
            $row = $rows[0]; //The first element of the array returned by the function will be the members information
            //Check if this person has permissions
            if($row['clab_access'] == "1"){
                //JSON data follows the following template: exists in database, first name, last name, has access
                $data = array('known' => 'True', 'first' => $row['firstName'], 'last' => $row['lastName'], 'has_auth' => true);
                echo (json_encode($data));
                return json_encode($data);

            }
            //User is in database but doesn't have clab access
            else{
                //Unauthorized User: Access Denied
                //JSON data follows the following template: exists in database, first name, last name, has access
                $data = array('known' => 'True', 'first' => $row['firstName'], 'last' => $row['lastName'], 'has_auth' => false);
                echo (json_encode($data));
                return json_encode($data);
            }
        }
        //If returned value is NULL then user is not in database
        else{
            //Unauthorized User: Access Denied
            //JSON data follows the following template: exists in database, first name, last name, has access
            $data = array('known' => 'False', 'first' => $row['firstName'], 'last' => $row['lastName'], 'has_auth' => false);
            echo (json_encode($data));
            return json_encode($data);
        } 
    }
    else{
        //Unauthorized User: Access Denied (No location specified...)
        //JSON data follows the following template: exists in database, first name, last name, has access
        $data = array('known' => 'False', 'first' => $row['firstName'], 'last' => $row['lastName'], 'has_auth' => false);
        echo (json_encode($data));
        return json_encode($data);
    }
?>