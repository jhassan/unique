<?php include_once('top.php');
	$strRow = "";
	if(!empty($_GET['id']))
	{
		$ID = $_GET['id'];
		$Where = "air_line_id = '".$ID."'";
		$strRow = GetRecord("tblairlines", $Where);
		$Name = $strRow['air_line_name'];
		$Code = $strRow['air_line_code'];
		$Image = $strRow['air_line_image'];
	}
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
                    <h1 class="page-header hide">Feedback and Complains</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row" style="margin-top:25px;">
                <div class="col-lg-12">
                    <div class="panel panel-default">

                    <?php if($_GET['msg'] == "sent") {?>

					<div class="alert alert-success">Email sent successfully!</div>

                    <?php } elseif($_GET['msg'] == "nosent") {  ?>

					<div class="alert alert-success">Email not sent successfully!</div>	

					<?php } ?>	

                        <div class="panel-heading">
                            Feedback and Complains
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form role="form" action="action.php" id="myForm" method="post">
                                    <input type="hidden" name="action" id="action" value="AddFeedback" />
										<div class="form-group">
                                            <textarea class="form-control m-t-5 required" name="feedback" rows="8"></textarea>
                                        </div>
                                        <div class="clear"></div>
                                        
                                        <div class="form-group col-lg-6">
                                        <button type="submit" class="btn btn-default m-t-10">Send</button>
                                        <button type="reset" class="btn btn-default hide">Reset Button</button>
                                        </div>
                                    </form>
                                </div>
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
		var validate = jQuery('#myForm').validate();
		
	});
    </script>

</body>

</html>
