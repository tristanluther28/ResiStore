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
                       <h1 class="alter">Manage OSURC Members</h1>
                       <hr>
                </div>
            </div>
            <?php
                $member = new Member();
                $rows = $member->select();
                if($rows != NULL){

                    ?>
                <a class="btn btn-danger" href="../sub_tools/nuclear_option.php">Delete All Members (Not Officers)</a>
                <br><br>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>OSU ID</th>
                            <th>RFID Number</th>
                            <th>Date Registered</th>
                            <th>Registered By</th>
                            <th>Edit Member</th>
                            <th>Clab Access</th>
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
                            $date = date_create($row['date_made']);
                            echo date_format($date,"m/d/Y") 
                            ?></td>
                            <td><?php echo $row['approved'] ?></td>
                            <td>
                            <a class="btn btn-info" href="../sub_tools/edit_member.php?id=<?php echo $row['id']?>">Edit Member</a>
                            </td>
                            <td>
                            <?php
                                if($row['clab_access'] == 1){
                            ?>
                                <a class="btn btn-danger" href="../sub_tools/access_clab.php?id=<?php echo $row['id']?>&a=0">Disable Clab Access</a>
                            <?php
                                }
                                else{
                            ?>
                                <a class="btn btn-success" href="../sub_tools/access_clab.php?id=<?php echo $row['id']?>&a=1">Grant Clab Access</a>
                            <?php
                                }
                            ?>
                            </td>
                            <td>
                            <?php
                                if($row['officer_class'] != 1){
                            ?>
                            <a class="btn btn-danger" href="../sub_tools/remove_osurc.php?id=<?php echo $row['id']?>">Remove Member</a>
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