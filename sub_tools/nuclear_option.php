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
                if (isset($_POST['submit'])){
                    $member = new Member();
                    $member->nuclear_option();
                    header("Location: edit_osurc.php");
                    exit();
                }
                else if(isset($_POST['cancel'])){
                    header("Location: edit_osurc.php");
                    exit();
                }
            }
        ?>
        <div class="container pt">
            <div class="row mt centered">
            <?php
                if(isset($_SESSION['id']) && ($_SESSION['sudo'] == '1' || $_SESSION['sudo'] == '2')){
            ?>
                <h1 class="alter">Delete All OSURC Members?</h1>
                <hr>
                <form method="post" action="../sub_tools/nuclear_option.php">
                    <div class="form-group">
                        <label class="white">Are you sure you want to delete the current OSURC Members? The club officers who are identified in the database will not be deleted. This data is not recoverable.</label>
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