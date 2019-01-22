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
        <br><br>
        <div class="row mt centered">
            <div class="text-center">
                    <?php
                        if(isset($_SESSION['id']) && $_SESSION['sudo'] == '1'){
                    ?>
                       <h1 class="alter">Manage Volunteers</h1>
                       <hr>
                </div>
            </div>
            <?php
                $employee = new Employee();
                $rows = $employee->select();
                if($rows != NULL){
                    foreach($rows as $row){
                ?>
            <div class="row mt centered">
                <h3 class="white"><?php echo $row['firstName'] ?> <?php echo $row['lastName']?>: 
                <?php
                    if($row['sudo'] == 1){
                ?>
                <i class="white">Manager</i></h3>
                <?php
                    }
                    else{
                ?>
                <i class="white">Volunteer</i></h3>
                <?php
                    }
                ?>
                <br>
                <p class="white">Email: <?php echo $row['email']?></p>
                <br>
                <p class="white">RFID: <?php echo $row['rfid']?></p>
                <br>
                <p class="white">Volunteer Since: 
                <?php 
                    $date = date_create($row['dateMade']);
                    echo date_format($date,"m/d/Y")
                ?>
                </p>
                <br>
                <a class="btn btn-info" href="../tools/empDetail.php?id=<?php echo $row['id']?>">See Schedule</a>
                <a class="btn btn-info" href="../tools/empSch.php?id=<?php echo $row['id']?>">Edit Schedule</a>
                <?php
                    if($row['sudo'] != 1){
                ?>
                <a class="btn btn-danger" href="../tools/removeEmp.php?id=<?php echo $row['id']?>">Remove Volunteer</a>
                <?php
                    }
                ?>
                <hr>
                </div>
                <?php
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