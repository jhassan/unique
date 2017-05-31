<?php include_once('top.php');

	$strRow = "";

	if(!empty($_GET['id']))

	{

		$ID = $_GET['id'];

		$Where = "id = '".$ID."'";

		$strRow = GetRecord("tblothers", $Where);

		$other_url = trim($strRow['other_url']);

		$other_image = $strRow['other_image'];
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

                    <h1 class="page-header">Others</h1>

                </div>

                <!-- /.col-lg-12 -->

            </div>

            <!-- /.row -->

            <div class="row">

                <div class="col-lg-12">

                    <div class="panel panel-default">

                        <div class="panel-heading">

                            Others

                        </div>

                        <div class="panel-body">

                            <div class="row">

                                <div class="col-lg-12">

                                    <form role="form" action="action.php" id="myForm" method="post" enctype="multipart/form-data">

                                    <input type="hidden" name="action" id="action" value="AddOthers" />

						            <input type="hidden" name="ID" id="ID" value="<?php echo $ID; ?>" />

                                      <div class="form-group m-b-0 col-lg-6">
                                        <label>URL</label>
                                        <input type="text" class="form-control required" placeholder="URL" name="other_url" id="other_url" value=" <?php echo $other_url; ?>" maxlength="">
                                    </div>
                                      <div class="clear"></div>
                                        <div class="form-group m-r-15 m-t-10 col-lg-6 p-l-0">

                                            <label>Upload Image</label>
                                            <?php if(!empty($other_image)) { ?>
                                                <input type="file" name="fileToUpload" id="fileToUpload" class="">
                                            <?php } else { ?>
                                                <input type="file" name="fileToUpload" id="fileToUpload" class="required">
                                            <?php } ?>    
                                        </div>
                                        
                                        <div class="form-group col-lg-4 m-t-10">

                                        	<?php if(!empty($ID)) { ?>

                                            <img src="images/others/<?php echo $other_image;?>" height="25" width="70" alt="Others">

                                            <?php } ?>

                                        </div>

                                        <div class="clear"></div>

                                        <div class="form-group col-lg-6">

                                        <button type="submit" class="btn btn-default m-t-10">Save</button>

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

		//var validate = jQuery('#myForm').validate();

		//alert(validate); return false;

		jQuery('#myForm').validate(); 

	});

    </script>



</body>



</html>

