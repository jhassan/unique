<?php
$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "unique2_unique786";
		
		$connection = mysqli_connect("$servername","$username","$password","$dbname");
		if (!$connection)
		{
			die('Could not connect: ' . mysqli_connect_error());
		}
		else
		{ 
		
		// $dbcheck = mysqli_select_db("$dbname");
		// if (!$dbcheck) {
		// 	echo mysqli_error(); die;
		// }
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
	<div class="navbar-header">

                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">

                    <span class="sr-only">Toggle navigation</span>

                    <span class="icon-bar"></span>

                    <span class="icon-bar"></span>

                    <span class="icon-bar"></span>

                </button>
				<?php if(!empty($Image)) {?>
                <div class="pull-left col-lg-4">
                <a class="navbar-brand" href="home"><img src="../admin/images/logo/<?php echo $Image;?>" height="80" 
                width="300" alt="Logo"></a>
                </div>
                <?php } ?>
                <div class="pull-left col-lg-2">&nbsp;</div>
                <div class="pull-left col-lg-6" id="imageslideshow3"></div>

            </div>	
	
    
        </nav>
        <div style="clear:both;"></div>
        <div class="row">
        
        <?php
        // Main banner
		$SQL1 = "SELECT * FROM tblbanner WHERE banner_status = 1 ORDER BY banner_id DESC";			
		$result1 = mysqli_query($connection, $SQL1) or die(mysqli_connect_error());
		$str = "";
		if(count($result1) > 0)
		{
		while($row = mysqli_fetch_array($result1)) { // ,MYSQL_ASSOC

			$str .= '["../admin/images/banners/'.$row['banner_image'].'"],';

		}
		}
		$banner = rtrim($str,",");
		
		// Header Top banner
		$SQL2 = "SELECT * FROM tbltopbanner WHERE banner_status = 1 ORDER BY banner_id DESC";			
		$result2 = mysqli_query($connection, $SQL2) or die(mysqli_connect_error());
		$str2 = "";
		if(count($result2) > 0)
		{
		while($row2 = mysqli_fetch_array($result2)) { // ,MYSQL_ASSOC

			$str2 .= '["../admin/images/top_banners/'.$row2['banner_image'].'"],';

		}
		}
		$banner2 = rtrim($str2,",");
		
		?>
		<div class="col-md-9" style="float:left; margin-top:50px;" id="imageslideshow2"></div>
            <div class="col-md-2" style="float:right;">

                <div class="login-panel panel panel-default" style="margin-top: 50px;"> 

                <?php if(isset($_GET['error']) && $_GET['error'] == "1") {?>

                <div class="alert alert-danger">User Name and Password is wrong!</div>

                <?php } ?>

                    <div class="panel-heading">

                        <h3 class="panel-title">Please Sign In</h3>

                    </div>

                    

                    <div class="panel-body">

                        <form role="form" action="login.php" method="post" id="LoginForm">

                            <fieldset>

                                <div class="form-group">

                                    <input class="form-control" placeholder="User Name" name="strNewLoginx" type="text" autofocus>

                                </div>

                                <div class="form-group">

                                    <input class="form-control" placeholder="Password" name="strNewPassword" type="password" value="">

                                </div>

                                <div class="checkbox hide">

                                    <label>

                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me

                                    </label>

                                </div>

                                <div class="form-group col-lg-6" style="padding-left:0px;">

                                    <button type="submit" class="btn btn-default">Login</button>

                                </div>

                                <!-- Change this to a button or input when using this as a form -->

                                <!--<a href="index.html" class="btn btn-lg btn-success btn-block">Login</a>-->

                            </fieldset>

                        </form>

                    </div>

                </div>

            </div>

        </div>

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

    <script type="text/javascript">  

	var mygallery=new fadeSlideShow({   

	 wrapperid: "imageslideshow2", //ID of blank DIV on page to house Slideshow   

	 dimensions: [970, 320], //width/height of gallery in pixels. Should reflect dimensions of largest image (www.2createawebsites.com)

	   imagearray:  [ <?php echo $banner; ?>],

	  displaymode: {type:'auto', pause:1000, cycles:0, wraparound:false},   

	  persist: false, //remember last viewed slide and recall within same session?   

	  fadeduration: 4000, //transition duration (milliseconds)  

	  descreveal: "ondemand",

	  togglerid: ""

	  });
	  
	  // Top header banner
	  var mygallery=new fadeSlideShow({   

	 wrapperid: "imageslideshow3", //ID of blank DIV on page to house Slideshow   

	 dimensions: [750, 100], //width/height of gallery in pixels. Should reflect dimensions of largest image (www.2createawebsites.com)

	   imagearray:  [ <?php echo $banner2; ?>],

	  displaymode: {type:'auto', pause:1000, cycles:0, wraparound:false},   

	  persist: false, //remember last viewed slide and recall within same session?   

	  fadeduration: 4000, //transition duration (milliseconds)  

	  descreveal: "ondemand",

	  togglerid: ""

	  })
	  

 </script>



</body>



</html>

