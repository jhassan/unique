<?php include_once('top.php');

	$strRow = "";

	if(!empty($_GET['id']))

	{

	$GetID = mysql_real_escape_string($_GET['id']);	

	$Where = " user_id = '".(int)$GetID."'";

	$GetRow = GetRecord("tbluser", $Where);

	$UserName = $GetRow['user_name'];

	$UserEmail = $GetRow['user_email'];

	$UserLogin = $GetRow['user_login'];

	$UserStatus = $GetRow['user_status'];

	$UserPermissions = $GetRow['user_permissions'];

	$UserType = $GetRow['user_type'];
	$employee_id = $GetRow['employee_id'];
	$sales_report_status = $GetRow['sales_report_status'];
	$sales_report_url = $GetRow['sales_report_url'];
	$notes_status = $GetRow['notes_status'];
	$notes = $GetRow['notes'];
	$bank_accounts_status = $GetRow['bank_accounts_status'];
	$umrah_status = $GetRow['umrah_status'];
  $user_staff_permissions = $GetRow['staff_permissions'];
  $opening_balance = $GetRow['opening_balance'];
  $account_limit = $GetRow['account_limit'];
  $franchize_user_permissions = $GetRow['franchize_user_permissions'];
	$id_date = date("d-m-Y", strtotime($GetRow['id_date']));
  $expire_guarantee = date("d-m-Y", strtotime($GetRow['expire_guarantee']));
  $account_limit = $GetRow['account_limit'];
  $BspURL = $GetRow['bsp_url'];
  $is_sale_report = $GetRow['is_sale_report'];

  // Get air line url
  //$GetAirLine = GetRecord("tblairlines", " client_id = '".(int)$GetID."'");
  //$air_line_url = $GetAirLine['air_line_url'];
	}

