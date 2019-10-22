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
            if(isset($_SESSION['id']) && ($_SESSION['sudo'] == '1' || $_SESSION['sudo'] == '2')){
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
                        if(isset($_SESSION['id']) && ($_SESSION['sudo'] == '1' || $_SESSION['sudo'] == '2')){
                    ?>
                       <h1 class="alter">Transfer Officer Tools</h1>
                       <hr>
                       <p class="white">Only continue if you will no longer be an OSURC Officer. Select a user who will be the next officer to proceed.</p>
                       <strong class="white">Caution: This will revoke your officer tools!</strong> 
                </div>
            </div>
            <?php
                $employee = new Employee();
                $rows = $employee->select();
                if($rows != NULL){
                    foreach($rows as $row){
                        if($row['sudo'] == NULL){
            ?>
            <div class="row mt centered">
                <h3 class="white"><?php echo $row['firstName'] ?> <?php echo $row['lastName']?> 
                <br><br>
                <p class="white">Email: <?php echo $row['email']?></p>
                <br>
                <a href="../sub_tools/resign_osurc_process.php?id=<?php echo $row['id']?>" class="btn btn-info">Make Officer</a>
                <br>
                <hr>
                </div>
                <?php
                        }
                    }
                }
            }
            else{
                header("Location: ../404.php");
                exit();
            }
            ?>
        <br><br><br>
    <?php
            require_once "../support/footer.php";
    ?>
    </body>
</html>