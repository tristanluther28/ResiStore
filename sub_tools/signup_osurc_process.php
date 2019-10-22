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
            if(isset($_SESSION['id']) && ($_SESSION['sudo'] == '1' || $_SESSION['sudo'] == '2')){
                $error_msg = "";
                $pos_msg = "";
                if(isset($_POST['submit'])){
                    $member = new Member();
                    $firstName = $member->escape($_POST['firstName']);
                    $lastName = $member->escape($_POST['lastName']);
                    $osuid = $member->escape($_POST['osuid']);
                    $email = $member->escape($_POST['email']);
                    $rfid = $member->escape($_POST['rfid']);
                    $interests = implode(",",$_POST['intr']);
                    $major = $member->escape($_POST['major']);
                    $standing = $member->escape($_POST['standing']);
                    $option = $_POST['op'];
                    //ADD: Keep it all (Add $approved based on current user signed in)
                    $member->insert_data($firstName, $lastName, $osuid, $email, $rfid, $interests, $major, $standing, $option, $_SESSION['name']);
                    $pos_msg = "You have been registered!";
                    if($_SESSION['sudo'] != '1'){
                        ?>
                        <div class="container pt">
                            <div class="row mt centered">
                                <div class="col-lg-8 col-md-8 col-sm-8">
                                <div class="">
                                    <h2 class="white">Would you like to register another member?</h2>
                                    <div class="input-group-btn">
                                        <a href="signup_osurc.php"><button type="" class="btn-lg btn-success">Yes</button></a>
                                        <a href="index.php"><button type="" class="btn-lg btn-danger">No</button></a>
                                    </div>
                                </div>
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
                    }
                    else{
                        header("Location: ../tools/index.php");
                        exit();
                    }
                }
            }
            else{
                header("Location: ../404.php");
                exit();
            }
        ?>
<?php
    require_once "../support/footer.php";
?>
</body>
</html>