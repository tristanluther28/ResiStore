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

            //
            //echo date_format($date,"m/d/Y")
        ?>
        <div class="container pt">
        <br><br>
        <div class="row mt centered">
            <div class="text-center">
                    <?php
                        if(isset($_SESSION['id']) && $_SESSION['sudo'] == '1'){
                    ?>
                       <h1 class="alter">Door RFID Log</h1>
                       <hr>
                </div>
            </div>
            <?php
                $door = new Door();
                $rows = $door->select();
                if($rows != NULL){
                ?>
                <a class="btn btn-danger" href="../tools/deleteDoor.php">Delete Door Log</a>
                <br><br>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Time Attempted</th>
                            <th>Firstname</th>
                            <th>Lastname</th>
                            <th>RFID Number</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                <?php
                    foreach($rows as $row){
                    //Below is a single RFID attempt
                ?>
                    <tbody>
                        <tr>
                            <td><?php 
                            $date = date_create($row['date']);
                            date_sub($date, date_interval_create_from_date_string('7 hours'));
                            echo date_format($date,"m/d/Y h:iA");
                            ?></td>
                            <td><?php echo $row['firstName'] ?></td>
                            <td><?php echo $row['lastName'] ?></td>
                            <td><?php echo $row['rfid'] ?></td>
                            <?php 
                            if($row['successful'] == 1){
                            ?>
                            <td class="success">Access Granted</td>
                            <?php
                            }
                            else{
                            ?>
                            <td class="danger">Access Denied</td>
                            <?php
                            }
                            ?>
                        </tr>
  
                <?php
                    }
                ?>
                    </tbody>
                </table>
                <?php
                }
                else{
                ?>
                    <h2 class="white">No Door Data Available</h2>
                <?php
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