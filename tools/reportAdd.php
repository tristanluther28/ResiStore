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
                    $product_ids = array();
                    if(filter_input(INPUT_POST, 'add_item')){
                        if(isset($_SESSION['item_list'])){
                            $count = count($_SESSION['item_list']);
                            $product_ids = array_column($_SESSION['item_list'], 'id_session');
                            if(!in_array(filter_input(INPUT_GET, 'id_session'), $product_ids)){
                                $_SESSION['item_list'][$count] = array
                                (
                                    'id_session' => filter_input(INPUT_GET, 'id_session'),
                                    'description_session' => filter_input(INPUT_POST, 'description_session'),
                                    'price_session' => filter_input(INPUT_POST, 'price_session'),
                                    'plu_session' => filter_input(INPUT_POST, 'plu_session'),
                                    'qty_session' => filter_input(INPUT_POST, 'qty_session')
                                );
                            }
                            else{
                                for($i=0; $i<count($product_ids); $i++){
                                    if($product_ids[$i] == filter_input(INPUT_GET, 'id_session')){
                                        $_SESSION['item_list'][$i]['qty_session'] += filter_input(INPUT_POST, 'qty_session');
                                    }
                                }
                            }
                        }
                        else{ //if the item list is empty create first product key with array key 0
                            $_SESSION['item_list'][0] = array
                            (
                                'id_session' => filter_input(INPUT_GET, 'id_session'),
                                'description_session' => filter_input(INPUT_POST, 'description_session'),
                                'price_session' => filter_input(INPUT_POST, 'price_session'),
                                'plu_session' => filter_input(INPUT_POST, 'plu_session'),
                                'qty_session' => filter_input(INPUT_POST, 'qty_session')
                            );
                        }
                    }
            ?>
                <div class="row mt centered">
                    <h1 class="alter">Add Items to Report</h1>
                    <hr>
                    <div class="row mt centered">
                        <div class="col-sm-3 col-md-3 col-lg-4">
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
                            <div class="col-sm-3 col-md-3 col-lg-4">
                                <a href="../tools/report.php" class="btn btn-info center-block">Check Added Items</a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table style="table-fill;margin-bottom:70px;" class="center table">
                                <thead>
                                    <tr>
                                        <th class="text-left">Add?</th>
                                        <th class="text-left">PLU</th>
                                        <th class="text-left">Description</th>
                                        <th class="text-left">Quantity</th>
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
                                        <form method="post" action="../tools/reportAdd.php?action=add&id_session=<?php echo $row['id']?>">
                                            <td class='text-left'>
                                                <input type="submit" name="add_item" class="btn btn-info" value="Add">
                                            </td>
                                            <td class='text-left'><?php echo $row['plu']?></td>
                                            <td class='text-left'><?php echo $row['description'] ?></td>
                                            <td class='text-left'><input type="number" name="qty_session" class="form-control" value="1"></td>
                                            <input type="hidden" name="description_session" value="<?php echo $row['description'] ?>">
                                            <input type="hidden" name="price_session" value="<?php echo $row['price'] ?>">
                                            <input type="hidden" name="plu_session" value="<?php echo $row['plu'] ?>">
                                        </form> 
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