<?php
    $level = '';
    function __autoload($class){
        require_once "./classes/$class.php";
    }
    session_start();
?>
<html>
    <head>
        <?php
            require_once "./support/head.php";
        ?>
    </head>
    <body>
        <?php
            require_once "./support/nav.php";
        ?>
        <div class="container pt">
            <div class="row mt centered">
                <br><br>
                <h1 class="alter text-center">404 Error: Page Not Found</h1>
                <br>
                <img class="img-responsive" src="/img/safe/doge.jpg" alt="404">
                <br>
                <h1 class="alter text-center">Sorry we couldn't find that page</h1>
            </div>
        </div>
        <br><br><br>
    <?php
            require_once "./support/footer.php";
    ?>
    </body>
</html>