<?php
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
                <br><br><br>
                <div class="col-md-6 col-md-offset-3 text-center">
                <a name="avalibility"></a>   
                    <img class="img-responsive-middle" src="./img/safe/logo-inverse.png" alt="ResiStore!">
                    <hr>
                    <h3 class="white">An electronics store powered by the</h3>
                    <a href="https://www.osurobotics.club/"><img class="img-responsive-middle" src="/img/safe/logo-osurc-inverse.png" alt="OSURC!"></a>
                    <div class="avalibility-banner1" id="closed">
                        <h3 class="white">The store is currently
                        <?php
                        if (isset($_GET['lux'])){
                            $lux = $_GET['lux'];
                            if($lux == "1"){
                        ?>
                        <span class="label label-warning" id="store-status">Closed</span>
                        <?php
                            }
                            else{
                        ?>
                        <span class="label label-success" id="store-status">Open</span>
                        <?php
                            }
                        }
                        else{
                        ?>
                        <span class="label label-default" id="store-status">No Connection</span>
                        <?php
                        }
                        ?>
                        <button type="button" class="btn btn-info" role="button" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="bottom" data-html="true" data-content="&lt;div&gt;This status is polled from a sensor in the store! This lets you know whether someone is in the store &lt;i&gt;right now.&lt;i&gt;&lt;div&gt;" data-original-title="" title="">ⓘ</button>
                        </h3>
                        <script>
                            $(document).ready(function(){
                                $('[data-toggle="popover"]').popover();   
                            });
                        </script>
                    </div>
                </div>
            </div>
            <div class="row mt centered">
                <div class="col-md-3">
                </div>
                <?php
                    $input = "";
                    $narrow = "name";
                    $product = new Product();
                    $rows = $product->get_most_sold($input);
                ?>
                <h1 class="alter">Top Selling</h1>
                <hr>
                <?php
                    $i = 0;
                    foreach($rows as $row){
                        if($row['qty']!=0){
                ?>
                <div class="col-lg-3" >
                    <a href="inventory/item.php?plu=<?php echo $row['plu']?>"><img class="img-responsive" src="<?php echo '../img/'.$row['picture'];?>" alt="ResiStore!"></a>
                    <h3 class="text-center alter"><?php echo $row['description'] ?></h3>
                </div>
                <?php
                            if(++$i == 4){
                                break;
                            }
                        }
                    }
                ?>
                
            </div>
            <hr>
            <div class="row mt centered">
                <div class="col-md-4">
                    <div class="text-center">
                        <h3 class="alter">What's the ResiStore?</h3>
                    </div>
                    <p class="index-text">
                        The ResiSTORE is an on-campus electronic component store managed by the <a href="https://www.osurobotics.club/">OSU Robotics Club</a>! 
                        <br>It offers many of the components you need to complete your 
                        engineering coursework, design work, and personal projects. 
                    </p>
                </div>
                <div class="col-md-4">
                    <div class="text-center">
                        <h3 class="alter">What do we sell?</h3>
                    </div>
                    <p class="index-text">
                        We sell just about every common electronic component along with some 
                        of the rarer TTL logic chips. We also have a selection of microcontrollers and so much more!
                        <br>Check out the inventory page for the full list of items.<br>
                    </p>
                    <div class="text-center">
                        <a href="/inventory" class="btn btn-info pull-center">Full Inventory</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center">
                        <h3 class="alter">Where's the ResiStore?</h3>
                    </div>
                    <p class="index-text">
                        We are located in the basement of <a href="https://map.oregonstate.edu//?building=Dear">Dearborn Hall</a>, next 
                        to the elevator and staircase. <br>That's room number DEAR 007. 
                    </p>
                </div>
            </div>
        </div>
        <br><br><br>
    <?php
            require_once "./support/footer.php";
    ?>
    </body>
</html>