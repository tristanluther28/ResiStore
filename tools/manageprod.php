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
                    <h1 class="alter">Edit Products</h1>
                    <hr>
                    <div class="col-md-4">
                        <h3 class="alter">Add New Product</h3>
                        <p class="text-left white">
                            Add a new item to inventory. Please fill out the entire form! 
                            Empty values will confuse customers!
                        </p>
                        <a href="../tools/addItem.php" class="btn btn-info pull-center">Create Item</a>
                        <br>
                    </div>
                    <div class="col-md-4 col-md-offset-4">
                        <form class="form-group" action="" method="post">
                            <h4 for="narrow" class="text-center white">Search products for</h4>
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
            </div>
            <div class="row mt centered">
                <br>
                <form method="post" action="../tools/managerprod.php">
                    <div class="">
                    <table style="table-fill;margin-bottom:70px;" class="center table">
                        <thead>
                            <tr>
                                <th class="text-left">PLU</th>
                                <th class="text-left">Description</th>
                                <th class="text-left">Quantity</th>
                                <th class="text-left">Price</th>
                                <th class="text-left">Category</th>
                                <th class="text-left">Edit?</th>
                                <th class="text-left">Delete?</th>
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
                                <td class='text-left'><?php echo $row['description']?></td>
                                <td class='text-left'><?php echo $row['qty'];?></td>
                                <td class='text-left'><?php echo $row['price'] ?></td>
                                <td class='text-left'><?php echo $row['category'] ?></td>
                                <td class='text-left'><a href="../tools/editItem.php?id=<?php echo $row['id']?>">Edit</a></td> 
                                <td class='text-left'><a href="../tools/removeItem.php?id=<?php echo $row['id']?>">Delete</a></td>
                            </tr>
                        
                        <?php
                                }
                            }
                            else{
                        ?>
                                <h1 class='text-center alter'>No Results :(</h1>
                        <?php
                            }
                        ?>
                        </tbody>
                    </table>
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
        <br><br><br>
    <?php
            require_once "../support/footer.php";
    ?>
    </body>
</html>