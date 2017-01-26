<?php include_once('top.php');
	$ID = mysql_real_escape_string($_GET['id']);
	
	$Where = " user_air_line_id = 11";
	$nRecUser = GetRecord('tbluserairlines', $Where);
	//var_dump($nRecUser);
	$Url = $nRecUser['user_url'];
	var_dump($Url);
?>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <?php include_once('header.php');?>    

        <?php include_once('leftsidebar.php');?>     
        </nav>
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Air Lines</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Air Lines
                        </div>
                        <div class="panel-body">
                            <div class="row">
                            <iframe src="http://www.w3schools.com"></iframe>
                                <iframe width="500" height="600" src="<?php echo $Url;?>"></iframe>
                                <!-- /.col-lg-6 (nested) -->
                                
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
       <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <?php include_once('jquery.php');?>
    <script type="text/javascript">
	jQuery(function (){
		//jQuery('#myForm').validate();
	});
    </script>

</body>

</html>