?>
<body>
<div id="wrapper"> 
  <!-- Navigation -->
  
  <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <?php include_once('header.php');?>
    <?php include_once('leftsidebar.php'); ?>
  </nav>
  <div id="page-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">Add User</h1>
      </div>
      
      <!-- /.col-lg-12 --> 
      
    </div>
    
    <!-- /.row -->
    
    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading"> Users </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-lg-12">
                <form role="form" action="action.php" id="myForm" method="post">
                  <input type="hidden" name="action" id="action" value="AddUser" />
                  <input type="hidden" name="nUserID" id="nUserID" value="<?php echo $GetID; ?>" />
                  <?php

                    TextField("User Name", "user_name", $UserName, "16","6","form-control required");

										TextField("User Email", "user_email", $UserEmail, "50","6","form-control email","","onBlur='CheckExistFieldName(this.value,\"tbluser\",\"user_email\",\"User Email\");'"); ?>
                  <div class="clear m-t-10"></div>
                  <?php TextField("Login Name", "user_login", $UserLogin, "16","6","form-control required","","onBlur='CheckExistFieldName(this.value,\"tbluser\",\"user_login\",\"Login Name\");'");

										TextField("Password", "user_password", "", "20","6","form-control required","password");

										?>
                  <div class="clear"></div>
                  <div class="form-group col-lg-6 m-t-10">
                    <label>Select Employee</label>
                    <?php TableComboMsSql("tblemployee", "employee_name", "employee_id", "", "employee_id", $employee_id, "", "<option value=''>Select Employee</option>", "form-control", ""); ?>
                  </div>
                  <div class="form-group col-lg-6 m-t-10">
                    <label>Select User Type</label>
                    <?php //ArrayComboBox("user_type", "", $arrUserType, true, "", "", "form-control");?>
                    <select name="user_type" id="user_type" style="" class="form-control">
                      <option value="">Select User Type</option>
                      <option value="0" <?php if($UserType == 0) echo "selected='selected'"; ?>>Client</option>
                      <option value="1" <?php if($UserType == 1) echo "selected='selected'"; ?>>Admin</option>
                      <option value="2" <?php if($UserType == 2) echo "selected='selected'"; ?>>Staff</option>
                      <option value="3" <?php if($UserType == 3) echo "selected='selected'"; ?>>Franchize User</option>
                  </select>
                  </div>
                  <div class="clear"></div>
                  <?php

                    TextField("Opening Balance", "opening_balance", $opening_balance, "10","6","form-control");

                    TextField("Account Limit", "account_limit", $account_limit, "10","6","form-control","","");
                    TextField("ID Date", "id_date", $id_date, "10","6","form-control user_date_picker","","");
                    TextField("Expire Guarantee", "expire_guarantee", $expire_guarantee, "10","6","form-control user_date_picker","",""); 
                    TextField("BSP", "bsp_url", $BspURL, "255","6","form-control","",""); ?>
                  <div class="clear"></div>
                  <div class="form-group m-l-20 m-t-15 hide">
                    <label>Air Lines</label>
                    <label class="checkbox-inline">
                      <input id="selectall" type="checkbox">
                      check all </label>
                    <div class="clear"></div>
                    <?php

											if(empty($GetID)){

											$SQL = "SELECT * FROM tblairlines ORDER BY air_line_name";			

											 $result = MySQLQuery($SQL);

											 $air_line_id = "";

											 while($row = mysql_fetch_array($result)) { // ,MYSQL_ASSOC

											 $air_line_id .= $row['air_line_id'].',';
												 ?>
                    <div class="form-group col-lg-12 pull-left m-b-5">
                      <div class="col-lg-4 pull-left" style="height:34px;">
                        <label class="checkbox-inline">
                          <input class="selectedId" type="checkbox" value="<?php echo $row['air_line_id'];?>" id="air_line_check_<?php echo $row['air_line_id'];?>" name="user_permissions[]" onClick="return ShowURLField(<?php echo $row['air_line_id'];?>); return false;">
                          <?php echo $row['air_line_name'];?> <img src="images/air_lines/<?php echo $row['air_line_image'];?>" height="25" width="70" alt="Air Line"> </label>
                      </div>
                      <div class="col-lg-6 pull-left" id="url_field_<?php echo $row['air_line_id'];?>"></div>
                    </div>
                    <?php } // end while

											 } else { 

											// For Edit 

											$SQL = "SELECT air_line_id as AirLineID, air_line_image, air_line_name FROM tblairlines ORDER BY air_line_name";			

											 $result = MySQLQuery($SQL);

											 $air_line_id = "";

											 while($row = mysql_fetch_array($result)) { // ,MYSQL_ASSOC

											 $air_line_id .= $row['AirLineID'].',';

											$SQL1 = "SELECT 

													  tblairlines.air_line_id as AirID, air_line_image, tbluserairlines.* 

													FROM

													  tblairlines 

													  LEFT JOIN `tbluserairlines` 

														ON `tbluserairlines`.`air_line_id` = `tblairlines`.`air_line_id` 

														WHERE user_id = '".(int)$GetID."' AND `tblairlines`.`air_line_id` = '".$row['AirLineID']."'

													GROUP BY `tblairlines`.air_line_id ";	

												 $result1 = MySQLQuery($SQL1);

												$row1 = mysql_fetch_array($result1);

													 if(!empty($row1['AirID']) && !empty($row['AirLineID']))

													 	$checked = "checked=''";

													 else

													 	$checked = "";

													 $url = $row1['user_url'];

											?>
                    <div class="form-group col-lg-12 pull-left m-b-5">
                      <div class="col-lg-4 pull-left" style="height:34px;">
                        <label class="checkbox-inline">
                          <input <?php echo $checked; ?> class="selectedId" type="checkbox" value="<?php echo $row['AirLineID'];?>" id="air_line_check_<?php echo $row['AirLineID'];?>" name="user_permissions[]" onClick="return ShowURLField(<?php echo $row['AirLineID'];?>); return false;">
                          <?php echo $row['air_line_name'];?> <img src="images/air_lines/<?php echo $row['air_line_image'];?>" height="25" width="70" alt="Air Line"> </label>
                      </div>
                      <div class="col-lg-6 pull-left" id="url_field_<?php echo $row['AirLineID'];?>">
                        <?php if(!empty($url)) {?>
                        <input type="text" maxlength="100" value="<?php echo $url;?>" name="url[]" placeholder="URL" class="form-control">
                        <?php } ?>
                      </div>
                    </div>
                    <?php }  } // inner while ?>
                    <input type="hidden" id="all_airline_id" value="<?php echo rtrim($air_line_id,','); ?>" />
                  </div>
                  <div class="clear"></div>
                  
                  <?php if(empty($GetID)){ ?>
                  <div class="form-group m-l-20 m-t-15">
                    <label>Enable/Disable</label>
                    <label class="radio-inline">
                      <input type="radio" checked="" value="1" id="optionsRadiosInline1" name="user_status">
                      Enable </label>
                    <label class="radio-inline">
                      <input type="radio" value="0" id="optionsRadiosInline2" name="user_status">
                      Disable </label>
                  </div>
                  <?php } else { 

											if($UserStatus == '1')

												$CheckedEnable = "checked=''";

											else

												$CheckedEnable = "";

												

											if($UserStatus == '0')

												$CheckedDisable = "checked=''";

											else

												$CheckedDisable = "";

										?>
                  <div class="form-group m-l-20 m-t-15">
                    <label>Enable/Disable</label>
                    <label class="radio-inline">
                      <input type="radio" <?php echo $CheckedEnable;?> value="1" id="optionsRadiosInline1" name="user_status">
                      Enable </label>
                    <label class="radio-inline">
                      <input type="radio" <?php echo $CheckedDisable;?> value="0" id="optionsRadiosInline2" name="user_status">
                      Disable </label>
                  </div>
                  <?php } ?>
                  <div class="clear"></div>
                  <?php if(empty($GetID)){ 
										
										TextField("Sales Report URL", "sales_report_url", $sales_report_url, "","6","form-control required");
										?>
                    <div class="clear"></div>
                  <div class="form-group col-lg-6" style="margin-top:30px;">
                    <label>Sales Report Enable/Disable</label>
                    <label class="radio-inline">
                      <input type="radio" checked="" value="1" id="optionsRadiosInline11" name="sales_report">
                      Enable </label>
                    <label class="radio-inline">
                      <input type="radio" value="0" id="optionsRadiosInline21" name="sales_report">
                      Disable </label>
                  </div>
                  <?php } else { 
										
										TextField("Sales Report URL", "sales_report_url", $sales_report_url, "","6","form-control required");

											if($sales_report_status == '1')

												$CheckedEnableSales = "checked=''";

											else

												$CheckedEnableSales = "";

												

											if($sales_report_status == '0')

												$CheckedDisableSales = "checked=''";

											else

												$CheckedDisableSales = "";

										?>
                  <div class="form-group col-lg-6" style="margin-top:30px;">
                    <label>Sales Report Enable/Disable</label>
                    <label class="radio-inline">
                      <input type="radio" <?php echo $CheckedEnableSales;?> value="1" id="optionsRadiosInline11" name="sales_report">
                      Enable </label>
                    <label class="radio-inline">
                      <input type="radio" <?php echo $CheckedDisableSales;?> value="0" id="optionsRadiosInline21" name="sales_report">
                      Disable </label>
                  </div>
                  <?php } ?>
                  <div class="clear"></div>
                  <?php
                  //TextField("Air Line URL", "air_line_url", $air_line_url, "","6","form-control required");
                  ?>
                  <div class="clear"></div>
                  <?php if(empty($GetID)){ 
										echo "<label>Notes</label>";
										echo "<textarea cols='' rows='7' name='notes' class='form-control col-lg-6'></textarea>";
										//TextField("Notes", "notes", $notes, "","6","form-control");
										?>
                  <div class="form-group col-lg-6" style="margin-top:30px;">
                    <label>Notes Enable/Disable</label>
                    <label class="radio-inline">
                      <input type="radio" checked="" value="1" name="notes_status">
                      Enable </label>
                    <label class="radio-inline">
                      <input type="radio" value="0" name="notes_status">
                      Disable </label>
                  </div>
                  <?php } else { 
										echo "<label>Notes</label>";
										echo "<textarea cols='' rows='7' name='notes' class='form-control col-lg-6'>$notes</textarea>";
										
										//TextField("Notes", "notes", $notes, "","6","form-control");

											if($notes_status == '1')

												$CheckedEnableNotes = "checked=''";

											else

												$CheckedEnableNotes = "";

												

											if($notes_status == '0')

												$CheckedDisableNotes = "checked=''";

											else

												$CheckedDisableNotes = "";

										?>
                  <div class="form-group col-lg-6">
                    <label>Notes Enable/Disable</label>
                    <label class="radio-inline">
                      <input type="radio" <?php echo $CheckedEnableNotes;?> value="1" name="notes_status">
                      Enable </label>
                    <label class="radio-inline">
                      <input type="radio" <?php echo $CheckedDisableNotes;?> value="0"  name="notes_status">
                      Disable </label>
                  </div>
                  <?php } ?>
                  <div class="clear"></div>
                  <?php if(empty($GetID)){ 
										?>
                  <div class="form-group col-lg-6">
                    <label>Bank Accounts Text Enable/Disable</label>
                    <label class="radio-inline">
                      <input type="radio" checked="" value="1" name="bank_accounts_status">
                      Enable </label>
                    <label class="radio-inline">
                      <input type="radio" value="0" name="bank_accounts_status">
                      Disable </label>
                  </div>
                  <?php } else { 
											if($bank_accounts_status == '1')

												$CheckedEnableBank = "checked=''";

											else

												$CheckedEnableBank = "";

												

											if($bank_accounts_status == '0')

												$CheckedDisableBank = "checked=''";

											else

												$CheckedDisableBank = "";

										?>
                  <div class="form-group col-lg-6">
                    <label>Bank Accounts Text Enable/Disable</label>
                    <label class="radio-inline">
                      <input type="radio" <?php echo $CheckedEnableBank;?> value="1" name="bank_accounts_status">
                      Enable </label>
                    <label class="radio-inline">
                      <input type="radio" <?php echo $CheckedDisableBank;?> value="0"  name="bank_accounts_status">
                      Disable </label>
                  </div>
                  <?php } ?>
                  
                  <div class="clear"></div>
                  <?php if(empty($GetID)){ 
										?>
                  <div class="form-group col-lg-6">
                    <label>Umrah Feeding Enable/Disable</label>
                    <label class="radio-inline">
                      <input type="radio" checked="" value="1" name="umrah_status">
                      Enable </label>
                    <label class="radio-inline">
                      <input type="radio" value="0" name="umrah_status">
                      Disable </label>
                  </div>
                  <?php } else { 
											if($umrah_status == '1')

												$CheckedEnableUmrah = "checked=''";

											else

												$CheckedEnableUmrah = "";

												

											if($umrah_status == '0')

												$CheckedDisableUmrah = "checked=''";

											else

												$CheckedDisableUmrah = "";

										?>
                  <div class="form-group col-lg-6">
                    <label>Umrah Feeding Enable/Disable</label>
                    <label class="radio-inline">
                      <input type="radio" <?php echo $CheckedEnableUmrah;?> value="1" name="umrah_status">
                      Enable </label>
                    <label class="radio-inline">
                      <input type="radio" <?php echo $CheckedDisableUmrah;?> value="0"  name="umrah_status">
                      Disable </label>
                  </div>
                  <?php } ?>
                  <div class="clear"></div>
                  <?php //if(empty($staff_permissions)) { ?>
                  <div id="permission_block" class="">
                  <div class="form-group col-sm-3 pull-left" style=" margin-top: 20px;">
                      <input type="checkbox" id="checkAll"/> <label style="font-size: 14px;">Check All</label>
                    </div>
                  <div class="clear"></div>
                  <?php
                  
                  $SQL = "SELECT * FROM tblpermissions WHERE parent_id = 0";      
                       $result = MySQLQuery($SQL);
                       while($row = mysql_fetch_array($result)) { // ,MYSQL_ASSOC
                  ?>  
                    <div class="form-group col-lg-12">
                      <label style="font-size: 14px;"><?php echo $row['name']; ?></label>
                      <div class="clear"></div>
                      <?php
                      $sql_inner = "SELECT * FROM tblpermissions";      
                           $result_inner = MySQLQuery($sql_inner);
                           while($row_inner = mysql_fetch_array($result_inner)) { // ,MYSQL_ASSOC
                            if($row_inner['parent_id'] == $row['id']) {
                      ?>
                      <?php 
                      if(!empty($user_staff_permissions) && !empty($UserType))
                      {
                        $array_permission = explode(',',$user_staff_permissions);
                        if (in_array($row_inner['id'], $array_permission))
                          $checked = "checked='checked'";
                        else
                          $checked = "";
                      }
                      else
                          $checked = "";
                        
                      ?>
                        <div class="col-lg-3" style="padding-left: 0px;">
                          <p style="padding-left: 0px;" class="text-left col-sm-9"><?php echo $row_inner['name']; ?></p>
                          <input class="checkedAll" <?php echo $checked; ?> name="staff_permissions[<?php echo $row_inner['id']; ?>]" type="checkbox" value="<?php echo $row_inner['id']; ?>" id="<?php echo $row_inner['id']; ?>">
                        </div>
                        <?php } } // end inner while and if ?>
                    </div>
                    <div class="clear"></div>
                    <?php } ?>
                  </div>
                  <?php //} ?>
                  <div class="clear"></div>
                  <div class="form-group col-lg-12">
                      <label style="font-size: 14px;">Select Clients<input id="checkedAllFranchizer" type="checkbox" value="f" class="m-l-15"></label>
                      <div class="clear"></div>
                      <?php
                      $SQL = "SELECT user_id, user_name FROM tbluser WHERE user_type = '0' ORDER BY user_name";     
                        $result = MySQLQuery($SQL);
                        $str = "";
                        while($row = mysql_fetch_array($result)) {
                      ?>
                      <?php 
                      if(!empty($franchize_user_permissions) && !empty($UserType))
                      {
                        $array_permission = explode(',',$franchize_user_permissions);
                        if (in_array($row['user_id'], $array_permission))
                          $checked = "checked='checked'";
                        else
                          $checked = "";
                      }
                      else
                          $checked = "";
                        
                      ?>
                        <div class="col-lg-3" style="padding-left: 0px;">
                          <p style="padding-left: 0px;" class="text-left col-sm-9"><?php echo $row['user_name']; ?></p>
                          <input class="checkedAll2" <?php echo $checked; ?> name="franchize_users[<?php echo $row['user_id']; ?>]" type="checkbox" value="<?php echo $row['user_id']; ?>" id="<?php echo $row['user_id']; ?>">
                        </div>
                        <?php } //} // end inner while and if ?>
                    </div>
                   <div class="clear"></div>                         
                  <div class="form-group col-lg-6">
                    <button type="submit" class="btn btn-default m-t-10">Save</button>
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
  $(document).ready(function() {

    // get All Franchize User
    $("#checkedAllFranchizer").click(function(){
      var action = "getAllFranchizeUsers";
      if($("#checkedAllFranchizer").is(':checked'))
      {
          jQuery.ajax({
            type: "POST",
            url: "action.php",
            data: {action: action},
            cache: false,
            success: function(response)
            {
              $("#showFranchizeUsers").html(response);
              //console.log(response); return false;
            }
        });
      }
      else
      {
          $("#showFranchizeUsers").html('');
      }
    });


    // onload hide permission div
    if($("#user_type").val() == 0)
      $("#permission_block").addClass('hide');
    // Hide permission div
    $("#user_type").change(function (){
      var value = $(this).val();
      if(value == 1 || value == 2 || value == 3)
        $("#permission_block").removeClass('hide');
      else
        $("#permission_block").addClass('hide');
    });

    $("#checkAll").change(function () {
        $("input:checkbox.checkedAll").prop('checked', $(this).prop("checked"));
    });
    $(".cb-element").change(function () {
        _tot = $(".cb-element").length              
        _tot_checked = $(".checkedAll:checked").length;
        
        if(_tot != _tot_checked){
          $("#checkAll").prop('checked',false);
        }
    });
    // checkedAllFranchizer
     $("#checkedAllFranchizer").change(function () {
        $("input:checkbox.checkedAll2").prop('checked', $(this).prop("checked"));
    });
    $(".cb-element").change(function () {
        _tot = $(".cb-element").length              
        _tot_checked = $(".checkedAll2:checked").length;
        
        if(_tot != _tot_checked){
          $("#checkedAllFranchizer").prop('checked',false);
        }
    });
  });
  </script>
