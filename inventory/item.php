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
            require_once "../support/nav.php";
            $input = $_GET['plu'];
            $product = new Product();
            $rows = $product->search_plu($input);
            $row = $rows[0];
        ?>
        <div class="container pt">
            <div class="row mt centered">
                <div class="img-container col-md-8">
                    <a href="#"><img class="img-responsive" width=970 height=728 src="../img/<?php echo $row['picture'] ?>" alt="ResiStore!"></a>
                </div>
                <div class="col-md-4">
                    <h3 class="alter"><?php echo $row['description'] ?></h3>
                    <p class="white">PLU: <?php echo $row['plu'] ?></p>
                    <h2 class="white">$<?php echo $row['price'] ?></h2>
                    
                    <?php 
                        if($row['qty']<=0){
                    ?>
                        <p class="strong white">Out of Stock</p>
                    <?php
                        }
                        else{
                    ?>
                            <p class="strong white">In Stock</p>
                            <i class="white"><?php echo $row['qty']?> Avaliable</i>
                            <br>
                    <?php
                        }
                    ?>
                    <br>
                    <a href="<?php echo '../datasheets/'.$row['datasheet'];?>" target="_blank"><button type="button" class="btn btn-info btn-lg">View Datasheet</button></a>
                    <br><br>
                </div>
            </div>
        </div>
        <?php
            require_once "../support/footer.php";
        ?>
    </body>
</html>