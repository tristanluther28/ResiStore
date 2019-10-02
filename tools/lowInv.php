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
        <br><br>
        <div class="row mt centered">
                <div class="text-center">
                    <?php
                        if(isset($_SESSION['id']) && $_SESSION['sudo'] == '1'){
                    ?>
                       <h1 class="alter">Check Low Inventory</h1>
                       <hr>
                       <div class="col-sm-5 col-md-6 col-lg-6">
                            <h3 class="white">Out of Stock Items</h3>
                            <div style="overflow-y: scroll; height:400px;">
                                <table style="table-fill;" class="center">
                                    <thead>
                                        <tr>
                                            <th class="text-left">PLU</th>
                                            <th class="text-left">Description</th>
                                            <th class="text-left">Quantity</th>
                                            <th class="text-left">Price ($)</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-fill ani">
                                    <?php
                                        $product = new Product();
                                        $rows = $product->select();
                                        if($rows != NULL){
                                            foreach($rows as $row){
                                                if($row['qty'] == 0){
                                    ?>
                                        <tr>
                                            <td class='text-left'><?php echo $row['plu']?></td>
                                            <td class='text-left'><?php echo $row['description'] ?></td>
                                            <td class='text-left'><?php echo $row['qty'] ?></td>
                                            <td class='text-left'>$<?php echo $row['price'] ?></td>
                                        </tr>
                                    
                                    <?php
                                                }
                                            }
                                        }
                                        else{
                                    ?>
                                            <h1 class='text-center'>No Results :(</h1>
                                    <?php
                                        }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                       </div>
                       <div class="col-sm-5 col-md-6 col-lg-6">
                            <h3 class="white">Low Quantity Item</h3>
                            <div style="overflow-y: scroll; height:400px;">
                                <table style="table-fill;" class="center">
                                    <thead>
                                        <tr>
                                            <th class="text-left">PLU</th>
                                            <th class="text-left">Description</th>
                                            <th class="text-left">Quantity</th>
                                            <th class="text-left">Price ($)</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-fill ani">
                                    <?php
                                        $product = new Product();
                                        $rows = $product->select();
                                        if($rows != NULL){
                                            foreach($rows as $row){
                                                if($row['qty'] > 0 && $row['qty'] <= 3){
                                    ?>
                                        <tr>
                                            <td class='text-left'><?php echo $row['plu']?></td>
                                            <td class='text-left'><?php echo $row['description'] ?></td>
                                            <td class='text-left'><?php echo $row['qty'] ?></td>
                                            <td class='text-left'>$<?php echo $row['price'] ?></td>
                                        </tr>
                                    
                                    <?php
                                                }
                                            }
                                        }
                                        else{
                                    ?>
                                            <h1 class='text-center'>No Results :(</h1>
                                    <?php
                                        }
                                    ?>
                                    </tbody>
                                </table>
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
        </div>
        <br><br><br>
    <?php
            require_once "../support/footer.php";
    ?>
    </body>
</html>