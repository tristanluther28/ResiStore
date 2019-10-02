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
            require_once "../support/nav.php";
        ?>
        <div class="container pt">
            <div class="row mt centered">
                <?php
                    $input = ""; //This variable $input will be the key supplied across pages
                    $total_pages = 0;
                    $input_mod = "";
                    $narrow = "name";
                    $product = new Product();
                    if(isset($_GET["bar"]) || isset($_GET["narrow"])){
                        $input = $_GET['bar'];
                        $narrow = $_GET['narrow'];
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
                    if(isset($_GET["page"])){ 
                        $page = $_GET["page"]; 
                    } 
                    else{ 
                        $page = 1; 
                    }
                    if($rows != NULL){
                        $results_per_page = 30; //30 results MAX per page
                        $total_records = sizeof($rows);
                        $total_pages = ceil($total_records / $results_per_page);
                        $j = ($page-1)*$results_per_page;
                        //While the we have not exceeded the number of items in the results and items on this page has not exceeded the total per page 
                        while($j <= sizeof($rows)-1 && $j < $results_per_page*$page){
                            //This is an item on the left side of the page
                            if($j % 2 == 0){
                ?>
            <div class= "row mt centered">
                <div class="img-container col-md-3">
                <a href="item.php?plu=<?php echo $rows[$j]['plu']?>"><img class="img-responsive" width=290 height=218 src="../img/<?php echo $rows[$j]['picture'] ?>" alt="ResiStore!"></a>
                </div>
                <div class="col-md-3">
                    <a href="item.php?plu=<?php echo $rows[$j]['plu']?>"><h3 class="alter"><?php echo $rows[$j]['description'] ?></h3></a>
                    <p class="white">PLU: <?php echo $rows[$j]['plu'] ?></p>
                    <h2 class="white">$<?php echo $rows[$j]['price'] ?></h2>
                    <p class="strong white">
                    <?php 
                        if($rows[$j]['qty']<=0){
                            echo "Out of Stock";
                        }
                        else{
                            echo "In Stock";
                        }
                    ?>
                    </p>
                    <br>
                    <a href="item.php?plu=<?php echo $rows[$j]['plu']?>"><button type="button" class="btn btn-info btn-lg">View Item</button></a>
                    <br><br>
                </div>
                <?php
                        ++$j;
                        //There is an odd number of items on this page
                        if($j%2==1 && sizeof($rows) == $j){ //((sizeof($rows))-$j)%2==1
                        ?>
                        <div class="col-md-6"></div></div>
                        <?php
                        }
                    }
                    //This is an item on the right side of the page
                    elseif($j % 2 == 1){
                ?>
                <div class="img-container col-md-3">
                <a href="item.php?plu=<?php echo $rows[$j]['plu']?>"><img class="img-responsive" width=290 height=218 src="../img/<?php echo $rows[$j]['picture'] ?>" alt="ResiStore!"></a>
                </div>
                <div class="col-md-3">
                    <a href="item.php?plu=<?php echo $rows[$j]['plu']?>"><h3 class="alter"><?php echo $rows[$j]['description'] ?></h3></a>
                    <p class="white">PLU: <?php echo $rows[$j]['plu'] ?></p>
                    <h2 class="white">$<?php echo $rows[$j]['price'] ?></h2>
                    <p class="strong white">
                    <?php 
                        if($rows[$j]['qty']<=0){
                            echo "Out of Stock";
                        }
                        else{
                            echo "In Stock";
                        }
                    ?>
                    </p>
                    <br>
                    <a href="item.php?plu=<?php echo $rows[$j]['plu']?>"><button type="button" class="btn btn-info btn-lg">View Item</button></a>
                    <br><br>
                </div>
                </div>
                <?php        
                                ++$j;
                            }
                        }
                        
                    }
                else{
                ?>
                    <p class="strong white">No Results :(</p>
                <?php
                }
                ?>
                </p>
                <!-- Loop Ends Here -->
                <div class="row mt centered">
                    <div class="col-md-4">

                    </div>
                    <div class="col-md-4 center-linked">
                        <p class="list-linked">
                        <?php
                        if($total_pages != 0){
                            if($page > 1 and isset($_GET['cate'])){
                            ?>
                                <a href='itemList.php?cate=<?php echo $_GET["cate"] ?>&page=<?php echo $page-1 ?>'><button type="button" class="btn btn-info"><</button></a>
                            <?php
                            }
                            elseif($page > 1 and (isset($_GET['bar'])) || isset($_GET['narrow'])){
                            ?>
                                <a href='itemList.php?narrow=<?php echo $_GET["narrow"] ?>&bar=<?php echo $_GET["bar"] ?>&page=<?php echo $page-1 ?>'><button type="button" class="btn btn-info"><</button></a>
                            <?php
                            }
                            elseif($page > 1){
                            ?>
                                <a href='itemList.php?page=<?php echo $page-1 ?>'><button type="button" class="btn btn-info"><</button></a>
                            <?php
                            }
                            for($l=1; $l<=$total_pages; $l++){
                                if(isset($_GET['cate'])){
                                    if($l == $page){
                                        echo "<a class='list-linked online' href='itemList.php?cate=".$_GET["cate"]."&page=".$l."'>".$l."</a> ";
                                    }
                                    else{
                                        echo "<a class='list-linked' href='itemList.php?cate=".$_GET["cate"]."&page=".$l."'>".$l."</a> "; 
                                    }
                                }
                                elseif(isset($_GET["bar"]) || isset($_GET["narrow"])){
                                    if($l == $page){
                                        echo "<a class='list-linked online' href='itemList.php?narrow=".$_GET["narrow"]."&bar=".$_GET["bar"]."&page=".$l."'>".$l."</a> ";
                                    }
                                    else{
                                        echo "<a class='list-linked' href='itemList.php?narrow=".$_GET["narrow"]."&bar=".$_GET["bar"]."&page=".$l."'>".$l."</a> ";
                                    }
                                }
                                else{
                                    if($l == $page){
                                        echo "<a class='list-linked online' href='itemList.php?page=".$l."'>".$l."</a> ";
                                    }
                                    else{
                                        echo "<a class='list-linked online' href='itemList.php?page=".$l."'>".$l."</a> "; 
                                    }
                                }
                            }
                            if($page != $total_pages and isset($_GET['cate'])){
                            ?>
                                <a href='itemList.php?cate=<?php echo $_GET["cate"] ?>&page=<?php echo $page+1 ?>'><button type="button" class="btn btn-info">></button></a>
                            <?php
                            }
                            elseif($page != $total_pages and (isset($_GET['bar'])) || isset($_GET['narrow'])){
                            ?>
                                <a href='itemList.php?narrow=<?php echo $_GET["narrow"] ?>&bar=<?php echo $_GET["bar"] ?>&page=<?php echo $page+1 ?>'><button type="button" class="btn btn-info">></button></a>
                            <?php
                            }
                            elseif($page != $total_pages){
                            ?>
                                <a href='itemList.php?page=<?php echo $page+1 ?>'><button type="button" class="btn btn-info">></button></a>
                            <?php
                            }
                        }
                        ?>
                        </p>
                        <div class='pad'></div>
                    </div>
                    <div class="col-md-4">

                    </div>
                </div>
            </div>
        </div>
        <br>
        <?php
            require_once "../support/footer.php";
        ?>
    </body>
</html>