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
                if (isset($_POST['submit'])){
                    $member = new Member();
                    $id = $_GET['id'];
                    $rows = $member->search_id($id);
                    $row = $rows[0];
                    $firstName = $member->escape($_POST['firstName']);
                    $lastName = $member->escape($_POST['lastName']);
                    $email = $member->escape($_POST['email']);
                    $osu_id = $member->escape($_POST['osu_id']);
                    $major = $member->escape($_POST['major']);
                    $rfid = $member->escape($_POST['rfid']);
                    $opt = $member->escape($_POST['opt']);
                    $member->update($id, $firstName, $lastName, $email, $osu_id, $major, $rfid, $opt);
                    header("Location: edit_osurc.php");
                    exit();
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