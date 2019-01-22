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
        ?>
        <div class="container pt">
            <div class="row mt centered">
                <?php
                    $input = ""; //This variable $input will be the key supplied across pages
                    $input_mod = "";
                    $narrow = "name";
                    $product = new Product();
                    if(isset($_POST["bar"]) || isset($_POST["narrow"])){
                        $input = $_POST['bar'];
                        $narrow = $_POST['narrow'];
                        $input_mod = $product->pural_check($input);
                    }
                    else{
                        if(isset($_GET['cate'])){
                            $input = $_GET['cate'];
                            $rows = $product->search_all($input);
                        } 
                    }
                    if ($narrow == 'plu'){
                        $rows = $product->search_plu($input_mod);
                    }
                    elseif ($narrow == 'price'){
                        $rows = $product->search_price($input_mod);
                    }
                    elseif($narrow == 'name'){
                        $input_mod = $product->pural_check($input);
                        $rows = $product->search_name($input_mod);
                    }
                    else{
                        $input_mod = $product->pural_check($input);
                        $rows = $product->search_all($input_mod);
                    }
                ?>
                <h1 class="alter"><?php echo $input ?></h1>
                <hr>
                <!-- Loop Starts Here -->
                <?php
                    if($rows != NULL){
                        $k=0;
                        foreach($rows as $row){
                            if($k % 2 == 0){
                ?>
            <div class= "row mt centered">
                <div class="img-container col-md-3">
                <a href="item.php?plu=<?php echo $row['plu']?>"><img class="img-responsive" width=290 height=218 src="../img/<?php echo $row['picture'] ?>" alt="ResiStore!"></a>
                </div>
                <div class="col-md-3">
                    <a href="item.php?plu=<?php echo $row['plu']?>"><h3 class="alter"><?php echo $row['description'] ?></h3></a>
                    <p class="white">PLU: <?php echo $row['plu'] ?></p>
                    <h2 class="white">$<?php echo $row['price'] ?></h2>
                    <p class="strong white">
                    <?php 
                        if($row['qty']<=0){
                            echo "Out of Stock";
                        }
                        else{
                            echo "In Stock";
                        }
                    ?>
                    </p>
                    <br>
                    <a href="item.php?plu=<?php echo $row['plu']?>"><button type="button" class="btn btn-info btn-lg">View Item</button></a>
                    <br><br>
                </div>
                <?php
                                $k++;
                            }
                            else{
                ?>
                <div class="img-container col-md-3">
                <a href="item.php?plu=<?php echo $row['plu']?>"><img class="img-responsive" width=290 height=218 src="../img/<?php echo $row['picture'] ?>" alt="ResiStore!"></a>
                </div>
                <div class="col-md-3">
                    <a href="item.php?plu=<?php echo $row['plu']?>"><h3 class="alter"><?php echo $row['description'] ?></h3></a>
                    <p class="white">PLU: <?php echo $row['plu'] ?></p>
                    <h2 class="white">$<?php echo $row['price'] ?></h2>
                    <p class="strong white">
                    <?php 
                        if($row['qty']<=0){
                            echo "Out of Stock";
                        }
                        else{
                            echo "In Stock";
                        }
                    ?>
                    </p>
                    <br>
                    <a href="item.php?plu=<?php echo $row['plu']?>"><button type="button" class="btn btn-info btn-lg">View Item</button></a>
                    <br><br>
                </div>
                </div>
                <?php
                                $k++;
                            }
                        }
                    }
                else{
                    echo "No Results :(";
                }
                ?>
                <!-- Loop Ends Here -->
            </div>
        </div>
        <br>
        <?php
            require_once "../support/footer.php";
        ?>
    </body>
</html>