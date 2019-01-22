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
        <div class="table-title alter">
            <h3 class="alter">Our Inventory</h3>
        </div>
        <div class="row">
                <div class="col-md-2 col-md-offset-5">
                <form class="form-group" action="" method="post">
                    <h4 for="narrow" class="text-center white">Search this table for</h4>
                    <select name="narrow" id="narrow" class="form-control">
                        <option value="*">All</option>
                        <option value="plu">PLU</option>
                        <option value="name">Name</option>
                        <option value="price">Price</option>
                    </select>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search..." name="bar">
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-default" name="submitButton">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <table style="table-fill;margin-bottom:70px;" class="center">
            <thead>
                <tr>
                    <th class="text-left">PLU</th>
                    <th class="text-left">Description</th>
                    <th class="text-left">Quantity</th>
                    <th class="text-left">Price ($)</th>
                    <th class="text-left">Category</th>
                </tr>
            </thead>
            <tbody class="table-fill ani">
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
                    $rows = $product->search_all($input); 
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
                if($rows != NULL){
                    foreach($rows as $row){
            ?>
                <tr>
                    <td class='text-left'><?php echo $row['plu']?></td>
                    <td class='text-left'><a href="item.php?plu=<?php echo $row['plu']?>"><?php echo $row['description'] ?></a></td>
                    <td class='text-left'>
                        <?php 
                            if($row['qty']==0){
                                echo "Out of Stock";
                            }
                            else{
                                echo $row['qty'];
                            }
                         ?>
                    </td>
                    <td class='text-left'>$<?php echo $row['price'] ?></td>
                    <td class='text-left'><?php echo $row['category'] ?></td> 
                </tr>
            
            <?php
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
        <?php
            require_once "../support/footer.php";
        ?>
    </body>
</html>