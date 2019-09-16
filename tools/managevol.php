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

                    ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>OSU ID</th>
                            <th>RFID Number</th>
                            <th>Volunteer Since</th>
                            <th>Edit Schedule</th>
                            <th>Store Access</th>
                            <th>Remove?</th>
                        </tr>
                    </thead>
                <?php
                    foreach($rows as $row){
                ?>
                <tbody>
                        <tr>
                            <td><?php echo $row['firstName']. " " .$row['lastName'] ?></td>
                            <td><?php echo $row['email'] ?></td>
                            <td><?php echo $row['osu_id'] ?></td>
                            <td><?php echo $row['rfid'] ?></td>
                            <td><?php 
                            $date = date_create($row['dateMade']);
                            echo date_format($date,"m/d/Y") 
                            ?></td>
                            <td>
                            <a class="btn btn-info" href="../tools/empSch.php?id=<?php echo $row['id']?>">Edit Schedule</a>
                            </td>
                            <td>
                            <?php
                                if($row['store_access'] == 1){
                            ?>
                                <a class="btn btn-danger" href="../tools/accessCng.php?id=<?php echo $row['id']?>&a=0">Disable Store Access</a>
                            <?php
                                }
                                else{
                            ?>
                                <a class="btn btn-success" href="../tools/accessCng.php?id=<?php echo $row['id']?>&a=1">Grant Store Access</a>
                            <?php
                                }
                            ?>
                            </td>
                            <td>
                            <?php
                                if($row['sudo'] != 1){
                            ?>
                            <a class="btn btn-danger" href="../tools/removeEmp.php?id=<?php echo $row['id']?>">Remove Volunteer</a>
                            <?php
                                }
                            ?>
                            </td>
                        </tr>
                <?php
                    }
                ?>
                    </tbody>
                </table>    
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