<script type="text/javascript">

	jQuery(function (){

		jQuery('#myForm').validate();

		

		

    $('#selectall').click(function(event) {  //on click 

		var all_airline_id = $("#all_airline_id").val();

		//alert(all_airline_id);

        if(this.checked) { // check select status

            $('.selectedId').each(function() { //loop through each checkbox

                this.checked = true;  //select all checkboxes with class "checkbox1"               

            });

			

			var employeeArray = new Array();

			employeeArray = all_airline_id.split(",");

		

			for(var x=0;x<employeeArray.length;x++){

				//alert('Employee Name:- ' + employeeArray[x]);

				ShowURLField(employeeArray[x]);

			}

			

			

			//var mySplitResult;

			// Use the string.split function to split the string

			/*all_airline_id = all_airline_id.split(',');

			alert(all_airline_id);

			for(i = 0; i < all_airline_id.length; i++)

			  {

				//document.write("<br /> Element " + i + " = " + all_airline_id[i]);

				ShowURLField(all_airline_id[i]);

			  }*/

			

			

			

        }else{

            $('.selectedId').each(function() { //loop through each checkbox

                this.checked = false; //deselect all checkboxes with class "checkbox1"                       

            });  

			

			var employeeArray = new Array();

			employeeArray = all_airline_id.split(",");

		

			for(var x=0;x<employeeArray.length;x++){

				//alert('Employee Name:- ' + employeeArray[x]);

				//ShowURLField(employeeArray[x]);

				$("#url_field_"+employeeArray[x]).html(''); 

			}

			      

        }

    });
		// Checked all air lines

		/*$("#selectall").click(function () {

			 //$('input:checkbox').not(this).prop('checked', this.checked);

			 check = $("#selectall").prop("checked");

			if(check) {

				 //alert("Checkbox is checked.");

				 $('input:checkbox').not(this).prop('checked', this.checked);

			} else {

				//alert("Checkbox is unchecked.");

				//$('input:checkbox').not(this).prop('checked', this.checked);

			}

		 });*/

		// Remove required class in edit mode password

		var nUserID = $("#nUserID").val();

		if(nUserID != "")

			$("#user_password").removeClass('required'); 

		 

	});

	

	// Show URL Field

	function ShowURLField(id)

	{

		var str = "<input type='text' maxlength='100' value='' name='url[]' placeholder='URL' class='form-control'>";

		check = $("#air_line_check_"+id).prop("checked");

		if(check) {

			 $("#url_field_"+id).html('');

			 $("#url_field_"+id).html(str);

		} else {

			$("#url_field_"+id).html('');

		}

	}
    </script>
</body>
</html>