<meta charset="utf-8" />
<title>ResiSTORE | An electronic store powered by OSURC</title>
<link rel="shortcut icon" type="image/png" href="img/safe/favicon.ico">
<meta name="description" content="ResiStore: an electroincs store powered by the Oregon State Robotics Club">
<meta name="keywords" content="robotics, materials, oregon state, oregon state university, OSU, OSU engineering, 
OSU computer science, electronics, electronics store, robotics store, OSURC, oregon state robotics club, 
oregon state university robotics club store,  oregon state university robotics club, osurobotics, osurobotics.club, 
Resistore, RESI-store, resi store, arduino OSU, teensy OSU, arduino, teensy, motors, motor controllers, connectors, dev boards">
<meta name="viewport" content="initial-scale=1.0; maximum-scale=1.0; width=device-width;">
<meta name="author" content="Tristan Luther" date="10/24/2018">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="../css/style.css">
<?php
    if(isset($_SESSION['id'])){
        if((time() - $_SESSION['last_login_time'] > 1800)){ //1800 = 30min * 60sec/min
            header("Location: ../login/logout.php");
            exit();
        }
        else{
            $_SESSION['last_login_time'] = time();
        }
    }
?>
