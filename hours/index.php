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
            <div class="row mt centered">
                <div class="text-center">
                    <h1 class="alter">Store Hours</h1>
                    <hr>
                    <h4 class="white">The ResiStore opens week 2 and closes after dead week (week 10) each term</h4>
                    <br>
                </div>
                <strong class="white">Notice:</strong>
                <p class="notice-text">
                     All of our volunteers are busy college students. Sometimes, they are 
                    forced to miss their shift with little notice. The banner on the home page 
                    can help you by letting you know if the store is open right now.
                    <br><br>If a box is filled in with <span class="alter">orange</span>, that means someone is scheduled to have that shift.
                </p>
                <br><br>
            </div>
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
                            $employee = new Employee();
                            $rows = $employee->get_blocks();
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
                                foreach($rows as $row){
                                    $block_array = explode(",",$row['blocks']);
                                    for($k = 0; $k < sizeof($block_array); $k++){
                                //Conditional: if a worker has that shift
                                        if((7*$i+$j)==$block_array[$k]){
                                            $flag = 1;
                                            break 2;
                                        }
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
        </div>
        <?php
            require_once "../support/footer.php";
        ?>
    </body>
</html>