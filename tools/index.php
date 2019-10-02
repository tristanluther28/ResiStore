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
            if(isset($_SESSION['id']) && $_SESSION['sudo'] == '1'){
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
                        if(isset($_SESSION['id']) && $_SESSION['sudo'] == '1'){
                    ?>
                        <h1 class="alter">Manager Tools</h1>
                        <hr>
                    </div>
                    <div class="col-lg-4 text-center">
                        <a href="../tools/signup.php"><span class="glyphicon glyphicon-tasks"></span>
                        <h2 class="alter">Register Volunteers</h2></a>
                    </div>
                    <div class="col-lg-4 text-center">
                        <a href="../tools/managevol.php"><span class="glyphicon glyphicon-user"></span>
                        <h2 class="alter">Manage Volunteers</h2></a>
                    </div>
                    <div class="col-lg-4 text-center">
                        <a href="../tools/manageprod.php"><span class="glyphicon glyphicon-pencil"></span>
                        <h2 class="alter">Edit Products</h2></a>
                    </div>
                </div>
                <br><br>
                <div class="row mt centered">
                    <div class="col-lg-4 text-center">
                        <a href="../tools/lowInv.php"><span class="glyphicon glyphicon-sort-by-attributes-alt"></span>
                        <h2 class="alter">Check Low Inventory</h2></a>
                    </div>
                    <div class="col-lg-4 text-center">
                        <a href="../tools/report.php"><span class="glyphicon glyphicon-list"></span>
                        <h2 class="alter">POS Report</h2></a>
                    </div>
                    <div class="col-lg-4 text-center">
                        <a href="../tools/resign.php"><span class="glyphicon glyphicon-alert"></span>
                        <h2 class="alter">Select Manager</h2></a>
                    </div>
                </div>
                <br><br>
                <div class="row mt centered">
                    <div class="col-lg-4 text-center">
                        <a href="../tools/camera.php"><span class="glyphicon glyphicon-camera"></span>
                        <h2 class="alter">Check Store Cameras</h2></a>
                    </div>
                    <div class="col-lg-4 text-center">
                        <a href="../tools/doorView.php"><span class="glyphicon glyphicon-book"></span>
                        <h2 class="alter">Door RFID Log</h2></a>
                    </div>
                    <div class="col-lg-4 text-center">
                        <a href="../sub_tools/signup_osurc.php"><span class="glyphicon glyphicon-save-file"></span>
                        <h2 class="alter">Register Club Member</h2></a>
                    </div>
                </div>
                    <?php
                        }
                        else{
                            header("Location: ../404.php");
                            exit();
                        }
                    ?>
            </div>
        </div>
        <br><br><br>
    <?php
            require_once "../support/footer.php";
    ?>
    </body>
</html>