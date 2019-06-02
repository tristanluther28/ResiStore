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
                $error_msg = "";
                $pos_msg = "";
                if(isset($_POST['submit'])){
                    $employee = new Employee();
                    $firstName = $employee->escape($_POST['firstName']);
                    $lastName = $employee->escape($_POST['lastName']);
                    $email = $employee->escape($_POST['email']);
                    $password = $employee->escape($_POST['password']);
                    $confirm_password = $employee->escape($_POST['confirm_password']);
                    $rfid = $employee->escape($_POST['rfid']);
                    $blocks = implode(",",$_POST["blocks"]);
                    if($password != $confirm_password){
                        $error_msg =  "Error: passwords do not match";
                    }
                    else{
                        $hash = password_hash($password, PASSWORD_BCRYPT);
                        $employee->insert_data($firstName, $lastName, $email, $hash, $rfid, $blocks);
                        $pos_msg = "You have been registered!";
                        exit();
                    }
                }
            }
        ?>
        <div class="container pt">
            <div class="row mt centered">
            <?php
                if(isset($_SESSION['id']) && $_SESSION['sudo'] == '1'){
            ?>
                <div class="col-lg-3 col-md-4 col-sm-4">
                    <h1 class="alter">Volunteer Registration</h1>
                    <p class="white">Fill out this form to become a ResiStore Volunteer! 
                    <br><br>Pick any hours that work for you and if any schedule conflicts come up during the term, be 
                    sure to email the ResiStore Manager so that your timeslot can be freed up.
                    <br><br>A maximum of two people can work one particular shift. This is due to the limited amount of space
                    in the store. 
                    <br><br>A time block maked as <span class="red">red</span> already has two people working. 
                    A time block maked as <span class="yellow">yellow</span> has one person working. An unmarked time block has nobody working.</p>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-5">
                    <br>
                    <?php
                    if($error_msg != ""){
                    ?>
                    <h4 class="error-msg">
                    <?php
                        echo $error_msg; 
                    ?>
                    </h4>
                    <?php
                    }
                    ?>
                    <?php
                    if($pos_msg != ""){
                    ?>
                    <h4 class="pos-msg">
                    <?php
                        echo $pos_msg; 
                    ?>
                    </h4>
                    <?php
                    }
                    ?>
                    <form action="../tools/process.php" method="post">
                        <div class="form-group">
                            <label class="white">First Name</label>
                            <input type="text" name="firstName" class="form-control" required>
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group">
                            <label class="white">Last Name</label>
                            <input type="text" name="lastName" class="form-control" required>
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group">
                            <label class="white">E-mail</label>
                            <input type="email" name="email" class="form-control" value="" required>
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group">
                            <label class="white">Password</label>
                            <input type="password" minLength="5" name="password" class="form-control" value="" required>
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group">
                            <label class="white">Confirm Password</label>
                            <input type="password" minLength="5" name="confirm_password" class="form-control" required>
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group">
                            <label class="white">RFID Number</label>
                            <input type="number" name="rfid" class="form-control" required>
                            <span class="help-block"></span>
                        </div>
                        <div class="row pt centered">
                            <div class="form-group">
                                <label class="white">Select your hours</label>
                                <br>
                                <div class="">
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
                                                $count = 0; 
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
                                                                $count++;
                                                                break;
                                                            }
                                                        }
                                                    }
                                                    //Conditional for two people on a shift
                                                    if($count >= 2){
                                            ?>
                                                <td class="shift-two"></td>
                                            <?php
                                                        $count = 0;
                                                    }
                                                    //Conditional for one person on shift
                                                    else if($count == 1){
                                                        ?>
                                                <td class="shift-one">
                                                    <input type="checkbox" name="blocks[]" class="form-control" value="<?php echo 7*$i + $j; ?>">
                                                </td>
                                                        <?php
                                                                    $count = 0;
                                                    }
                                                    else{
                                            ?>
                                                <td><input type="checkbox" name="blocks[]" class="form-control" value="<?php echo 7*$i + $j; ?>"></td>
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
                            </div>
                        </div>
                        <div class="form-group">
                            <input name ="submit" type="submit" class="btn btn-info" value="Submit">
                            <input type="reset" class="btn btn-default" value="Reset">
                        </div>
                        <p class="white">Already a Volunteer? <a href="../login">Login here</a>.</p>
                    </form>
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
        <br><br><br>
        <?php
            require_once "../support/footer.php";
        ?>
    </body>
</html>