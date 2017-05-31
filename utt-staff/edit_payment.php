<?php include_once('top.php');

	$strRow = "";

	if(!empty($_GET['id']))

	{

		$ID = $_GET['id'];

		$Where = "id = '".$ID."'";

		$strRow = GetRecord("tblepayment", $Where);

		$amount = $strRow['amount'];

		$transection_id = $strRow['transection_id'];

		$bank_id = $strRow['bank_id'];

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

                    <h1 class="page-header hide">Edit Payment</h1>

                </div>

                <!-- /.col-lg-12 -->

            </div>

            <!-- /.row -->

            <div class="row" style="margin-top:25px;">

                <div class="col-lg-12">

                    <div class="panel panel-default">
                    <?php if($_GET['msg'] == "sent") {?>
					<div class="alert alert-success">Your request in processing!</div>
                    <?php } elseif($_GET['msg'] == "nosent") {  ?>
					<div class="alert alert-success">Email not sent successfully!</div>	
					<?php } ?>	
                        <div class="panel-heading">

                            Edit Payment

                        </div>

                        <div class="panel-body">

                            <div class="row">

                                <div class="col-lg-12">

                                    <form role="form" action="action.php" id="myForm" method="post"  enctype="multipart/form-data">

                                    <input type="hidden" name="action" id="action" value="EditPayment" />
                                    <input type="hidden" name="edit_id" id="edit_id" value="<?php echo $ID; ?>" />

                                        <?php

                                        TextField("Amount", "Amount", $amount, "20","6","form-control required number_only");

										TextField("TransductionID", "transection_id", $transection_id, "10","6","form-control required");

										?>

                                        <div class="clear"></div>

                                        <div class="clear m-t-10"></div>

										<?php

                                        //TextField("PIN", "pin", "", "20","6","form-control required");

										//ArrayComboBox("Select Bank", "", $arrContactPersonType, true, "", "---Select Bank---", "required");

										?>

                                        <div class="form-group col-lg-6 m-b-0">

                                        <label>Select Bank</label>

										<?php ArrayComboBox("bank_id", $bank_id, $arrBank, true, "", "", "form-control required", "");?>

                                        </div>

                                        <div class="clear"></div>
                                        <div class="form-group m-r-15 m-t-10 col-lg-6">

                                            <label>Upload Bank Slip</label>

                                            <input type="file" name="fileToUpload" id="fileToUpload" class="">

                                        </div>	
                                        <div class="clear"></div>
                                        <div class="form-group col-lg-6">

                                        <button type="submit" class="btn btn-default m-t-10">Submit</button>

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

