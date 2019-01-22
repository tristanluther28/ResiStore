<?php
    if(session_id() == '') { // start session if none found
        session_start();
    }
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
    unset($_SESSION['id']);
    unset($_SESSION['sudo']);
    header("Location: index.php");
    exit();
?>