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
                    $member = new Member();
                    $member->delete($id);
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
                <h1 class="alter">Remove Member?</h1>
                <hr>
                <form method="post" action="../sub_tools/remove_osurc.php?id=<?php echo $_GET['id'] ?>">
                    <div class="form-group">
                        <label class="white">Are you sure you want to remove this member? This will revoke clab access.</label>
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