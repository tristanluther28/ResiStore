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
        <div class="container pt">
            <?php
                if(isset($_SESSION['id']) && $_SESSION['sudo'] == '1'){
                    $products = new Product();
                    if(!empty($_SESSION['item_list'])){
                        foreach($_SESSION['item_list'] as $key => $product){
                            $temp = $product['id_session'];
                            $rows = $products->search_id($temp);
                            $row = $rows[0];
                            $qty = $row['qty'];
                            $sold = $row['sold'] + $product['qty_session'];
                            if($row['qty'] - $product['qty_session'] <= 0){
                                $qty = 0;
                            }
                            else{
                                $qty = $row['qty'] - $product['qty_session'];
                            }
                            $products->update_sync($row['id'], $qty, $sold);
                            
            ?>
                <div class="row mt centered">
                    <div class="col-lg-3 col-md-4 col-sm-5">
                    <br>
                    <?php
                        if($msg != ""){
                    ?>
                        <h4 class="error-msg"><?php echo $msg ?></h4>
                    <?php
                        }
                    ?>
                    </div>
                <div>
            <?php
                        }
                        //Destroy session variables just recorded
                        unset($_SESSION["item_list"]); 
                        header("Location: report.php");
                        exit();
                    }
                    else{
                        $msg = "Sync Not Succesful!";
                    }
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