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
            if(isset($_SESSION['id'])){
                require_once "../support/nav.php";
            }
            else{
                header("Location: ../404.php");
                exit();
            }
        ?>
        <div class="container pt">
        <br><br>
        <div class="row mt centered">
                <div class="text-center">
                    <?php
                        if(isset($_SESSION['id'])){
                            if($_SESSION['sudo'] == '2'){
                    ?>
                        <h1 class="alter">Officer Resources</h1>
                        <hr>
                    </div>
                    <?php
                            }
                            else{
                    ?>
                        <h1 class="alter">Volunteer Resources</h1>
                        <hr>
                    </div>
                    <?php
                            }
                    ?>
                    <div class="col-lg-4 text-center">
                        <a href="../sub_tools/editHours.php"><span class="glyphicon glyphicon-time"></span>
                        <h2 class="alter">Change My Hours</h2></a>
                    </div>
                    <div class="col-lg-4 text-center">
                        <a href="../sub_tools/troubleTicket.php"><span class="glyphicon glyphicon-send"></span>
                        <h2 class="alter">Submit Trouble Ticket</h2></a>
                    </div>
                    <?php
                        if($_SESSION['sudo'] == '2'){
                    ?>
                    <div class="col-lg-4 text-center">
                        <a href="../sub_tools/signup_osurc.php"><span class="glyphicon glyphicon-save-file"></span>
                        <h2 class="alter">Register Club Member</h2></a>
                    </div>
                    <?php
                        }
                    ?>
                </div>
                <br><br>
                
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