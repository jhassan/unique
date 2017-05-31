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

                            Passport Feeding

                        </div>

                        <div class="panel-body">

                            <div class="row">

                                <div class="col-lg-12">

                                    <form role="form" action="action.php" id="myForm" method="post" enctype="multipart/form-data">

                                    <input type="hidden" name="action" id="action" value="Umrah" />

                                        <?php TextField("Package Code", "package_code[]", "", "30","3","form-control"); ?>

                                        <div class="form-group col-lg-3 m-b-0">

                                        <label>Select Relation</label>

																																								<?php ArrayComboBox("Relation[]", "", $arrRelation, true, "", "", "form-control", "");?>

                                                                      </div>

                                        <?php

                                        TextField("Sur Name", "sur_name[]", "", "30","3","form-control");

                                        TextField("Given Name", "given_name[]", "", "30","3","form-control");

																																								?>

																																								<div class="clear m-t-10"></div>

																																								<?php TextField("Father/Husband Name", "father_husband_name[]", "", "30","3","form-control");?>

																																								
																																								<div class="form-group col-lg-3 m-b-0">

																																								<label>Select Sex</label>

                                        <?php ArrayComboBox("Sex[]", "", $arrSex, true, "", "", "form-control", "");?>

                                                                      </div>

                                        <?php TextField("Date of Birth", "dob[]", "", "10","3","form-control date_picker_pre"); 

                                           TextField("Place of Birth", "place_of_birth[]", "", "10","3","form-control");

                                        ?>

                                          <div class="clear m-t-10"></div>

                                        <?php 

                                           TextField("Passport No", "passport_no[]", "", "20","3","form-control");

                                           TextField("Passport Issue Date", "passport_issue_date[]", "", "10","3","form-control date_picker_pre");

                                              TextField("Passport Expire Date", "passport_expire_date[]", "", "10","3","form-control date_picker_future");

                                           TextField("CNIC No", "cnic[]", "", "10","3","form-control"); ?>

                                                                       <div class="clear m-t-10"></div>

                                         <?php     

                                           TextField("CNIC Issue Date", "cnic_issue_date[]", "", "10","3","form-control date_picker_pre");

                                           TextField("CNIC Expiry Date", "cnic_expiry_date[]", "", "10","3","form-control date_picker_future");											

                                           TextField("Address CNIC", "Address_CNIC[]", "", "20","3","form-control");				

                                        ?>

                                        <div class="clear m-t-10"></div>
                                        <div class="form-group col-lg-3 m-b-0">

																																								<label>Visa Type</label>

                                        <?php ArrayComboBox("Visa_type[]", "", $arrVisaType, true, "", "", "form-control", "");?>

                                                                      </div>
                                                                      <?php TextField("No. of Days", "No_of_Days[]", "", "20","3","form-control number_only"); ?>
                                            <div class="clear m-t-10"></div> 
                                            <div class="form-group m-r-15 m-t-10 col-lg-6">

                                            <label>Upload Passport (Only JPG, JPEG, PNG & GIF files are allowed.)</label>

                                            <input type="file" name="fileToUpload[]" class="required">

                                        </div>    
                                        <div class="clear m-t-10"></div>                      	
                                        	<img src="images/plus.png" name="add_row" id="AddNewRow" class="" width="30" style="cursor: pointer; float:right;" />

                                            <input type="hidden" id="RowCount" value="<?=$i-1;?>" />

                                        <div class="form-groupp-l-0 m-t-10" id="DivShowNewFields"></div>

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

    $(this).datepicker({ dateFormat: 'yy-mm-dd', minDate: '0' }).datepicker("setDate",new Date());

	});*/

		

		var counter = 0;

        jQuery(document).on('click',"#AddNewRow",function (){

						

				var RowCount = jQuery("#RowCount").val();

				/*if(RowCount == "")

					counter = 1;

				else

					counter = RowCount;*/

					

				var newContent = '';

					newContent += "<div id='ChildDIV" + counter + "' class='form-group col-lg-12 p-l-0 m-b-0 m-t-10' style='margin-top:30px !important;'>";

					newContent += "<div class='form-group m-b-0 col-lg-3'><label>Package Code</label><input type='text' maxlength='30' value='' name='package_code[]' placeholder='Package Code' class='form-control'></div><div class='form-group col-lg-3 m-b-0'><label>Select Relation</label><select class='form-control' style='' name='Relation[]'>  <option value='1'>Mother </option>  <option value='2'>Father </option>  <option value='3'>Husband </option>  <option value='4'>Wife </option>  <option value='5'>Son </option>  <option value='6'>Daughter </option>  <option value='7'>Sister </option>  <option value='8'>Brother </option></select></div><div class='form-group m-b-0 col-lg-3'><label>Sur Name</label><input type='text' maxlength='30' value='' name='sur_name[]' placeholder='Sur Name' class='form-control'></div><div class='form-group m-b-0 col-lg-3'><label>Given Name</label><input type='text' maxlength='30' value='' name='given_name[]' placeholder='Given Name' class='form-control'></div><div class='clear m-t-10'></div><div class='form-group m-b-0 col-lg-3'><label>Father/Husband Name</label><input type='text'  maxlength='30' value='' name='father_husband_name[]' placeholder='Father/Husband Name' class='form-control'></div><div class='form-group col-lg-3 m-b-0'><label>Select Sex</label><select class='form-control' style='' name='Sex[]'>  <option value='1'>Male </option>  <option value='2'>FeMale </option></select></div><div class='form-group m-b-0 col-lg-3'><label>Date of Birth</label><input type='text'  maxlength='10' value='' name='dob[]' placeholder='Date of Birth' class='form-control date_picker_pre' onclick='DatePickerPre();'></div><div class='form-group m-b-0 col-lg-3'><label>Place of Birth</label><input type='text'  maxlength='10' value='' name='place_of_birth[]' placeholder='Place of Birth' class='form-control'></div><div class='clear m-t-10'></div><div class='form-group m-b-0 col-lg-3'><label>Passport No</label><input type='text'  maxlength='20' value='' name='passport_no[]' placeholder='Passport No' class='form-control'></div><div class='form-group m-b-0 col-lg-3'><label>Passport Issue Date</label><input type='text'  maxlength='10' value='' name='passport_issue_date[]' placeholder='Passport Issue Date' class='form-control date_picker_pre'  onclick='DatePickerPre();'></div><div class='form-group m-b-0 col-lg-3'><label>Passport Expire Date</label><input type='text'  maxlength='10' value='' name='passport_expire_date[]' placeholder='Passport Expire Date' class='form-control date_picker_future' onclick='DatePickerFuture();'></div><div class='form-group m-b-0 col-lg-3'><label>CNIC No</label><input type='text'  maxlength='10' value='' name='cnic[]' placeholder='CNIC No' class='form-control'></div><div class='clear m-t-10'></div><div class='form-group m-b-0 col-lg-3'><label>CNIC Issue Date</label><input type='text'  maxlength='10' value='' name='cnic_issue_date[]' placeholder='CNIC Issue Date' class='form-control date_picker_pre' onclick='DatePickerPre();'></div><div class='form-group m-b-0 col-lg-3'><label>CNIC Expiry Date</label><input type='text'  maxlength='10' value='' name='cnic_expiry_date[]' placeholder='CNIC Expiry Date' class='form-control date_picker_future' onclick='DatePickerFuture();'></div><div class='form-group m-b-0 col-lg-3'><label>Address CNIC</label><input type='text'  maxlength='20' value='' name='Address_CNIC[]' placeholder='Address CNIC' class='form-control'></div><div class='clear m-t-10'></div><div class='form-group col-lg-3 m-b-0'><label>Visa Type</label><select name='Visa_type[]' id='Visa_type[]' style='' class='form-control valid'><option value='1'>Umrah</option><option value='2'>Dubai Visa</option></select></div><div class='form-group m-b-0 col-lg-3'><label>No. of Days</label><input class='form-control number_only' placeholder='No. of Days' name='No_of_Days[]' id='No_of_Days[]' value='' maxlength='20' type='text'></div><div class='form-group m-r-15 m-t-10 col-lg-6'><label>Upload Passport</label><input type='file' name='fileToUpload[]' class='required'></div>";

					newContent += "<div class='form-group col-lg-3 m-t-5 m-b-0 p-l-5'><label>&nbsp;</label><div class='clear'></div><img width='25' style='cursor: pointer; float:right;' id='" + counter  + "' class='DeleteRow' name='add_row' src='images/minus.png'></div>";

					newContent += "</div>";

					$("#DivShowNewFields").append(newContent);

					counter++;

			});

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

