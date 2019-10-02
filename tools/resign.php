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
                       <h1 class="alter">Transfer Manager Tools</h1>
                       <hr>
                       <p class="white">Only continue if you will no longer be manager of the ResiStore. Select a user who will be the next manager to proceed.</p>
                       <strong class="white">Caution: This will revoke your manager tools!</strong> 
                </div>
            </div>
            <?php
                $employee = new Employee();
                $rows = $employee->select();
                if($rows != NULL){
                    foreach($rows as $row){
                        if($row['sudo'] != 1){
            ?>
            <div class="row mt centered">
                <h3 class="white"><?php echo $row['firstName'] ?> <?php echo $row['lastName']?> 
                <br><br>
                <p class="white">Email: <?php echo $row['email']?></p>
                <br>
                <p class="white">Volunteer Since: 
                <?php 
                    $date = date_create($row['dateMade']);
                    echo date_format($date,"m/d/Y")
                ?>
                </p>
                <a href="../tools/resignProcess.php?id=<?php echo $row['id']?>" class="btn btn-info">Make Manager</a>
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