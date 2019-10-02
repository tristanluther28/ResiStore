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
            <div class="row mt centered">
            <?php
                if(isset($_SESSION['id']) && ($_SESSION['sudo'] == '1' || $_SESSION['sudo'] == '2')){
            ?>
                <div class="col-lg-3 col-md-4 col-sm-4">
                    <h1 class="alter">Member Registration</h1>
                    <p class="white">Fill out this form to become a OSURC Member!</p>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-5">
                    <form action="../sub_tools/signup_osurc_process.php" method="post">
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
                            <label class="white">OSU ID Number</label>
                            <input type="text" name="osuid" class="form-control" required>
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group">
                            <label class="white">E-mail</label>
                            <input type="email" name="email" class="form-control" value="" required>
                            <span class="help-block"></span>
                        </div>
                        <div class='form-group'>
                            <label class="white">Current Major</label>
                            <input name="major" type="text" list="major" required/>
                                <datalist id="major" name="major">
                                <option>Mechanical Engineering</option>
                                <option>Electrical & Computer Engineering</option>
                                <option>Computer Science</option>
                                <option>Civil Engineering</option>
                                <option>Industrial Engineering</option>
                                <option>Manufacturing Engineering</option>
                                <option>Nuclear Engineering</option>
                                <option>Chemical Engineering</option>
                                <option>Bioengineering</option>
                                <option>Construction Engineering Management</option>
                                <option>Ecological Engineering</option>
                                <option>Environmental Engineering</option>
                                <option>General Engineering</option>
                                <option>Earth Sciences</option>
                                <option>Ocean Sciences</option>
                                </datalist>
                        </div>
                        <div class='form-group'>
                            <label class="white">Standing at OSU</label>
                            <input name="standing" type="text" list="standing" required/>
                                <datalist id="standing" name="standing">
                                <option>Undergraduate</option>
                                <option>Graduate</option>
                                </datalist>
                        </div>
                        <div class='form-group'>
                            <label class="white">Club Interests</label><br>
                            <div class="white">
                                <input class="white" type="checkbox" name="intr[]" value="Roving Robots (Mars Rover)"> Roving Robots (Mars Rover)<br>
                                <input class="white" type="checkbox" name="intr[]" value="Flying Robots (Aerial)"> Flying Robots (Aerial)<br>
                                <input class="white" type="checkbox" name="intr[]" value="Drone Racing"> Drone Racing<br>
                                <input class="white" type="checkbox" name="intr[]" value="Swimming Robots (Underwater)"> Swimming Robots (Underwater)<br>
                                <input class="white" type="checkbox" name="intr[]" value="ORK Robots (Club Robotics Kit)"> ORK Robots (Club Robotics Kit)<br>
                                <input class="white" type="checkbox" name="intr[]" value="Club Lab Work-space Access"> Club Lab Work-space Access<br>
                                <input class="white" type="checkbox" name="intr[]" value="Personal Robots and Projects"> Personal Robots and Projects<br>
                                <input class="white" type="checkbox" name="intr[]" value="Job and Internship Networking"> Job and Internship Networking<br>
                                <input class="white" type="checkbox" name="intr[]" value="Leadership Opportunities"> Leadership Opportunities<br>
                                <input class="white" type="checkbox" name="intr[]" value="FIRST Involvement"> FIRST Involvement<br>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="white">RFID Number</label>
                            <input type="number" name="rfid" class="form-control" required>
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group">
                            <label class="white">Membership Option</label><br>
                            <div class="white">
                                <input class="white" type="radio" name="op" value="$10 - Membership Only"> $10 - Membership Only<br>
                                <input class="white" type="radio" name="op" value="$20 - Membership and Shirt"> $20 - Membership and Shirt<br>
                                <input class="white" type="radio" name="op" value="$0 - Payment Pending"> $0 - Payment Pending<br>
                            </div>
                        </div>
                        <div class="row pt centered">
                            
                        </div>
                        <div class="form-group">
                            <input name ="submit" type="submit" class="btn btn-info" value="Submit">
                            <input type="reset" class="btn btn-default" value="Reset">
                        </div>
                        <p class="white">Already a Member? <a href="../login">Login here</a>.</p>
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