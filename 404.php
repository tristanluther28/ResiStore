<?php
    function __autoload($class){
        require_once "/classes/$class.php";
    }
    session_start();
?>
<html>
    <head>
        <?php
            require_once "/support/head.php";
        ?>
    </head>
    <body>
        <?php
            require_once "/support/nav.php";
        ?>
        <div class="container pt">
            <div class="row mt centered">
                <br><br>
                <h1 class="alter">404 Error: Page Not Found</h1>
                <?php
                //Check Images
                $target_dir_pic = "img/";
                $product = new Product();
                $rows_folder = scandir($target_dir_pic);
                $rows_db = $product->get_pictures();
                $flag = 0;
                if($rows_folder != NULL){
                    foreach ($rows_folder as $row_folder){
                        foreach($rows_db as $row_db){
                            if($row_folder === '.' || $row_folder === '..' || $row_folder === 'safe'){
                                $flag = 1;
                                break;
                            }
                            elseif($row_folder === $row_db['picture']){
                                $flag = 1;
                                break;
                            }
                            else{
                                
                            }
                        }
                        if(!$flag){
                            if(file_exists($target_dir_pic . basename($row_folder))){
                                //Delete the file
                            }
                        }
                        $flag = 0;
                    }
                }
                else{
                    
                }
                ?>
            </div>
        </div>
        <br><br><br>
    <?php
            require_once "/support/footer.php";
    ?>
    </body>
</html>