<?php
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
            $error_msg = "";
            $pos_msg = "";
            $msg = "";
            if(isset($_POST['submit'])){
                $employee = new Employee();
                $email = $employee->escape($_POST['email']);
                $password = $employee->escape($_POST['password']);
                $result = $employee->check_credentials($email, $password);
                if($result->rowCount() > 0){
                    $data = $result->fetch();
                    if(password_verify($password, $data['password'])){
                        $msg = "You have been logged in";
                        $_SESSION['id'] = $data['id'];
                        $_SESSION['firstName'] = $data['firstName'];
                        $_SESSION['lastName'] = $data['lastName'];
                        $_SESSION['sudo'] = $data['sudo'];
                        $_SESSION['last_login_time'] = time();
                        header("Location: ../index.php");
                        exit();
                        //redirect to index
                    }
                    else{
                        $msg = "Your password was not recognized";
                    }
                }
                else{
                    $msg = "Your email/password was not recognized";
                }
            }
        ?>
        <div class="container pt">
            <div class="row mt centered">
                <div class="col-lg-3 col-md-4 col-sm-5">
                <br>
                <?php
                    if($msg != ""){
                ?>
                    <h4 class="error-msg"><?php echo $msg ?></h4>
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