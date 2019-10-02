<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="desktop-nav">
            <div class="mobile-nav">
                <div id="mobile-header">
                    <div>
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mobile-menu">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span> 
                        </button>
                    </div>
                    <div>
                        <a class="mobile-header-logo" href="https://resi.store">
                            <img alt="ResiStore Logo" height="30" width="100" id="logo_small" src="<?php echo $level ?>img/safe/logo-inverse.png" title="ResiStore">
                        </a>
                    </div>
                    <div>
                        <button type="button" class="mobile-header-search navbar-toggle" data-toggle="collapse" data-target="#mobile-search">
                            <i class="glyphicon glyphicon-search"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="collapse navbar-collapse" id="mobile-menu">
                    <ul class="nav navbar-nav">
                        <li><a href="http://resi.store">Home</a></li>
                        <li><a href="<?php echo $level ?>inventory">Inventory</a></li>
                        <li><a href="<?php echo $level ?>hours">Hours</a></li>
                        <li><a href="<?php echo $level ?>getinvolved">Get Involved</a></li>
                        <?php
                            if(isset($_SESSION['id']) && ($_SESSION['sudo'] != '1' && $_SESSION['sudo'] != '2')){
                        ?>
                        <li><a href="<?php echo $level ?>sub_tools">Volunteer Resources</a></li>
                        <?php
                            }
                            else if(isset($_SESSION['id']) && $_SESSION['sudo'] == '1'){
                        ?>
                        <li><a href="<?php echo $level ?>tools">Manager Tools</a></li>
                        <?php
                             }
                             else if(isset($_SESSION['id']) && $_SESSION['sudo'] == '2'){
                                ?>
                                <li><a href="<?php echo $level ?>sub_tools">Officer Resources</a></li>
                                <?php
                                     }
                            if(isset($_SESSION['id'])){
                        ?>
                        <li><a href="<?php echo $level ?>login/logout.php">Log Out</a></li>
                        <?php
                            }
                            else{
                        ?>
                        <li><a href="<?php echo $level ?>login">Log In</a></li>
                        <?php
                            }
                        ?>
                    </ul>
            </div>
            <div class="collapse navbar-collapse" id="mobile-search">
                <form class="navbar-form navbar-right form-group" action="<?php echo $level ?>inventory/itemList.php" method="get">
                    <label for="narrow" style="color:white;">Search by</label>
                    <select name="narrow" id="narrow" class="form-control">
                        <option value="*">All</option>
                        <option value="plu">PLU</option>
                        <option value="name">Name</option>
                        <option value="price">Price</option>
                    </select>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search..." name="bar">
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-default" name="submitButton">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div id="desktop-header">
            <div class="row mt centered">
                    <?php
                        if(isset($_SESSION['id'])){
                    ?>
                <div class="col-sm-1 col-md-offset-9 text-right top-buffer">
                    <h6 class="white">Welcome <?php echo $_SESSION['firstName'] ?></h6>
                </div>
                <div class="col-sm-1 text-right top-buffer">
                    <a href="<?php echo $level ?>login/logout.php"><h6>Log Out</h6></a>
                </div>  
                    <?php
                            }
                            else{
                        ?>
                <div class="col-sm-1 col-md-offset-10 text-right top-buffer">
                    <a href="<?php echo $level ?>login"><h6>Log In</h6></a>
                </div>
                <div class="col-sm-1 text-left">
                    <a href="<?php echo $level ?>getinvolved"><h6>Sign Up</h6></a>
                </div>
                        <?php
                            }
                        ?>
            </div>
            <div class="navbar-header">
                <a class="navbar-brand" href="<?php echo $level ?>index.php"><img class="img-responsive" height=30 width=100 src="<?php echo $level ?>img/safe/logo-inverse.png" alt="ResiStore"></a>
            </div>
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a class="dropdown-toggle" href="<?php echo $level ?>inventory" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        Inventory
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo $level ?>inventory"><span class="black">Product Categories (</span>See all<span class="black">)</span></a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="<?php echo $level ?>inventory/sort.php"><span class="black">Product Table (</span>See full table<span class="black">)</span></a></li>
                        <li role="separator" class="divider"></li>
                            <?php
                                $product = new Product();
                                $diff_cat = $product->get_categories();
                                for($i = 0; $i < count($diff_cat); $i++){
                            ?>
                            <li><a href="<?php echo $level ?>inventory/itemList.php?cate=<?php echo $diff_cat[$i][0]?>"><?php echo $diff_cat[$i][0]?></a></li>
                            <?php
                                }
                            ?>
                    </ul>
                </li>
                <li><a href="<?php echo $level ?>hours">Hours</a></li>
                <li><a href="<?php echo $level ?>getinvolved">Get Involved</a></li>
                    <?php
                        if(isset($_SESSION['id']) && ($_SESSION['sudo'] != '1' && $_SESSION['sudo'] != '2')){
                    ?>
                <li><a href="<?php echo $level ?>sub_tools">Volunteer Resources</a></li>
                    <?php
                        }
                        else if(isset($_SESSION['id']) && $_SESSION['sudo'] == '1'){
                    ?>
                <li><a href="<?php echo $level ?>tools">Manager Tools</a></li>
                    <?php
                        }
                        else if(isset($_SESSION['id']) && $_SESSION['sudo'] == '2'){
                    ?>
                        <li><a href="<?php echo $level ?>sub_tools">Officer Resources</a></li>
                    <?php
                        }
                    ?>
            </ul>
            <form class="navbar-form navbar-right form-group" action="<?php echo $level ?>inventory/itemList.php" method="get">
                <label for="narrow" style="color:white;">Search by</label>
                <select name="narrow" id="narrow" class="form-control">
                    <option value="*">All</option>
                    <option value="plu">PLU</option>
                    <option value="name">Name</option>
                    <option value="price">Price</option>
                </select>
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search..." name="bar">
                    <div class="input-group-btn">
                        <button type="submit" class="btn btn-default" name="submitButton">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</nav>