<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="row mt centered">
            <?php
                if(isset($_SESSION['id'])){
            ?>
            <div class="col-sm-1 col-md-offset-9 text-right top-buffer">
                <h6 class="white">Welcome <?php echo $_SESSION['firstName'] ?></h6>
            </div>
            <div class="col-sm-1 text-right top-buffer">
                <a href="../login/logout.php"><h6>Log Out</h6></a>
            </div>  
            <?php
                    }
                    else{
                ?>
            <div class="col-sm-1 col-md-offset-10 text-right top-buffer">
                <a href="../login"><h6>Log In</h6></a>
            </div>
            <div class="col-sm-1 text-left">
                <a href="../getinvolved"><h6>Sign Up</h6></a>
            </div>
                <?php
                    }
                ?>
        </div>
        <div class="navbar-header">
            <a class="navbar-brand" href="../index.php"><img class="img-responsive" height=30 width=100 src="../img/safe/logo-inverse.png" alt="ResiStore"></a>
        </div>
        <ul class="nav navbar-nav">
            <li class="dropdown">
                <a class="dropdown-toggle" href="../inventory" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                    Inventory
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="../inventory"><span class="black">Product Categories (</span>See all<span class="black">)</span></a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="../inventory/sort.php"><span class="black">Product Table (</span>See full table<span class="black">)</span></a></li>
                    <li role="separator" class="divider"></li>
                    <?php
                        $product = new Product();
                        $diff_cat = $product->get_categories();
                        for($i = 0; $i < count($diff_cat); $i++){
                    ?>
                    <li><a href="../inventory/itemList.php?cate=<?php echo $diff_cat[$i][0]?>"><?php echo $diff_cat[$i][0]?></a></li>
                    <?php
                        }
                    ?>
                </ul>
            </li>
            <li><a href="../hours">Hours</a></li>
            <li><a href="../getinvolved">Get Involved</a></li>
            <?php
                if(isset($_SESSION['id']) && $_SESSION['sudo'] != '1'){
            ?>
            <li><a href="../sub_tools">Volunteer Resourses</a></li>
            <?php
                }
                else if(isset($_SESSION['id']) && $_SESSION['sudo'] == '1'){
            ?>
            <li><a href="../tools">Manager Tools</a></li>
            <?php
                    }
            ?>
        </ul>
        <form class="navbar-form navbar-right form-group" action="../inventory/itemList.php" method="get">
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
</nav>