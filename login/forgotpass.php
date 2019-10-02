<?php
    $level = '../';
    function __autoload($class){
        require_once "../classes/$class.php";
    }
    session_start();

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require '../phpmailer/src/Exception.php';
    require '../phpmailer/src/PHPMailer.php';
    require '../phpmailer/src/SMTP.php';
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
                $mail = New PHPMailer();
                $mail->Host = "smtp.gmail.com";
                $mail->isSMTP();
                $mail->SMTPAuth = true;
                $mail->Username = "resiStore.bot@gmail.com";
                $mail->Password = "StoresRock";
                $mail->SMTPSecure = "ssl"; //Can also be TLS
                $mail->Port = 465; //587 if TLS
                $mail->Subject = "ResiStore Password Reset";
                
                $email = $employee->escape($_POST['email']);
                $result = $employee->get_from_email($email);
                if($result->rowCount() > 0){
                    $str = "qpownfgsaifr84h2f9hb331gGGFH8gbfHGDGTRGdUYfytrdytrYTF";
                    $str = str_shuffle($str);
                    $str = substr($str, 0, 10);
                    $url = "http://resi.store/login/resetpass.php?sp=$str&email=$email"; //MUST CHANGE WHEN A DOMAIN IS ESTABLISHED
                    $mail->Body = "\nTo reset your ResiStore password, follow this link: $url";
                    $mail->setFrom('resiStore.bot@gmail.com', 'ResiStore Bot');
                    $mail->addAddress($email);
                    //Send the email
                    if($mail->send()){
                        $msg = "Please check your email!";
                    }
                    else{
                        $msg = "Not sent, please contact store manager!";
                    }
                    $employee->sp_set($str, $email);
                }
                else{
                    $msg = "This email was not found";
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
                    <div class="msg-box">
                            <h2 class="white">
                            <?php
                                echo $msg;
                            ?>
                            </h2>
                        </div>
                </div>
            </div>
        </div>
        <?php
            require_once "../support/footer.php";
        ?>
    </body>
</html>