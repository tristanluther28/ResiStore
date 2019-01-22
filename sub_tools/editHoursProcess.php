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
            if(isset($_SESSION['id'])){
                $error_msg = "";
                $pos_msg = "";
                if(isset($_POST['submit'])){
                    $employee = new Employee();
                    $blocks = implode(",",$_POST["blocks"]);
                    $employee->update_blocks($_SESSION['id'], $blocks);
                    $pos_msg = "You have changed your hours!";
                    header("Location: editHours.php");
                    exit();
                }
                else{
                    $error_msg = "Error Updating Hours: Please Contact Manager";
                }
            }
            else{
                header("Location: ../404.php");
                exit();
            }
        ?>
        <div class="container pt">
            <div class="row mt centered">
                <div class="col-lg-3 col-md-4 col-sm-5">
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
            require_once "../support/footer.php";
        ?>
    </body>
</html>