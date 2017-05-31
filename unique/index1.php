<?php
        define("DB_SERVER", "localhost");
        define("DB_USERNAME", "root");
        define("DB_PASSWORD", "");
        define("DB_DATABASE", "unique2_unique786");

        $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
		if (!$connection)
		{
			die('Could not connect: ' . mysqli_connect_error());
		}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Unique Travels</title>
    <!-- Bootstrap Core CSS -->
    <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<style type="text/css">
.clear {clear: both !important;}
</style>

</head>
<body>
    <div class="container">
	<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0px; height: 140px;">
        <?php 
        $SQL = "SELECT * FROM tbllogo WHERE logo_status = '1'  ORDER BY logo_id DESC";			
        $result = mysqli_query($connection, $SQL) or die(mysqli_connect_error());
        $strRow = mysqli_fetch_array($result);
        $Status = $strRow['logo_status'];
        $Image = $strRow['logo_image'];
?>
	<div class="">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
				<?php if(!empty($Image)) {?>
                <div class="row">
                <div class="pull-left col-lg-4">
                <a class="navbar-brand" href="home"><img src="../utt-staff/images/logo/<?php echo $Image;?>" height="80" 
                width="300" alt="Logo"></a>
                </div>
                <?php } ?>
                <!-- <div class="pull-left col-lg-2">&nbsp;</div> -->
                <!-- <div class="pull-left col-lg-6" id="imageslideshow3"></div> -->
                <?php if(isset($_GET['error']) && $_GET['error'] == "1") {?>
                    <div class="alert alert-danger">User Name and Password is wrong!</div>
                <?php } ?>
                <div class="pull-right col-lg-8">
                        
                        <form class="navbar-form navbar-right" role="form" action="login.php" method="post" id="LoginForm">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input class="form-control" placeholder="User Name" name="strNewLoginx" type="text" autofocus>
                        </div>

                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input class="form-control" placeholder="Password" name="strNewPassword" type="password" value="">                                        
                        </div>

                        <button type="submit" class="btn btn-primary">Login</button>
                   </form>
                   <div class="clear"></div>
                   <ul class="nav navbar-nav">
                    <li class="active"><a href="#">About Us</a></li>
                    <li><a href="#">Contact Us</a></li>
                  </ul>
                </div>
                </div>
            </div>
    </nav>
    <div style="clear:both;"></div>
    </div>
    <!-- jQuery -->
    <script src="bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Metis Menu Plugin JavaScript -->
    <script src="bower_components/metisMenu/dist/metisMenu.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>
    <script type="text/javascript" src="js/slide-show.js"></script>
    
</body>
</html>

