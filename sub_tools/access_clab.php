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
                $id = $_GET['id'];
                $a = $_GET['a'];
                $member = new Member();
                if($a == 1){
                    $member->grant_access($id);
                }
                else if($a == 0){
                    $member->revoke_access($id);
                }
                else{
                    echo "Error: action is not set!";
                }
                header("Location: edit_osurc.php");
            }
            else{
                header("Location: 404.php");
                exit();
            }
        ?>
        <?php
            require_once "../support/footer.php";
        ?>
    </body>
</html>