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
            if(isset($_SESSION['id']) && $_SESSION['sudo'] == '1'){
                if (isset($_POST['submit'])){
                    $door = new door();
                    $door->delete();
                    header("Location: doorView.php");
                    exit();
                }
                else if(isset($_POST['cancel'])){
                    header("Location: doorView.php");
                    exit();
                }
            }
        ?>
        <div class="container pt">
            <div class="row mt centered">
            <?php
                if(isset($_SESSION['id']) && $_SESSION['sudo'] == '1'){
            ?>
                <h1 class="alter">Delete Door RFID Log?</h1>
                <hr>
                <form method="post" action="../tools/deleteDoor.php">
                    <div class="form-group">
                        <label class="white">Are you sure you want to delete the current door RFID log? This data is not recoverable.</label>
                        <br>
                        <input name="submit" type="submit" class="btn btn-success" value="Delete">
                        <input name="cancel" type="submit" class="btn btn-danger" value="Cancel">
                    </div>
                </form>
            <?php
                }
                else{
                    header("Location: ../404.php");
                    exit();
                }
            ?>
            </div>
        </div>
        <?php
            require_once "../support/footer.php";
        ?>
    </body>
</html>