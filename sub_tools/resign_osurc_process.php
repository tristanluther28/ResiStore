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
                if (isset($_POST['submit'])){
                    $employee = new Employee();
                    $employee->transfer_officer($id, $_SESSION['id']);
                    header("Location: ../index.php");
                    exit();
                }
                else if(isset($_POST['cancel'])){
                    header("Location: resign_osurc.php");
                    exit();
                }
            }
        ?>
        <div class="container pt">
            <div class="row mt centered">
            <?php
                if(isset($_SESSION['id']) && ($_SESSION['sudo'] == '1' || $_SESSION['sudo'] == '2')){
            ?>
                <h1 class="alter">Confirm Transfer?</h1>
                <hr>
                <form method="post" action="../sub_tools/resign_osurc_process.php?id=<?php echo $_GET['id'] ?>">
                    <div class="form-group">
                        <label class="white">
                            Are you sure you want to make this member an officer? 
                            This will revoke your officer tools access, but you will gain standard member status.
                        </label>
                        <br>
                        <input name="submit" type="submit" class="btn btn-success" value="Confirm">
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