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
                    ?>
                        <h1 class="alter">Volunteer Resources</h1>
                        <hr>
                    </div>
                    <div class="col-lg-4 text-center">
                        <a href="../sub_tools/editHours.php"><span class="glyphicon glyphicon-time"></span>
                        <h2 class="alter">Change My Hours</h2></a>
                    </div>
                    <div class="col-lg-4 text-center">
                        <a href="../sub_tools/troubleTicket.php"><span class="glyphicon glyphicon-send"></span>
                        <h2 class="alter">Submit Trouble Ticket</h2></a>
                    </div>
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