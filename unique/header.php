<?php	$Where = "logo_status = '1'";

		$strRow = GetRecord("tbllogo", $Where);

		$Status = $strRow['logo_status'];

		$Image = $strRow['logo_image'];
		
		// Header Top banner
		$SQL21 = "SELECT * FROM tbltopbanner WHERE banner_status = 1 ORDER BY banner_id DESC";			
		$result21 = mysql_query($SQL21) or die(mysql_error());
		$str21 = "";
		if(count($result21) > 0)
		{
		while($row21 = mysql_fetch_array($result21)) { // ,MYSQL_ASSOC

			$str21 .= '["../admin/images/top_banners/'.$row21['banner_image'].'"],';

		}
		}
		$banner21 = rtrim($str21,",");

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

            <!-- /.navbar-header -->

			<div class="clear"></div>

            <ul class="nav navbar-top-links navbar-right">

                

                <!-- /.dropdown -->

                

                <!-- /.dropdown -->

                

                <!-- /.dropdown -->

                <li class="dropdown">

                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">

                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>

                    </a>

                    <ul class="dropdown-menu dropdown-user" style="position:relative; z-index: 9999;">

                        <li class="hide"><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>

                        </li>

                        <li><a href="change_password"><i class="fa fa-gear fa-fw"></i>Change Password</a>

                        </li>

                        <li class="divider"></li>

                        <li><a href="logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>

                        </li>

                    </ul>

                    <!-- /.dropdown-user -->

                </li>

                <!-- /.dropdown -->

            </ul>

            <!-- /.navbar-top-links -->
            
            <script type="text/javascript" src="js/slide-show.js"></script>

    <script type="text/javascript">  
	  
	  // Top header banner
	  var mygallery=new fadeSlideShow({   

	 wrapperid: "imageslideshow3", //ID of blank DIV on page to house Slideshow   

	 dimensions: [750, 100], //width/height of gallery in pixels. Should reflect dimensions of largest image (www.2createawebsites.com)

	   imagearray:  [ <?php echo $banner21; ?>],

	  displaymode: {type:'auto', pause:1000, cycles:0, wraparound:false},   

	  persist: false, //remember last viewed slide and recall within same session?   

	  fadeduration: 4000, //transition duration (milliseconds)  

	  descreveal: "ondemand",

	  togglerid: ""

	  })
	  

 </script>
 <style type="text/css">
 #imageslideshow3 .gallerylayer { background: #f8f8f8 !important;}
 </style>