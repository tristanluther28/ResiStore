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
            $employee = new Employee();
            if(isset($_GET["email"]) && isset($_GET["sp"])){
                require_once "../support/nav.php";
                $email = $employee->escape($_GET['email']);
                $sp = $employee->escape($_GET['sp']);
                $_SESSION['result'] = $employee->get_from_emandsp($email, $sp);
            }
            if(isset($_POST['submit'])){
                $password = $employee->escape($_POST['password']);
                $confirm_password = $employee->escape($_POST['confirm_password']);
                if($password != $confirm_password){
                    $msg = "Error: passwords do not match";
                }
                else{
                    //Update the password
                    $id = $_SESSION['result'];
                    $hash = password_hash($password, PASSWORD_BCRYPT);
                    $employee->update_pass($id, $hash);
                    header("Location: index.php");
                    exit();
                }
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
                        <div class="form-group">
                            <input name ="submit" type="submit" class="btn btn-info" value="Submit">
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