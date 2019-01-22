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
            if(isset($_POST['submit'])){
                $employee = new Employee();
                $email = $employee->escape($_POST['email']);
                $result = $employee->get_from_email($email);
                if($result->rowCount() > 0){
                    $str = "qpownfgsaifr84h2f9hb331gGGFH8gbfHGDGTRGdUYfytrdytrYTF";
                    $str = str_shuffle($str);
                    $str = substr($str, 0, 10);
                    $url = "localhost/php/resetpass.php?sp=$str&email=$email"; //MUST CHANGE WHEN A DOMAIN IS ESTABLISHED
                    /*
                        Do not uncomment to test until on a hosting platform. Will cause failure.
                    */
                    //mail($email, "ResiStore Password Reset", "To reset your ResiStore password, follow this link: $url", "From: tristanluther28@gmail.com\r\n"); //Change email sender when made
                    $employee->sp_set($str, $email);
                    echo "Please check your email";
                }
                else{
                    echo "This email was not found";
                }
            }
        ?>
        <div class="container pt">
            <div class="row mt centered">
                <div class="col-lg-3 col-md-4 col-sm-5">
                    <h1 class="alter">Forgot Password</h1>
                    <br>
                    <p class="white">An email will be sent to your address to reset your password.</p>
                    <br>
                    <form action="../login/forgotpass.php" method="post">
                        <div class="form-group">
                            <label class="white">E-mail</label>
                            <input type="email" name="email" class="form-control" required>
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