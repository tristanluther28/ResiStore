<?php
    $level = '../';
    function __autoload($class){
        require_once "../classes/$class.php";
    }
    session_start();
?>
<html>
    <head>
        <?php
            require_once "../support/head.php";
        ?>
    </head>
    <body>
        <?php
            require_once "../support/nav.php";
        ?>
        <?php
            $error_msg = "";
            $pos_msg = "";
            if(isset($_POST['submit'])){
                $employee = new Employee();
                $firstName = $employee->escape($_POST['firstName']);
                $lastName = $employee->escape($_POST['lastName']);
                $email = $employee->escape($_POST['email']);
                $password = $employee->escape($_POST['password']);
                $confirm_password = $employee->escape($_POST['confirm_password']);
                $rfid = $employee->escape($_POST['rfid']);
                if($password != $confirm_password){
                    $error_msg =  "Error: passwords do not match";
                }
                else{
                    $hash = password_hash($password, PASSWORD_BCRYPT);
                    $employee->insert_data($firstName, $lastName, $email, $hash, $rfid);
                    $pos_msg = "You have been registered!";
                }
            }
        ?>
        <div class="container pt">
            <div class="row mt centered">
                <div class="col-lg-3 col-md-4 col-sm-4">
                    <h1 class="alter">Get Involved</h1>
                    <p class="white">Any OSU student can become a ResiStore Volunteer! 
                    <br><br>Volunteer registration and training takes place during week one of the term. 
                    You can reserve a spot for training from an email sent out by the manager at the beginning 
                    of the term. 
                    <br><br>However, if the term is in progress and you would like to begin volunteering 
                    now, you can email the store manager at resistore-owner@oregonstate.edu to see if a shift is avaliable.
                    <br><br>
                    <p class="white">Already a Volunteer? <a href="../login">Login here</a>.</p>
                    </p>
                </div>
                <div class="col-lg-6 col-md-5 col-sm-5">
                    <img class="img-responsive store-gif" src="../img/safe/revival.gif" alt="ResiStore!">
                </div>
            </div>
        </div>
        <?php
            require_once "../support/footer.php";
        ?>
    </body>
</html>