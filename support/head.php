<meta charset="utf-8" />
<title>ResiSTORE | An electronic store powered by OSURC</title>
<link rel="shortcut icon" type="image/png" href="../img/safe/favicon.ico">
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