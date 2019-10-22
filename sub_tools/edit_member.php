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
                $input = $_GET['id'];
                $member = new Member();
                $rows = $member->search_id($input);
                $row = $rows[0];
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
                <h1 class="alter">Edit <?php echo $row['firstName']. " " .$row['lastName'] ?></h1>
                <hr>
                <form method="post" action="../sub_tools/edit_member_process.php?id=<?php echo $row['id']?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="white">First Name: </label>
                        <input type="text" name="firstName" value="<?php echo $row['firstName']?>" style="width: 500px" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label class="white">Last Name: </label>
                        <input type="text" name="lastName" value="<?php echo $row['lastName']?>" style="width: 500px" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label class="white">OSU ID: </label>
                        <input type="number" name="osu_id" value="<?php echo $row['osu_id'];?>" style="width: 100px" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label class="white">E-mail: </label>
                        <input type="text" name="email" value="<?php echo $row['email'];?>" style="width: 500px" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label class="white">Major: </label>
                        <input type="text" name="major" value="<?php echo $row['major'] ?>" style="width: 500px" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label class="white">RFID Number: </label>
                        <input type="number" name="rfid" value="<?php echo $row['rfid'] ?>" style="width: 500px" class="form-control" required>
                    </div>
                    <div class="form-group">
                            <label class="white">Membership Option: </label><br>
                            <div class="white">
                                <?php
                                    if($row['opt'] == '$10 - Membership Only'){
                                ?>
                                <input class="white" type="radio" name="opt" value="$10 - Membership Only" checked="checked"> $10 - Membership Only<br>
                                <input class="white" type="radio" name="opt" value="$20 - Membership and Shirt"> $20 - Membership and Shirt<br>
                                <input class="white" type="radio" name="opt" value="$0 - Payment Pending"> $0 - Payment Pending<br>
                                <?php
                                    }
                                    else if($row['opt'] == '$20 = Membership and Shirt'){
                                ?>
                                <input class="white" type="radio" name="opt" value="$10 - Membership Only" > $10 - Membership Only<br>
                                <input class="white" type="radio" name="opt" value="$20 - Membership and Shirt" checked="checked"> $20 - Membership and Shirt<br>
                                <input class="white" type="radio" name="opt" value="$0 - Payment Pending"> $0 - Payment Pending<br>
                                <?php
                                    }
                                    else{
                                ?>
                                <input class="white" type="radio" name="opt" value="$10 - Membership Only"> $10 - Membership Only<br>
                                <input class="white" type="radio" name="opt" value="$20 - Membership and Shirt"> $20 - Membership and Shirt<br>
                                <input class="white" type="radio" name="opt" value="$0 - Payment Pending" checked="checked"> $0 - Payment Pending<br>
                                <?php
                                    }
                                ?>
                            </div>
                    </div>
                    <div class="form-group">
                        <input name ="submit" type="submit" class="btn btn-info" value="Submit">
                        <input type="reset" class="btn btn-default" value="Reset">
                    </div>
                </form>
            <?php
                }
                else{
                    header("Location: ../404.php");
                    exit();
                }
            ?>
            <br><br>
            </div>
        </div>
        <?php
            require_once "../support/footer.php";
        ?>
    </body>
</html>