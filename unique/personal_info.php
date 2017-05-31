<?php include_once('top.php');
	$strRow = "";
	$whereBank = " text_id = '1'";

	$GetRecordNotes = GetRecord("tblpersonaltext", $whereBank);

	$text_details = $GetRecordNotes['text_details'];
	
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
                    <h1 class="page-header hide">Contact Detail</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row" style="margin-top:25px;">
                <div class="col-lg-12">
                    <div class="panel panel-default">

                        <div class="panel-heading">
                            Contact Detail
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
										<div class="form-group m-10">
                                            <?php echo html_entity_decode($text_details);?>
                                        </div>
                                        <div class="clear"></div>                                </div>
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
