<?php include_once('top.php');

	$strRow = "";

	if(!empty($_GET['id']))

	{

		$ID = $_GET['id'];

		$Where = "id = '".$ID."'";

		$strRow = GetRecord("tblumrah", $Where);

		$package_code = $strRow['package_code'];

		$relation = $strRow['relation'];

		$sur_name = $strRow['sur_name'];
        $given_name = $strRow['given_name'];
        $father_husband_name = $strRow['father_husband_name'];
        $sex = $strRow['sex'];
        $date_of_birth = $strRow['date_of_birth'];
        $place_of_birth = $strRow['place_of_birth'];
        $passport_no = $strRow['passport_no'];
        $passport_issue_date = $strRow['passport_issue_date'];
        $passport_expire_date = $strRow['passport_expire_date'];
        $cnic_issue_date = $strRow['cnic_issue_date'];
        $cnic_expire_date = $strRow['cnic_expire_date'];
        $address_cnic = $strRow['address_cnic'];
        $visa_type = $strRow['visa_type'];
        $no_of_days = $strRow['no_of_days'];
        $cnic_no = $strRow['cnic_no'];
        //$cnic_expiry_date = $strRow['cnic_expiry_date'];
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

                

                <!-- /.col-lg-12 -->

            </div>

            <!-- /.row -->

            <div class="row">

                <div class="col-lg-12">

                    <div class="panel panel-default">

                    <?php if($_GET['msg'] == "sent") {?>



					<div class="alert alert-success">Your Umrah Feeding saved successfully.</div>



                    <?php } elseif($_GET['msg'] == "nosent") {  ?>



					<div class="alert alert-success">Your Umrah Feeding not sent successfully!</div>	



					<?php } ?>	

                        <div class="panel-heading">

                            Edit Visa/Umrah

                        </div>

                        <div class="panel-body">

                            <div class="row">

                                <div class="col-lg-12">

                                    <form role="form" action="action.php" id="myForm" method="post" enctype="multipart/form-data">

                                    <input type="hidden" name="action" id="action" value="UpdateUmrah" />
                                    <input type="hidden" name="edit_id" id="edit_id" value="<?php echo $strRow['id']; ?>" />

                                        <?php TextField("Package Code", "package_code", $package_code, "30","3","form-control"); ?>

                                        <div class="form-group col-lg-3 m-b-0">

                                        <label>Select Relation</label>

																																								<?php ArrayComboBox("Relation", $relation, $arrRelation, true, "", "", "form-control", "");?>

                                                                      </div>

                                        <?php

                                        TextField("Sur Name", "sur_name", $sur_name, "30","3","form-control");

                                        TextField("Given Name", "given_name", $given_name, "30","3","form-control");

																																								?>

																																								<div class="clear m-t-10"></div>

																																								<?php TextField("Father/Husband Name", "father_husband_name", $father_husband_name, "30","3","form-control");?>

																																								
																																								<div class="form-group col-lg-3 m-b-0">

																																								<label>Select Sex</label>

                                        <?php ArrayComboBox("Sex", $sex, $arrSex, true, "", "", "form-control", "");?>

                                                                      </div>

                                        <?php TextField("Date of Birth", "dob", $date_of_birth, "10","3","form-control date_picker_pre"); 

                                           TextField("Place of Birth", "place_of_birth", $place_of_birth, "10","3","form-control");

                                        ?>

                                          <div class="clear m-t-10"></div>

                                        <?php 

                                           TextField("Passport No", "passport_no", $passport_no, "20","3","form-control");

                                           TextField("Passport Issue Date", "passport_issue_date", $passport_issue_date, "10","3","form-control date_picker_pre");

                                              TextField("Passport Expire Date", "passport_expire_date", $passport_expire_date, "10","3","form-control date_picker_future");

                                           TextField("CNIC No", "cnic", $cnic_no, "10","3","form-control"); ?>

                                                                       <div class="clear m-t-10"></div>

                                         <?php     
                                           TextField("CNIC Issue Date", "cnic_issue_date", $cnic_issue_date, "10","3","form-control date_picker_pre");

                                           TextField("CNIC Expiry Date", "cnic_expiry_date", $cnic_expire_date, "10","3","form-control date_picker_future");											

                                           TextField("Address CNIC", "Address_CNIC", $address_cnic, "20","3","form-control");				

                                        ?>

                                        <div class="clear m-t-10"></div>
                                        <div class="form-group col-lg-3 m-b-0">

																																								<label>Visa Type</label>

                                        <?php ArrayComboBox("Visa_type", $visa_type, $arrVisaType, true, "", "", "form-control", "");?>

                                                                      </div>
                                        <?php TextField("No. of Days", "No_of_Days", $no_of_days, "20","3","form-control number_only"); ?>
                                            <div class="clear m-t-10"></div> 
                                            <div class="form-group m-r-15 m-t-10 col-lg-6">

                                            <label>Upload Passport</label>

                                            <input type="file" name="fileToUpload" class="">

                                        </div>    
                                        <div class="clear m-t-10"></div>                      	
                                        	<img src="images/plus.png" name="add_row" id="AddNewRow" class="hide" width="30" style="cursor: pointer; float:right;" />

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

		function DatePickerPre()

		{

			setTimeout(function () {

			$( ".date_picker_pre" ).datepicker({ dateFormat: 'yy-mm-dd', maxDate: '0' }).datepicker("setDate",new Date());

			$( ".date_picker_pre" ).val('<?php echo date("Y-m-d");?>');

			},1000);

		}

		

		function DatePickerFuture()

		{

			setTimeout(function () {

			$( ".date_picker_future" ).datepicker({ dateFormat: 'yy-mm-dd', minDate: '0' }).datepicker("setDate",new Date());

			$( ".date_picker_future" ).val('<?php echo date("Y-m-d");?>');

			},1000);

		}

	$(document).ready(function () {


	//	var validate = jQuery('#myForm').validate();

		$("#myForm").validate({

		rules: {

		"package_code[]": "required"

		},

		messages: {

		"package_code[]": "Please enter package code",

		}

		});

		

		$( ".date_picker_pre" ).val('<?php echo date("Y-m-d");?>');

		$( ".date_picker_future" ).val('<?php echo date("Y-m-d");?>');

		

		var validate = jQuery('#myForm').validate();

		$( ".date_picker_pre" ).datepicker({ dateFormat: 'yy-mm-dd', maxDate: '0' }).datepicker("setDate",new Date());

		$( ".date_picker_future" ).datepicker({ dateFormat: 'yy-mm-dd', minDate: '0' }).datepicker("setDate",new Date());

		

		/*$('.date_picker_pre').each(function(){

    $(this).datepicker({ dateFormat: 'yy-mm-dd', maxDate: '0' }).datepicker("setDate",new Date());

	});*/

	

	/*$('.date_picker_future').each(function(){



		// delete row

		jQuery(document).on('click','.DeleteRow',function () 

		{

			var GetID = $(this).attr("id");

			jQuery("#ChildDIV" + GetID).remove();

			counter--;

		});

		

	});

    </script>



</body>



</html>

