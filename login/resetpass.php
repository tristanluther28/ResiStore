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
            if(isset($_GET["email"]) && isset($_GET["sp"])){
                require_once "../support/nav.php";
                $employee = new Employee();
                $email = $employee->escape($_GET['email']);
                $sp = $employee->escape($_GET['sp']);
                $password = $employee->escape($_POST['password']);
                $confirm_password = $employee->escape($_POST['confirm_password']);
                $result = $employee->get_from_emandsp($email, $sp);
                if($result->rowCount() > 0){
                    if($password != $confirm_password){
                        echo  "Error: passwords do not match";
                    }
                    else{
                        $hash = password_hash($password, PASSWORD_BCRYPT);
                        $employee->update_pass($email, $hash);
                    }
                }
                else{
                    echo "Error: password link integrity failed";
                }
            }
            else{
                header("Location: login.php");
                exit();
            }
        ?>
        <div class="container pt">
            <div class="row mt centered">
                <div class="col-lg-3 col-md-4 col-sm-4">
                    <h1 class="alter">Reset Password</h1>
                    <br>
                    <p class="white">Fill out the form to change your password.</p>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-5">
                    <form action="../login/resetpass.php" method="post">
                    <div class="form-group">
                            <label class="white">New Password</label>
                            <input type="password" minLength="5" name="password" class="form-control" value="">
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group">
                            <label class="white">Confirm New Password</label>
                            <input type="password" minLength="5" name="confirm_password" class="form-control">
                            <span class="help-block"></span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php
            require_once "../support/footer.php";
        ?>
    </body>
</html>