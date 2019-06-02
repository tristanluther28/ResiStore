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
        <?php
            if(isset($_SESSION['id']) && $_SESSION['sudo'] == '1'){
                $id = $_GET['id'];
                $employee = new Employee();
                $rows = $employee->get_from_id($id);
                $row = $rows[0];
            }
            else{
                header("Location: 404.php");
                exit();
            }
        ?>
        <div class="container pt">
            <div class="row mt centered">
            <?php
                if(isset($_SESSION['id']) && $_SESSION['sudo'] == '1'){
                    if(substr($row['lastName'], -1) == 's'){
            ?>
                        <h1 class="alter"><?php echo $row['firstName']?> <?php echo $row['lastName']?>' Schedule</h1>
            <?php
                    }
                    else{
            ?>
                <h1 class="alter"><?php echo $row['firstName']?> <?php echo $row['lastName']?>'s Schedule</h1>
            <?php
                    }
            ?>
                <hr>
                <div class="row mt centered">
            <br>
            <div class="col-lg-12 col-md-12 col-sm-12 table-responsive">
                <table style="table-fill;margin-bottom:70px;" class="center table">
                    <thead>
                        <tr>
                            <th class="text-center">(Time)</th>
                            <th class="text-center">Sunday</th>
                            <th class="text-center">Monday</th>
                            <th class="text-center">Tuesday</th>
                            <th class="text-center">Wednesday</th>
                            <th class="text-center">Thursday</th>
                            <th class="text-center">Friday</th>
                            <th class="text-center">Saturday</th>
                        </tr>
                    </thead>
                    <tbody class="table-fill">
                        <!-- Array of time starts -->
                        <?php
                            $flag = 0; 
                            for($i = 0; $i < 11; $i++){
                        ?> 
                        <tr>
                        <?php
                            if($i+8 < 11){
                        ?>
                            <td class='text-left'><?php echo $i+8?>:00AM - <?php echo $i+9?>:00AM</td>
                        <?php
                            }
                            else if($i+8 == 11){
                        ?>
                            <td class='text-left'><?php echo $i+8?>:00AM - <?php echo $i+9?>:00PM</td>
                        <?php
                            }
                            else if($i+8 == 12){
                        ?>
                            <td class='text-left'><?php echo $i+8?>:00PM - 1:00PM</td>
                        <?php
                            }
                            else if($i+8 > 12){
                        ?>
                            <td class='text-left'><?php echo $i-4?>:00PM - <?php echo $i-3?>:00PM</td>
                        <?php
                            }
                        ?>         
                        <?php
                            for($j = 1; $j < 8; $j++){
                                    $block_array = explode(",",$row['blocks']);
                                    for($k = 0; $k < sizeof($block_array); $k++){
                                //Conditional: if a worker has that shift
                                        if((7*$i+$j)==$block_array[$k]){
                                            $flag = 1;
                                            break;
                                        }
                                    }
                                if($flag){
                        ?>
                            <td class="text-left shift"></td>
                        <?php
                                    $flag = 0;
                                }
                                else{
                        ?>
                            <td class="text-left"></td>
                        <?php  
                                }
                            }
                        ?>
                        </tr>
                        <?php
                            }
                        ?>
                        <!-- Array of time ends -->
                    </tbody>
                </table>
            </div>
            <br><br><br>
            </div>
            <?php
                }
                else{
                    header("Location: ../404.php");
                    exit();
                }
            ?>
            </div>
        </div>
        <?php
            require_once "../support/footer.php";
        ?>
    </body>
</html>