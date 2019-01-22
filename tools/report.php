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
                require_once "../support/nav.php";
            }
            else{
                header("Location: ../404.php");
                exit();
            }
        ?>
        <div class="container pt">
            <?php
                if(isset($_SESSION['id']) && $_SESSION['sudo'] == '1'){
                    $total = 0.00; //total cost of this order
                    $products = new Product();
            ?>
                <div class="row mt centered">
                    <h1 class="alter">Sync Sales with POS System Report</h1>
                    <hr>
                    <div class="col-sm-4 col-md-4 col-lg-5">
                        <h3 class="alter">Sale Description</h3>
                        <p class="white">In-order to keep the ResiStore website item quantity up-to-date, input the items sold based on the POS system report.
                        <br><br>
                        <a href="../tools/reportAdd.php" class="btn btn-info">Add Items</a>
                        <?php
                            if(!empty($_SESSION['item_list'])){
                        ?>
                        <a href="../tools/syncDb.php" class="btn btn-success pull-right">Sync Sales with Database</a>
                        <?php
                            }
                        ?>
                        <br>
                        <?php
                            if(!empty($_SESSION['item_list'])){
                                foreach($_SESSION['item_list'] as $key => $product){
                                    $temp = $product['id_session'];
                                    $rows = $products->search_id($temp);
                                    $row = $rows[0];
                        ?>
                            <h5 class="white">PLU: <?php echo $product['plu_session']?></h5>
                            <h5 class="white">Name: <?php echo $product['description_session']?></h5>
                            <h5 class="white">Cost: $<?php echo $product['price_session']?></h5>
                            <h5 class="white">Quantity Sold: <?php echo $product['qty_session']?></h5>
                            <h5 class="white">Item Total: $
                            <?php 
                                $total_item = number_format((float)$product['qty_session']*$product['price_session'], 2, '.', ''); 
                                echo $total_item;
                            ?>
                            </h5>
                            <hr>
                        <?php
                                    $total = $total + ($product['price_session']*$product['qty_session']);
                                }   
                            }
                        ?>
                        <br>
                        <?php

                        ?>

                    </div>
                    <div class="col-sm-4 col-md-4 col-lg-5">
                        <h3 class="alter">Total</h3>
                        <p class="white">The total amount gained from these sales amounts to:</p>
                        <h3 class="alter">$
                        <?php 
                        $total = number_format((float)$total, 2, '.', '');
                        echo $total
                        ?>
                        </h3>
                    </div>
                </div>
            <?php
                }
                else{
                    header("Location: ../404.php");
                    exit();
                }
            ?>
        </div>
        <?php
            require_once "../support/footer.php";
        ?>
    </body>
</html>