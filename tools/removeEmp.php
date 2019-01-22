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
                $id = $_GET['id'];
                if (isset($_POST['submit'])){
                    $employee = new Employee();
                    $employee->delete($id);
                    header("Location: managevol.php");
                    exit();
                }
                else if(isset($_POST['cancel'])){
                    header("Location: managevol.php");
                    exit();
                }
            }
        ?>
        <div class="container pt">
            <div class="row mt centered">
            <?php
                if(isset($_SESSION['id']) && $_SESSION['sudo'] == '1'){
            ?>
                <h1 class="alter">Remove Volunteer?</h1>
                <hr>
                <form method="post" action="../tools/removeEmp.php?id=<?php echo $_GET['id'] ?>">
                    <div class="form-group">
                        <label class="white">Are you sure you want to remove this volunteer? This will revoke register and store access.</label>
                        <br>
                        <input name="submit" type="submit" class="btn btn-success" value="Remove">
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