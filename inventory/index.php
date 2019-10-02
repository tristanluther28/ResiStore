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
        <?php
        for($i = 0; $i < count($diff_cat); $i++){
            $rows = $product->search_all($diff_cat[$i][0]);
            if($rows != NULL){
        ?>
            <div class="row mt centered">
                <h1 class="text-center alter"><?php echo $diff_cat[$i][0]?></h1>
        <?php
                $j = 0;
                foreach($rows as $row){
                    if($row['qty']!=0){
        ?>
            <div class="col-lg-3" >
                <a href="item.php?plu=<?php echo $row['plu']?>"><img class="img-responsive" src="<?php echo '../img/'.$row['picture'];?>" alt="ResiStore!"></a>
                <h3 class="text-center alter"><?php echo $row['description'] ?></h3>
            </div>
        <?php
                        if(++$j == 4){
                            break;
                        }
                    }
                }
        ?>
            <a href="itemList.php?cate=<?php echo $row['category']?>" class="btn btn-info pull-right">More</a>
            </div>
            <hr>
        <?php
            }
        }
        ?>
        </div>
        <?php
            require_once "../support/footer.php";
        ?>
    </body>
</html>