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
                $input = $_GET['id'];
                $product = new Product();
                $rows = $product->search_id($input);
                $row = $rows[0];
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
                <h1 class="alter">Edit (<?php echo $row['description']?>)</h1>
                <hr>
                <form method="post" action="../tools/editItemProcess.php?id=<?php echo $row['id']?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="white">PLU: </label>
                        <input type="number" name="plu" value="<?php echo $row['plu']?>" style="width: 70px" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label class="white">Item Name: </label>
                        <input type="text" name="description" value="<?php echo $row['description']?>" style="width: 500px" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label class="white">Quantity: </label>
                        <input type="number" name="qty" value="<?php echo $row['qty'];?>" style="width: 70px" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label class="white">Price ($): </label>
                        <input type="number" step="0.01" name="price" value="<?php echo $row['price'] ?>" style="width: 80px" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label class="white">Category: </label>
                        <input type="text" name="category" value="<?php echo $row['category'] ?>" style="width: 500px" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label class="white">Box (if applicable): </label>
                        <input type="text" name="box" value="<?php echo $row['box'] ?>" style="width: 500px" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="white">Location: </label>
                        <input type="text" name="location" value="<?php echo $row['location'] ?>" style="width: 500px" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label class="white">Picture: </label>
                        <p class="white">Currently: <?php echo $row['picture'] ?></p>
                        <input type="file" name="picToUpload" id="picToUpload">
                    </div>
                    <div class="form-group">
                        <label class="white">Datasheet: </label>
                        <p class="white">Currently: <?php echo $row['datasheet'] ?></p>
                        <input type="file" name="dataToUpload" id="dataToUpload">
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