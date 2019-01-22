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
            require_once "../support/nav.php";
        ?>
        <?php
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
                        $_SESSION['sudo'] = $data['sudo'];
                        $_SESSION['last_login_time'] = time();
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
                <div class="col-lg-3 col-md-4 col-sm-4">
                    <h1 class="alter">Sign In</h1>
                    <p class="white">Your ResiStore Volunteer account grants you access to the ResiStore. 
                    <br><br>Your volunteer hours are also saved through your account to keep the website hours up-to-date.</p>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-5">
                    <br>
                    <?php
                        if($msg != ""){
                    ?>
                    <h4 class="error-msg"><?php echo $msg ?></h4>
                    <?php
                        }
                    ?>
                    <form action="../login/auth.php" method="post">
                        <div class="form-group">
                            <label class="white">E-mail</label>
                            <input type="email" name="email" class="form-control" required>
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group">
                            <label class="white">Password</label>
                            <span class="forgot-password">
                                <a href="../login/forgotpass.php">Forgot your password?</a>
                            </span>
                            <input type="password" name="password" class="form-control" required>
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group">
                            <input name ="submit" type="submit" class="btn btn-info" value="Submit">
                            <input type="reset" class="btn btn-default" value="Reset">
                        </div>
                        <p class="white">Want to Volunteer? <a href="../getinvolved">Get Involved</a>.</p>
                    </form>
                </div>
            </div>
        </div>
        <?php
            require_once "../support/footer.php";
        ?>
    </body>
</html>
