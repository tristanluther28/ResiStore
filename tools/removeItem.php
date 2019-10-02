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
                $id = $_GET['id'];
                if (isset($_POST['submit'])){
                    $product = new Product();
                    $product->delete($id);
                    header("Location: manageprod.php");
                    exit();
                }
                else if(isset($_POST['cancel'])){
                    header("Location: manageprod.php");
                    exit();
                }
            }
        ?>
        <div class="container pt">
            <div class="row mt centered">
            <?php
                if(isset($_SESSION['id']) && $_SESSION['sudo'] == '1'){
            ?>
                <h1 class="alter">Remove Item?</h1>
                <hr>
                <form method="post" action="../tools/removeItem.php?id=<?php echo $_GET['id'] ?>">
                    <div class="form-group">
                        <label class="white">Are you sure you want to remove this item from inventory?</label>
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