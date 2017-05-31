<?php include_once('top.php');

	$strRow = "";

	if(!empty($_GET['id']))

	{

		$ID = $_GET['id'];

		$Where = "vendor_id = '".$ID."'";

		$strRow = GetRecord("tblvendor", $Where);

		$vendor_name = $strRow['vendor_name'];
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

                    <h1 class="page-header">Vendor Name</h1>

                </div>

                <!-- /.col-lg-12 -->

            </div>

            <!-- /.row -->

            <div class="row">

                <div class="col-lg-12">

                    <div class="panel panel-default">

                        <div class="panel-heading">

                            Vendor Name

                        </div>

                        <div class="panel-body">

                            <div class="row">

                                <div class="col-lg-12">

                                    <form role="form" action="action.php" id="myForm" method="post">

                                    <input type="hidden" name="action" id="action" value="AddVendor" />

						            <input type="hidden" name="ID" id="ID" value="<?php echo $ID; ?>" />

                                        <?php

                                        	TextField("Vendor Name", "vendor_name", $vendor_name, "500","6","form-control required");

										?>


                                        <div class="clear"></div>

                                        <div class="form-group col-lg-6">

                                        <button type="submit" id="VendorSave" class="btn btn-default m-t-10">Save</button>

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

