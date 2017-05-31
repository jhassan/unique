<?php include_once("header1.php"); ?>

    <!-- Header Carousel -->
    <header id="myCarousel" class="carousel slide" style="clear:both; margin-top: 51px;">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <?php
            // Main banner
            $SQL2 = "SELECT * FROM tblbanner WHERE banner_status = 1 ORDER BY banner_id DESC";          
            $result2 = mysqli_query($connection, $SQL2) or die(mysqli_connect_error());
            $str = "";
            if(count($result2) > 0)
            {
                $i = 0;
                while($row = mysqli_fetch_array($result2)) { // ,MYSQL_ASSOC
                    // $row['banner_image']
                    if($i == 0)
                        $class = "active";
                    else
                        $class = "";
                    $i++;
            ?>
            <li data-target="#myCarousel" data-slide-to="<?php echo $i; ?>" class="<?php echo $class; ?>"></li>
            <?php } } ?>
            <!-- <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li> -->
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <?php
            // Main banner
            $SQL1 = "SELECT * FROM tblbanner WHERE banner_status = 1 ORDER BY banner_id DESC";          
            $result1 = mysqli_query($connection, $SQL1) or die(mysqli_connect_error());
            $str = "";
            if(count($result1) > 0)
            {
                $i = 0;
                while($row = mysqli_fetch_array($result1)) { // ,MYSQL_ASSOC
                    // $row['banner_image']
                    if($i == 0)
                        $class = "active";
                    else
                        $class = "";
                    $str .= "<div class='item ".$class."'>";
                        $str .= "<div class='fill' style='background-image:url(../utt-staff/images/banners/".$row['banner_image'].");'></div>";
                        $str .= "<div class='carousel-caption'>";
                        $str .= "</div>";
                    $str .= "</div>";
                    
                    $i++;
                }
                echo $str;
            }
            ?>
            
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="icon-prev"></span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="icon-next"></span>
        </a>
    </header>

    <!-- Page Content -->
    <div class="container">

        <!-- Marketing Icons Section -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Welcome to Modern Business
                </h1>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4><i class="fa fa-fw fa-check"></i> Bootstrap v3.3.7</h4>
                    </div>
                    <div class="panel-body">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque, optio corporis quae nulla aspernatur in alias at numquam rerum ea excepturi expedita tenetur assumenda voluptatibus eveniet incidunt dicta nostrum quod?</p>
                        <a href="#" class="btn btn-default">Learn More</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4><i class="fa fa-fw fa-gift"></i> Free &amp; Open Source</h4>
                    </div>
                    <div class="panel-body">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque, optio corporis quae nulla aspernatur in alias at numquam rerum ea excepturi expedita tenetur assumenda voluptatibus eveniet incidunt dicta nostrum quod?</p>
                        <a href="#" class="btn btn-default">Learn More</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4><i class="fa fa-fw fa-compass"></i> Easy to Use</h4>
                    </div>
                    <div class="panel-body">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque, optio corporis quae nulla aspernatur in alias at numquam rerum ea excepturi expedita tenetur assumenda voluptatibus eveniet incidunt dicta nostrum quod?</p>
                        <a href="#" class="btn btn-default">Learn More</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
        <?php include_once("footer.php"); ?>