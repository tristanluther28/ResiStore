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
            if(isset($_SESSION['id']) && $_SESSION['sudo'] == '1'){
                $error_msg = "";
                $pos_msg = "";
                if(isset($_POST['submit'])){
                    $employee = new Employee();
                    $firstName = $employee->escape($_POST['firstName']);
                    $lastName = $employee->escape($_POST['lastName']);
                    $osuid = $employee->escape($_POST['osuid']);
                    $email = $employee->escape($_POST['email']);
                    $password = $employee->escape($_POST['password']);
                    $confirm_password = $employee->escape($_POST['confirm_password']);
                    $rfid = $employee->escape($_POST['rfid']);
                    $blocks = implode(",",$_POST["blocks"]);
                    if($password != $confirm_password){
                        $error_msg =  "Error: passwords do not match";
                    }
                    else{
                        $hash = password_hash($password, PASSWORD_BCRYPT);
                        $employee->insert_data($firstName, $lastName, $osuid, $email, $hash, $rfid, $blocks);
                        $pos_msg = "You have been registered!";
                        header("Location: index.php");
                        exit();
                    }
                }
            }
            else{
                header("Location: ../404.php");
                exit();
            }
        ?>
        <div class="container pt">
            <div class="row mt centered">
                <div class="col-lg-3 col-md-4 col-sm-5">
                    <br>
                    <?php
                    if($error_msg != ""){
                    ?>
                    <h4 class="error-msg">
                    <?php
                        echo $error_msg; 
                    ?>
                    </h4>
                    <?php
                    }
                    ?>
                    <?php
                    if($pos_msg != ""){
                    ?>
                    <h4 class="pos-msg">
                    <?php
                        echo $pos_msg; 
                    ?>
                    </h4>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>

        <?php
            require_once "../support/footer.php";
        ?>
    </body>
</html>