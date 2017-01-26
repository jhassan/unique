<?php include_once('top.php');

?>
<body>
    <div id="wrapper" class="p-l-0">
        <!-- Navigation -->

        

        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">

        <?php include_once('header.php');?>    
        <?php include_once('leftsidebar.php');?>     

        </nav>

<style type="text/css">

marquee p

{

    white-space:nowrap;

	float: left;

	padding-left: 200px;

}
.red { color:#F00; }
.blue{ color:#00C;}
.black{ color:#000;}
.bld{ font-weight: bold;}
</style>

        <div id="page-wrapper" class="p-l-0">

            <div class="row">

                <div class="col-lg-12" style="position:fixed;">

                    <marquee style="background: #f8f8f8; padding-top:15px; width:1078px; padding-bottom:2px;" class="p-20" behavior="scroll" direction="left">

                    <?php 

						$SQLText = "SELECT * FROM tbltext WHERE text_status = 1 ORDER BY text_id DESC";			

							 $resultText = MySQLQuery($SQLText);
							 if(count($resultText) > 0)
							 {
							 while($rowText = mysql_fetch_array($resultText)) { // ,MYSQL_ASSOC
							 $color = $rowText['text_color'];
							 $bold = $rowText['text_bold'];
							 if($color == 1)
							 	$classColor = "black";
							 else if($color == 2)
							 	$classColor = "blue";
							 else if($color == 3)
							 	$classColor = "red";		
							if($bold == 1)
								$classBold = "bld";	

					?>

                    <p class="<?php echo $classColor;?> <?php echo $classBold;?>"><?php echo $rowText['marque_text']; ?></p>

                     <?php } }?>

                    </marquee>

					<div id="imageslideshow1" style="margin-top:-2px;"></div>

                    <div class="clear"></div>

                    

                </div>

                <!-- /.col-lg-12 -->

            </div>

            <!-- /.row -->

            

            <!-- /.row -->

            

            <!-- /.row -->

        </div>

        <!-- /#page-wrapper -->
    </div>

    <div class="number_only"></div>

    <!-- /#wrapper -->
    <?php include_once('jquery.php');

		$SQL = "SELECT * FROM tblbanner WHERE banner_status = 1 ORDER BY banner_id DESC";			

		$result = MySQLQuery($SQL);

		$str = "";
		if(count($result) > 0)
		{
		while($row = mysql_fetch_array($result)) { // ,MYSQL_ASSOC

			$str .= '["../admin/images/banners/'.$row['banner_image'].'"],';

		}
		}
		$banner = rtrim($str,",");

	?>

    <script type="text/javascript" src="js/slide-show.js"></script>

    <script type="text/javascript">  

	var mygallery=new fadeSlideShow({   

	 wrapperid: "imageslideshow1", //ID of blank DIV on page to house Slideshow   

	 dimensions: [1080, 320], //width/height of gallery in pixels. Should reflect dimensions of largest image (www.2createawebsites.com)

	   /*imagearray:  [     

	   ["admin/images/banners/hajj.jpg"],    

	   ["admin/images/banners/ssssss.jpg"],

	   ["admin/images/banners/Dubai pacge.jpg"], 

	   ],*/

	   imagearray:  [ <?php echo $banner; ?>],

	  displaymode: {type:'auto', pause:1000, cycles:0, wraparound:false},   

	  persist: false, //remember last viewed slide and recall within same session?   

	  fadeduration: 4000, //transition duration (milliseconds)  

	  descreveal: "ondemand",

	  togglerid: ""

	  })

 </script>
</body>
</html>

<style type="text/css">
 #imageslideshow2 .gallerylayer { background: #f8f8f8 !important; margin-top: -6px;}
 </style>

