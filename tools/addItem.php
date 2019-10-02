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
            <div class="row mt centered">
            <?php
                if(isset($_SESSION['id']) && $_SESSION['sudo'] == '1'){
            ?>
                <h1 class="alter">Add New Item</h1>
                <hr>
                <form method="post" action="../tools/addItemProcess.php" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="white">PLU: </label>
                        <input type="number" name="plu" value="" style="width: 70px" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label class="white">Item Name: </label>
                        <input type="text" name="description" value="" style="width: 500px" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label class="white">Quantity: </label>
                        <input type="number" name="qty" value="" style="width: 70px" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label class="white">Price ($): </label>
                        <input type="number" step="0.01" name="price" value="" style="width: 80px" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label class="white">Category: </label>
                        <input type="text" name="category" value="" style="width: 500px" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label class="white">Box (blank if N/A): </label>
                        <input type="text" name="box" value="" style="width: 500px" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="white">Location: </label>
                        <input type="text" name="location" value="" style="width: 500px" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label class="white">Picture: </label>
                        <input type="file" name="picToUpload" id="picToUpload" required>
                    </div>
                    <div class="form-group">
                        <label class="white">Datasheet: </label>
                        <input type="file" name="dataToUpload" id="dataToUpload" required>
                    </div>
                    <div class="form-group">
                        <input name ="submit" type="submit" class="btn btn-info" value="Submit">
                        <input type="reset" class="btn btn-default" value="Reset">
                    </div>
                </form>
            <?php
                }
                else{
                    header("Location: ../404.php");
                    exit();
                }
            ?>
            <br><br>
            </div>
        </div>
        <?php
            require_once "../support/footer.php";
        ?>
    </body>
</html>