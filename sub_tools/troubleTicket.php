<?php
    $level = '../';
    session_start();
    include_once('../classes/Db.php');
    include_once('../classes/Product.php');
    include_once('../classes/Employee.php');
    
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
            $msg = "";
            if(isset($_SESSION['id'])){
                require_once "../support/nav.php";
            }
            else{
                header("Location: ../404.php");
                exit();
            }
            if(isset($_POST['submit'])){
                //Send the email
                $mail = New PHPMailer();
                $employee = New Employee();
                //Set a host for mailer
                $mail->Host = "smtp.gmail.com";
                //Enable SMTP (Simple Mail Transfer Protocal) Might not be needed, depends on platform
                $mail->isSMTP();
                //Set Mailer Authentication
                $mail->SMTPAuth = true;
                //Set the email being used to send the email
                $mail->Username = "resiStore.bot@gmail.com";
                $mail->Password = "StoresRock";
                //Set type of protection
                $mail->SMTPSecure = "ssl"; //TLS is also an option
                //Set Port
                $mail->Port = 465; //587 if TLS
                //Set the subject
                $mail->Subject = "ResiStore Trouble Ticket [OSURCStore]";
                $rows = $employee->select();
                $problem = "";
                if($rows != NULL){
                    foreach($rows as $row){
                        if($row['sudo'] == 1){
                            //Get the manager email
                            //If more than one manager exist the last read manager will get the email
                            $man_email = $row['email'];
                        }
                        else if($_SESSION['id'] == $row['id']){
                            //Get the user's name for the email
                            $user_name = $row['firstName']." ".$row['lastName'];
                        }
                    }
                }
                if($_POST['problem'] == "out"){
                    $problem = "Item Out of Stock";
                }
                elseif($_POST['problem'] == "request"){
                    $problem = "Item Requested";
                }
                elseif($_POST['problem'] == "other"){
                    $problem = "Other";
                }
                else{
                    $problem = "Not Specified";
                }
                $plu = $_POST['plu'];
                $class = $_POST['class'];
                $info = $_POST['info'];
                $body = "Item PLU: $plu \r\nProblem: $problem \r\n\nIs the item needed for a class?: $class \r\n\nMore Info: $info\r\n\nSubmitted by: $user_name";
                //Set the body of the email
                $mail->Body = $body;
                //Set who the email is from
                $mail->setFrom('resiStore.bot@gmail.com', 'ResiStore Bot');
                //Set where we are sending the email
                $mail->addAddress($man_email);
                //Send the email
                if($mail->send()){
                    $msg = "Ticket has been submitted!";
                }
                else{
                    $msg = "Ticket not submitted, please contact manager!";
                }
            }
        ?>
        <div class="container pt">
        <br><br>
        <div class="row mt centered">
                <div class="text-center">
                    <?php
                        if(isset($_SESSION['id'])){
                    ?>
                        <h1 class="alter">Submit Trouble Ticket</h1>
                        <hr>
                </div>
                        <p class="white text-left">
                        If an item that is either out of stock or not in inventory is requested, then you can submit a trouble ticket
                        to the manager. Be sure to specify if this item is required for a class or not.
                        </p>
                        <form action="" method="post">
                            <div class="form-group white">
                                <label class="white">Problem</label><br>
                                <input type="radio" name="problem" value="out"> Item Out of Stock<br>
                                <input type="radio" name="problem" value="request"> Item Requested<br>
                                <input type="radio" name="problem" value="other"> Other<br>
                            </div>
                            <div class="form-group">
                                <label class="white">PLU of Item:</label>
                                <input type="number" name="plu" class="form-control">
                            </div>
                            <div class="form-group white">
                                <label class="white">Is the requested item needed for a class?</label><br>
                                <input type="radio" name="class" value="Yes"> Yes<br>
                                <input type="radio" name="class" value="No"> No<br>
                            </div>
                            <div class="form-group">
                                <label class="white">More Info:</label>
                                <input type="text" name="info" class="form-control">
                            </div>
                            <div class="form-group">
                                <input name ="submit" type="submit" class="btn btn-info" value="Submit">
                                <input name ="reset" type="reset" class="btn btn-default" value="Reset">
                            </div>
                        </form>
                        <div class="msg-box">
                            <h2 class="white">
                            <?php
                                echo $msg;
                            ?>
                            </h2>
                        </div>
                    <?php
                        }
                        else{
                            header("Location: ../404.php");
                            exit();
                        }
                    ?>
        </div>
        <br><br><br>
    <?php
            require_once "../support/footer.php";
    ?>
    </body>
</html>