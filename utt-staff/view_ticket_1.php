<?php include_once('top.php');?>
<?php
if(!empty($_SESSION["staff_permissions"]))
{
  $staff_permissions = $_SESSION["staff_permissions"];
  $staff_permissions = explode(',',$staff_permissions);
} 
else
{
    $staff_permissions = "";   
}
 //var_dump($staff_permissions);
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
                    <h1 class="page-header">View Ticket</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12 alert alert-success hide" id="message_status"></div>
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            View Tickets
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-responsive table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Invoice#</th>
                                            <th>Today Invoice#</th>
                                            <th>Date</th>
                                            <th>Pax Name</th>
                                            <th>Air Line Code</th>
                                            <th>PNR</th>
                                            <th>Air line</th>
                                            <th>Desitnation Code</th>
                                            <th>Created By</th>
                                            <th>Under Franchise</th>
                                            <th>Updated By</th>
                                            <th>Ticket Status</th>
                                            <th>View Vendor</th>
                                            <th>Mode</th>
                                            <th>Action</th>
                                            <th>Amount</th>
                                            <th>Avail. Bal.</th>
                                            <th>URL Acc. ST</th>
                                            <th>Credit Limit</th>
                                            <?php
                                            if(!empty($staff_permissions) && in_array('62', $staff_permissions))
                                            {
                                            ?>
                                            <th>Commission</th>
                                            <?php } ?>
                                            <?php
                                            if(!empty($staff_permissions) && in_array('60', $staff_permissions))
                                            {
                                            ?>
                                            <th>ASI #</th>
                                            <th>Super.</th>
                                            <?php } ?>
                                            <th>Print</th>    
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    	$SQL = "SELECT * FROM tblissuerefund ORDER BY id DESC";			
										 $result = MySQLQuery($SQL);
										 while($row = mysql_fetch_array($result)) { // ,MYSQL_ASSOC
                                            $disabled_sur = "";
                                            $disabled_checked = "";
                                            $disabled_class = "";
                                            $disabled = "";
                                            $prossess_selected = "";
                                            $in_prossess_selected = "";
                                            $ticketed_selected = "";
                                            $void_selected = "";
                                            $refund_selected = "";
                                            $pnr_expired = "";
                                            $reissued = "";
                                            $rejected = "";
                                            $linkdown = "";
                                            $ticket_status = $row['ticket_status'];
                                            $update_status = $row['update_status'];
                                            $is_supervised = $row['is_supervised'];
                                            $user_commisions = number_format($row['user_commisions'],0);
                                            $edit_rows_status = $row['edit_rows_status'];
                                            if($edit_rows_status == 1 && $_SESSION["user_type"] == 2)
                                                $disabled_edit = "disabled='disabled'";
                                            else
                                                $disabled_edit = "";
                                            if($update_status == 1 && $_SESSION["user_type"] == 2)
                                                $disabled = "disabled='disabled'";
                                            else
                                                $disabled = "";
                                            if($is_supervised == 1 && $_SESSION["user_type"] == 2)
                                            {
                                                $disabled_sur = "disabled='disabled'";
                                                $disabled_checked = "checked='checked'";
                                                $disabled_class = "disabled";
                                                $asi_input_disabled = "disabled";
                                            }
                                            elseif($is_supervised == 1 && $_SESSION["user_type"] == 1)
                                            {
                                                $disabled_checked = "checked='checked'";
                                            }
                                            else
                                                $asi_input_disabled = "";
                                            
                                            if($ticket_status == 1)
                                                $prossess_selected = "selected='selected'";
                                            else if($ticket_status == 2)
                                                $ticketed_selected = "selected='selected'";
                                            else if($ticket_status == 3)
                                                $void_selected = "selected='selected'";
                                            else if($ticket_status == 4)
                                                $refund_selected = "selected='selected'";
                                            else if($ticket_status == 5)
                                                $pnr_expired = "selected='selected'";
                                            else if($ticket_status == 6)
                                                $reissued = "selected='selected'";
                                            else if($ticket_status == 7)
                                                $rejected = "selected='selected'";
                                            else if($ticket_status == 8)
                                                $linkdown = "selected='selected'";
                                            else if($ticket_status == 9)
                                                $in_prossess_selected = "selected='selected'";
                                            $is_active = $row['is_active'];
                                            if($is_active == 1)
                                                $color = "green";
                                            else
                                                $color = "red";
                                            $date = date("Y-m-d", strtotime($row['date']));
                                            $main_id = $row['id'];

                                            // update vendor status
                                            $vendor_disabled = "";
                                            if($row['vendor_status'] == 1 && $_SESSION["user_type"] == 2)
                                                $vendor_disabled = "disabled='disabled'";
                                            else
                                                $vendor_disabled = "";
									?>
                                        <tr class="odd gradeX" id="DelID_<?php echo $row['id'];?>">
                                            <td class="center"><?php echo $row['id'];?></td>
                                            <td class="center"><?php echo $row['today_invoice_id'];?></td>
                                            <td class="left"><?php echo date("dMy h:m", strtotime($row['date']));?></td>
                                            <td class="left" id="color_pax_name_<?php echo $row['id'];?>" style="color:<?php echo $color; ?>"><?php echo $row['pax_name'];?></td>
                                            <td class="left"><?php echo $row['sector'];?></td>
                                            <td class="left" id="PNR_<?php echo $row['id'];?>"><?php echo $row['pnr'];?></td>
                                            <td class="left"><?php echo AirLinesName($row['air_line_id']);?></td>
                                            <td class="left"><?php echo $row['air_line_code'];?></td>
                                            <td class="left"><?php echo UserName($row['user_id']);?></td>
                                            <td class="left"><?php echo GetEmployeeName($row['user_id']);?></td>
                                            <td class="left"><?php echo UserName($row['update_user_id']);?></td>
                                            <td class="left" style="padding-top: 0;padding-bottom: 0;">
                                                <select name="ticket_status" id="ticket_dropdown_<?php echo $row['id'];?>" <?php echo $disabled; ?> class="get_payment_status form-control valid" onchange="ChangePaymentStatus(<?php echo $row['id'];?>, this.value, <?php echo $row['user_id'];?>)">
                                                  <option value="1" <?php echo $prossess_selected; ?>>Prossess</option>
                                                  <option value="9" <?php echo $in_prossess_selected; ?>>In Prossess</option>
                                                  <option value="2" <?php echo $ticketed_selected; ?>>Ticketed</option>
                                                  <option value="3" <?php echo $void_selected; ?>>Void</option>
                                                  <option value="4" <?php echo $refund_selected; ?>>Refund</option>
                                                  <option value="5" <?php echo $pnr_expired; ?>>PNR Expired</option>
                                                  <option value="6" <?php echo $reissued; ?>>Reissued</option>
                                                  <option value="7" <?php echo $rejected; ?>>Rejected</option>
                                                  <option value="8" <?php echo $linkdown; ?>>Link Down</option>
                                              </select>
                                            </td>
                                            <td class="left" style="padding-top: 0;padding-bottom: 0;">
                                                <select name="vendor_id" id="view_vendor_<?php echo $row['id'];?>" <?php echo $vendor_disabled; ?> class="form-control valid" onchange="UpdateVendor(<?php echo $row['id'];?>, this.value)">
                                                  <option value="">Select Vendor</option>
                                                  <?php
                                                  $SQLV = "SELECT * FROM tblvendor ORDER BY vendor_name";            
                                                 $resultv = MySQLQuery($SQLV);
                                                 while($rowv = mysql_fetch_array($resultv)) { // ,MYSQL_ASSOC
                                                    if($rowv['vendor_id'] == $row['vendor_id'])
                                                        $vendor_selected = "selected='selected'";
                                                    else
                                                        $vendor_selected = "";
                                                  ?>
                                                  <option value="<?php echo $rowv['vendor_id'];?>" <?php echo $vendor_selected; ?> <?php echo $vendor_disabled; ?>><?php echo $rowv['vendor_name'];?></option>
                                                  <?php } ?>
                                              </select>
                                            </td>
                                            <td class="left"><?php echo $arrIssue[$row['mode_type'] - 1];?></td>
                                            <td class="left">
                                                <?php if($_SESSION["user_type"] == 1) { ?>
                                                <a class="<?php echo $disabled_class; ?>" id="EditDisable_<?php echo $row['id'];?>" <?php echo $disabled_edit; ?> href="edit_ticket.php?id=<?php echo $row['id'];?>"><img height="16" width="16" src="../images/edit.png" alt="Edit"></a>
                                                <?php } if(($_SESSION["user_type"] == 1) || ($is_supervised == 0 && $_SESSION["user_type"] == 2)) { ?>
                                                &nbsp;&nbsp;&nbsp;<a class='cursor' id><img id="<?php echo $row['id'];?>" data-toggle="modal" data-target=".bs-example-modal-lg14" class="edit_action" src="../images/action-edit.png" height="16" width="16" alt="Edit Action"></a>
                                                <?php } if($_SESSION["user_type"] == 1) { ?>
                                                &nbsp;&nbsp;&nbsp;<a class='cursor clsDelete' id="<?php echo $row['id'];?>"><img data-target="#myModal" data-toggle="modal" src="../images/delete.png" height="16" width="16" alt="Delete"></a>
                                                <?php } ?>
                                            </td>
                                            <td class="text-right"><?php echo number_format($row['amount'],2);?></td>
                                            <td class="left"><?php echo ClientAvailBalance($row['user_id']);?></td>
                                            <td class="left"><a target="_blank" href="http://toursview.com/unique/account_statement.php?admin_user_id=<?php echo $row['user_id']; ?>">URL</a></td>
                                            <td class="left"><?php echo ClientCreditLimit($row['user_id']);?></td>
                                            <?php
                                            if(!empty($staff_permissions) && in_array('62', $staff_permissions))
                                            {
                                            ?>
                                            <td class="left"><?php echo number_format($row['user_commisions'],2);?></td>
                                            <?php } ?>
                                            <td class="left"><input <?php echo $asi_input_disabled; ?> type="text" id="get_asi_<?php echo $row['id'];?>" class="form-control get_asi" style="width: 100px;" value="<?php echo $row['asi_no'];?>"></td>
                                            <?php
                                            if(!empty($staff_permissions) && in_array('60', $staff_permissions))
                                            {
                                            ?>
                                            <td class="left"><input class="<?php echo $disabled_class; ?>" style="margin-left: 15px;" <?php echo $disabled_sur; ?> <?php echo $disabled_checked; ?> type="checkbox" name="supervised" id="supervised_<?php echo $row['id'];?>" value="" onclick="GetSupervised(<?php echo $row['id'];?>);"></td>
                                            <?php } ?>
                                            <td class="left"><a target="_blank" href="ticket_print.php?id=<?php echo $row['id'];?>"><button type="button" class="btn btn-block btn-primary">Print</button></a></td>
                                        </tr>
									<?php } ?>	
                                        
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                            
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
            <!-- /.row -->
            
            <!-- /.row -->
            
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
	<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                
                <div class="modal-body">Do you want to delete this record?</div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" id="DeleteRecord">Delete</button>
                    <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <div class="modal fade bs-example-modal-lg4" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title p-l-10" style="padding-left: 17px;" id="myModalLabel">Add Comments</h4>
      </div>
      <div class="modal-body" align="center" style="padding: 0px;">
        <form role="form" onsubmit="return false;" action="action.php" method="post">
        <input type="hidden" name="action" id="action" value="UploadVisaDocs" />
        <input type="hidden" name="comment_id" id="comment_id" value="" />
        <div class="form-group m-r-15 m-t-10 col-lg-6">
            <textarea cols="70" rows="10" name="text_comments" id="text_comments"></textarea>
        </div>
        <div class="form-group col-lg-6">
        <button type="submit" id="CreateComment" class="btn btn-default m-t-10 pull-left" style="margin-left: 12px;">Save</button>
        </div>
        </form>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
  <script src="../bower_components/jquery/dist/jquery.min.js"></script>
  <script>
    $(document).ready(function() {
        // docsUpload
        $("#CreateComment").click(function (){
            var form_data = new FormData();                  
            form_data.append('text_comments', $("#text_comments").val());
            form_data.append('comment_id', $("#comment_id").val());
            $.ajax({
                        url: 'action.php?action=AddTicketComments', // point to server-side PHP script 
                        dataType: 'text',  // what to expect back from the PHP script, if anything
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: form_data,                         
                        type: 'post',
                        success: function(response){
                            //console.log(response); return false;
                            $("#text_comments").html('');
                            $("#text_comments").html(response);
                            //console.log(response); return false;
                            window.location.href = 'view_ticket';
                        }
             });
        });
        });
    </script>
</div>
<div class="modal fade bs-example-modal-lg14" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title p-l-10" id="myModalLabel">Update Commisions</h4>
      </div>
      <div class="modal-body" align="center" style="padding: 0px;">
        <form role="form" onsubmit="return false;" id="add_commissions_form" action="" method="post">
        <input type="hidden" name="action" id="action" value="" />
        <input type="hidden" name="edit_action_id" id="edit_action_id" value="" />
        <div class="form-group m-b-0 col-lg-4 m-t-10">
            <label style="float: left;">Basic Fare</label>
            <input class="form-control required" placeholder="Basic Fare" name="basic_fare" id="basic_fare" value="0" maxlength="10" type="text">
        </div>
        <div class="form-group m-b-0 col-lg-4 m-t-10">
            <label style="float: left;">Clint % or PSF</label>
            <input class="form-control" placeholder="%" name="clint_psf_percent" id="client_percent_rec_comm" value="" maxlength="3" type="text" style="width: 70px; float: left; clear: both; margin-right: 0;">
            <input class="form-control" placeholder="" name="clint_psf_percent_value" id="client_rec_comm_total" value="" maxlength="3" type="text" style="width: 70px; margin-left: 11px; float: left;">
        </div>
        <div class="form-group m-b-0 col-lg-4 m-t-10">
            <label style="float: left;">Franchise Comm.</label>
            <input class="form-control" placeholder="%" name="clint_psf_percent" id="ven_percent_rec_comm" value="" maxlength="3" type="text" style="width: 70px; float: left; clear: both; margin-right: 0;">
            <input class="form-control" placeholder="" name="clint_psf_percent_value" id="vendor_rec_comm_total" value="" maxlength="3" type="text" style="width: 70px; margin-left: 11px; float: left;">
        </div>
        <div class="clear"></div>
        <div class="form-group m-b-0 col-lg-4 m-t-10">
            <label style="float: left;">Tax</label>
            <input class="form-control number_only" placeholder="Tax" name="tax" id="tax" value="0" maxlength="20" type="text">
        </div>
        <div class="form-group col-lg-4 m-b-10" style="margin-top: 35px;">
            <input class="form-control" placeholder="Total" name="total_amount" disabled="disabled" id="total_amount" value="0" maxlength="10" type="text">
            <input type="hidden" name="hdn_total_amount" id="hdn_total_amount" value="0">
        </div>
        <div class="form-group col-lg-4 m-b-10 m-t-10">
            <label style="float: left;">Commissions</label>
            <input class="form-control required" placeholder="Total" name="commissions" disabled="disabled" id="commissions" value="0" maxlength="10" type="text">
            <input type="hidden" name="hdn_commissions" id="hdn_commissions" value="0">
        </div>
        <div class="clear"></div>
        <div class="form-group col-lg-4 m-b-10 m-t-10">
            <label style="float: left;">Total</label>
            <input class="form-control required" placeholder="Total" name="actual_fare_total" disabled="disabled" id="actual_fare_total" value="0" maxlength="10" type="text">
            <input type="hidden" id="hdn_actual_fare_total" name="actual_fare_total" value="0">
        </div>
        <div class="form-group col-lg-4 m-b-10 m-t-10">
            <label style="float: left;">Refund Charges</label>
            <input class="form-control required" placeholder="Refund Charges" name="refund_charges" id="refund_charges" value="0" maxlength="10" type="text">
            <input type="hidden" name="hdn_refund_charges" id="hdn_refund_charges" value="0">
        </div>
        <div class="clear"></div>
        <div class="form-group col-lg-4 m-b-10 m-t-10"></div>
        <div class="form-group col-lg-4 m-b-10 m-t-10">
            <label style="float: left;">Service Charges</label>
            <input class="form-control required" placeholder="Service Charges" name="service_charges" id="service_charges" value="0" maxlength="10" type="text">
            <input type="hidden" name="hdn_service_charges" id="hdn_service_charges" value="0">
        </div>
        <div class="clear"></div>
        <div class="form-group col-lg-4 m-b-10 m-t-10"></div>
        <div class="form-group col-lg-4 m-b-10 m-t-10">
            <label style="float: left;">Receivable Charges</label>
            <input class="form-control required" placeholder="Receivable Charges" name="receivable_charges" disabled="disabled" id="receivable_charges" value="0" maxlength="10" type="text">
            <input type="hidden" name="hdn_receivable_charges" id="hdn_receivable_charges" value="0">
        </div>
        <div class="form-group col-lg-6 m-t-10">
        <button type="button" id="CreateCommission" class="btn btn-default m-t-10 pull-left">Save</button>
        </div>
        </form>
      </div>
      <div class="clear"></div>
      <div class="modal-footer">

      </div>
    </div>
  </div>
  <?php include_once('jquery.php');?>
  <script>
    $(document).ready(function() {
        // calculate actual value basic fare
        $("#basic_fare").keyup(function (){
            //$("#sum_vendor_payable").val(0);

            var basic_fare = $(this).val();
            //console.log(basic_fare); 
            //alert(basic_fare);
            if(basic_fare != "" && basic_fare != null && basic_fare != "NaN")
            {
                basic_fare = remove_comma(basic_fare);
                var tax = $("#tax").val();
                tax = remove_comma(tax);
                var total_fare = parseInt(tax) + parseInt(basic_fare);
                if(isNaN(total_fare))
                {
                    $("#actual_fare_total").val(0); 
                    $("#hdn_actual_fare_total").val(0); 
                }
                    
                else
                {
                    $("#actual_fare_total").val(addCommas(total_fare));
                    $("#hdn_actual_fare_total").val(addCommas(total_fare));
                }
            }
            else
            {
                $("#actual_fare_total").val(0);
                $("#hdn_actual_fare_total").val(0);
            }
        });

        // calculate actual value tax
        $("#tax").keyup(function (){
            var tax = $(this).val();
            if(tax != "" && tax != null && tax != "NaN")
            {
                tax = remove_comma(tax);
                var basic_fare = $("#basic_fare").val();
                basic_fare = remove_comma(basic_fare);
                var total_fare = parseInt(tax) + parseInt(basic_fare);
                if(isNaN(total_fare))
                    $("#actual_fare_total").val(0); 
                else
                {
                    $("#actual_fare_total").val(addCommas(total_fare)); 
                    $("#hdn_actual_fare_total").val(addCommas(total_fare));
                }
            }
            else
            {
                $("#actual_fare_total").val(0);
                $("#hdn_actual_fare_total").val(0);
            }
            
        });
        // calculate vendor
        $("#client_percent_rec_comm").keyup(function (){
            var client_percent_rec_comm = $(this).val();
            if(client_percent_rec_comm != "" && client_percent_rec_comm != null && client_percent_rec_comm != "NaN")
            {
                var client_percent_rec_comm = remove_comma(client_percent_rec_comm);
                var basic_fare = $("#basic_fare").val();
                basic_fare = remove_comma(basic_fare);
                //console.log(basic_fare+"***"+ven_percent_rec_comm);
                var client_rec_comm_total = parseInt(client_percent_rec_comm) / 100 * basic_fare;
                if(client_rec_comm_total != "" && client_rec_comm_total != null && client_rec_comm_total != "NaN")
                {
                    var client_rec_comm_total = numberFormat(client_rec_comm_total,"");
                    client_rec_comm_total = addCommas(client_rec_comm_total);
                    $("#client_rec_comm_total").val(client_rec_comm_total);
                    var hdn_actual_fare_total = $("#hdn_actual_fare_total").val();
                    client_rec_comm_total = remove_comma($("#client_rec_comm_total").val());
                    var refund_charges = remove_comma($("#refund_charges").val());
                    var service_charges = remove_comma($("#service_charges").val());

                   // alert(hdn_actual_fare_total+"***"+client_rec_comm_total);
                    var hdn_actual_fare_total = remove_comma(hdn_actual_fare_total);
                    var total_amount = parseInt(hdn_actual_fare_total) + parseInt(client_rec_comm_total); 
                    $("#total_amount").val(total_amount);
                    $("#hdn_total_amount").val(total_amount);
                    var receivable_charges = total_amount - refund_charges - service_charges;
                    $("#hdn_receivable_charges").val(receivable_charges);
                    $("#receivable_charges").val(receivable_charges);

                }
            }
            else
            {
                $("#client_rec_comm_total").val(0);
            }
            
        });

        // calculate client_rec_comm_total
        $("#client_rec_comm_total").keyup(function (){
            var client_rec_comm_total = $(this).val();
            if(client_rec_comm_total != "" && client_rec_comm_total != null && client_rec_comm_total != "NaN")
            {
                var client_rec_comm_total = remove_comma(client_rec_comm_total);
                var hdn_actual_fare_total = $("#hdn_actual_fare_total").val();
                var refund_charges = remove_comma($("#refund_charges").val());
                var service_charges = remove_comma($("#service_charges").val());

                // alert(hdn_actual_fare_total+"***"+client_rec_comm_total);
                var hdn_actual_fare_total = remove_comma(hdn_actual_fare_total);
                var total_amount = parseInt(hdn_actual_fare_total) + parseInt(client_rec_comm_total); 
                $("#total_amount").val(total_amount);
                $("#hdn_total_amount").val(total_amount);
                var receivable_charges = total_amount - refund_charges - service_charges;
                $("#hdn_receivable_charges").val(receivable_charges);
                $("#receivable_charges").val(receivable_charges);
            }
            else
            {
                $("#client_rec_comm_total").val(0);
            }
            
        });

        // refund_charges
        $("#refund_charges").keyup(function (){
            var refund_charges = $(this).val();
            if(refund_charges != "" && refund_charges != null && refund_charges != "NaN")
            {
                var client_rec_comm_total = $("#client_rec_comm_total").val();
                client_rec_comm_total = remove_comma(client_rec_comm_total);

                var service_charges = $("#service_charges").val();
                service_charges = remove_comma(service_charges);

                var total_amount = $("#hdn_total_amount").val();
                total_amount = remove_comma(total_amount);

                var receivable_charges = total_amount - refund_charges - service_charges;
                $("#hdn_refund_charges").val(receivable_charges);
                $("#receivable_charges").val(receivable_charges);
            }
            else
            {
                $("#client_rec_comm_total").val(0);
            }
            
        });


        // calculate vendor
        $("#ven_percent_rec_comm").keyup(function (){
            var ven_percent_rec_comm = $(this).val();
            if(ven_percent_rec_comm != "" && ven_percent_rec_comm != null && ven_percent_rec_comm != "NaN")
            {
                var ven_percent_rec_comm = remove_comma(ven_percent_rec_comm);
                var basic_fare = $("#basic_fare").val();
                basic_fare = remove_comma(basic_fare);
                //console.log(basic_fare+"***"+ven_percent_rec_comm);
                var vendor_rec_comm_total = parseInt(ven_percent_rec_comm) / 100 * basic_fare;
                if(vendor_rec_comm_total != "" && vendor_rec_comm_total != null && vendor_rec_comm_total != "NaN")
                {
                    var vendor_rec_comm_total = numberFormat(vendor_rec_comm_total,"");
                    vendor_rec_comm_total = addCommas(vendor_rec_comm_total);
                    $("#vendor_rec_comm_total").val(vendor_rec_comm_total);
                    $("#hdn_commissions").val(vendor_rec_comm_total);
                    $("#hdn_ven_main_total").val(vendor_rec_comm_total);
                    $("#commissions").val(vendor_rec_comm_total);
                }
            }
            else
            {
                $("#vendor_rec_comm_total").val(0);
                //$("#ven_main_total").val(0);
                $("#hdn_ven_main_total").val(0);
            }
        });
        // service_charges
        $("#service_charges").keyup(function (){
            var service_charges = $(this).val();
            if(service_charges != "" && service_charges != null && service_charges != "NaN")
            {
                var service_charges = remove_comma(service_charges);
                var refund_charges = $("#refund_charges").val();
                refund_charges = remove_comma(refund_charges);

                var hdn_total_amount = $("#hdn_total_amount").val();
                hdn_total_amount = remove_comma(hdn_total_amount);
                var receivable_charges = hdn_total_amount - service_charges - refund_charges;
                $("#receivable_charges").val(receivable_charges);
                $("#hdn_service_charges").val(receivable_charges);
                $("#hdn_receivable_charges").val(receivable_charges);
            }
            else
            {
                $("#receivable_charges").val(0);
                //$("#ven_main_total").val(0);
                $("#hdn_service_charges").val(0);
            }
        });

        // docsUpload
        $("#CreateCommission").click(function (){
            //var form = $('#add_commissions_form');
            var form_data = new FormData();                  
            form_data.append('basic_fare', $("#basic_fare").val());
            form_data.append('tax', $("#tax").val());
            form_data.append('hdn_actual_fare_total', $("#hdn_actual_fare_total").val());
            form_data.append('client_percent_rec_comm', $("#client_percent_rec_comm").val());
            form_data.append('client_rec_comm_total', $("#client_rec_comm_total").val());
            form_data.append('hdn_total_amount', $("#hdn_total_amount").val());
            form_data.append('hdn_refund_charges', $("#refund_charges").val());
            form_data.append('hdn_service_charges', $("#service_charges").val());
            form_data.append('hdn_receivable_charges', $("#hdn_receivable_charges").val());
            form_data.append('vendor_rec_comm_total', $("#vendor_rec_comm_total").val());
            form_data.append('hdn_commissions', $("#hdn_commissions").val());
            form_data.append('edit_action_id', $("#edit_action_id").val());
            form_data.append('ven_percent_rec_comm', $("#ven_percent_rec_comm").val());
            
            //alert(form_data); return false;
            $.ajax({
                        url: 'action.php?action=CreateCommissionForms', // point to server-side PHP script 
                        dataType: 'text',  // what to expect back from the PHP script, if anything
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: form_data,                         
                        type: 'post',
                        success: function(response){
                            $('#add_commissions_form')[0].reset();
                            //alert(response); return false;
                            //$("#text_comments").html('');
                            //$("#text_comments").html(response);
                            //console.log(response); return false;
                            window.location.href = 'view_ticket';
                        }
             });
        });

        }); // end ready
        function numberFormat(val, decimalPlaces) {
            var multiplier = Math.pow(10, decimalPlaces);
            return (Math.round(val * multiplier) / multiplier).toFixed(decimalPlaces);
        }
        function remove_comma(s) {
            var s = s.toString();
            s = s.split(',').join('');
            return s;   
        }
        function addCommas(nStr)
        {
            nStr += '';
            x = nStr.split('.');
            x1 = x[0];
            x2 = x.length > 1 ? '.' + x[1] : '';
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(x1)) {
                x1 = x1.replace(rgx, '$1' + ',' + '$2');
            }
            return x1 + x2;
        }
    </script>
</div>
   <input type="hidden" id="currentID" value="" />
    <?php include_once('jquery.php');?>
    
    
    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true,
                "order": [[ 0, "desc" ]]
        });
		// Get Delete Record ID
		$(document).on('click','.clsDelete',function(e){
			var DelID = jQuery(this).attr("id");
			$("#currentID").val(DelID);
		});	

        $(document).on('click','.edit_action',function(e){
            $('#add_commissions_form')[0].reset();
            var ID = $(this).attr("id");
            $("#edit_action_id").val(ID);
            var form_data = new FormData();                  
            form_data.append('current_id', ID);
            $.ajax({
                url: 'action.php?action=GetCommisionsData', // point to server-side PHP script 
                dataType: 'text',  // what to expect back from the PHP script, if anything
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,                         
                type: 'post',
                success: function(response){
                    var obj = eval( "(" + response + ")" );
                    //console.log(obj); return false;
                    $("#basic_fare").val(obj.basic_fare);
                    $("#tax").val(obj.tax);
                    $("#actual_fare_total").val(obj.actual_fare_total);
                    $("#hdn_actual_fare_total").val(obj.actual_fare_total);
                    $("#client_percent_rec_comm").val(obj.clint_psf_percent);
                    $("#client_rec_comm_total").val(obj.clint_psf_percent_value);
                    $("#total_amount").val(obj.hdn_total_amount);
                    $("#hdn_total_amount").val(obj.hdn_total_amount);
                    $("#refund_charges").val(obj.refund_charges);
                    $("#hdn_refund_charges").val(obj.refund_charges);
                    $("#service_charges").val(obj.service_charges);
                    $("#hdn_service_charges").val(obj.service_charges);
                    $("#receivable_charges").val(obj.amount);
                    $("#hdn_receivable_charges").val(obj.amount);
                    $("#ven_percent_rec_comm").val(obj.ven_percent_rec_comm);
                    $("#vendor_rec_comm_total").val(obj.vendor_rec_comm_total);
                    $("#commissions").val(obj.user_commisions);
                    $("#hdn_commissions").val(obj.user_commisions);
                    //window.location.href = "view_ticket";
                }
             });
        }); 

        // get_asi
        $(".get_asi").keyup(function () {
            var current_id = $(this).attr('id');
            var array = current_id.split('_');
            current_id = array[2];
            var current_value = $(this).val();
            var form_data = new FormData();                  
            form_data.append('current_id', current_id);
            form_data.append('current_value', current_value);
            //console.log(current_id); return false;
            $.ajax({
                        url: 'action.php?action=UpdateASI', // point to server-side PHP script 
                        dataType: 'text',  // what to expect back from the PHP script, if anything
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: form_data,                         
                        type: 'post',
                        success: function(response){
                            console.log(response); return false;
                            //window.location.href = "view_ticket";
                        }
             });
        });
        

        // get_commissions
        $(".get_commissions").keyup(function () {
            var current_id = $(this).attr('id');
            var array = current_id.split('_');
            current_id = array[2];
            var current_value = $(this).val();
            var form_data = new FormData();                  
            form_data.append('current_id', current_id);
            form_data.append('current_value', current_value);
            //console.log(current_id); return false;
            $.ajax({
                        url: 'action.php?action=UpdateCommissions', // point to server-side PHP script 
                        dataType: 'text',  // what to expect back from the PHP script, if anything
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: form_data,                         
                        type: 'post',
                        success: function(response){
                            console.log(response); return false;
                            //window.location.href = "view_ticket";
                        }
             });
        });

        //Show dialog upload visa docs
        $(".add_new_comments").on('click', function(){
            var current_id = $(this).attr('id');
            $("#comment_id").val(current_id);
            var form_data = new FormData();                  
            form_data.append('comment_id', $("#comment_id").val());
            $.ajax({
                        url: 'action.php?action=GetTicketComments', // point to server-side PHP script 
                        dataType: 'text',  // what to expect back from the PHP script, if anything
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: form_data,                         
                        type: 'post',
                        success: function(response){
                            //console.log(response); return false;
                            $("#text_comments").html('');
                            $("#text_comments").html(response);
                            //console.log(response); return false;
                            //window.location.href = 'view_ticket';
                        }
             });
            });
		
        

		// Update payment status
        jQuery(document).on('change','.get_payment_status123',function(e){
            var current_id = $(this).attr('id');
            var array = current_id.split('_');
            current_id = array[2];

            var selected_value = $(this).val();
            var PNR = $("#PNR_"+current_id).html();
            var selected_text = "";
            if(selected_value == 1)
                selected_text = "Prossess";
            else if(selected_value == 2)
                selected_text = "Ticketed";
            else if(selected_value == 3)
                selected_text = "Void";
            else if(selected_value == 4)
                selected_text = "Refund";
            var action = "UpdateTicketStatus";
            jQuery.ajax({
                type: "POST",
                url: "action.php",
                data: {current_id: current_id, action: action, selected_value: selected_value},
                cache: false,
                success: function(response)
                {
                    // update_staff
                    var obj = eval( "(" + response + ")" ) ;
                    //console.log(obj); //return false;

                    if(obj == "2")
                    {
                        $("#color_pax_name_"+current_id).css('color', 'green');
                        $("#ticket_dropdown_"+current_id).prop('disabled', 'disabled');
                    }
                    else
                    {
                        $("#color_pax_name_"+current_id).css('color', 'green');
                        $("#message_status").html('');
                        $("#message_status").html('Now this PNR '+PNR+' Ticket status is '+selected_text+'!');
                        $("#message_status").removeClass('hide');    
                    }
                    
                }
            });
        });

        // Delete Record show Dialog Box

        jQuery(document).on('click','#DeleteRecord',function(e){

            var DelID = $("#currentID").val();

            var action = "DeleteTicket";

            jQuery.ajax({

                type: "POST",

                url: "action.php",

                data: {DelID : DelID, action : action},

                cache: false,

                success: function(response)

                {
                    var obj = eval( "(" + response + ")" ) ;
                    if(obj == "2")

                    {

                        jQuery("#DelID_"+DelID).hide(); 

                        $("#myModal").modal('hide');

                    }

                     

                }

            });

        });
    });
    function GetSupervised(current_id)
    {
        if($("#supervised_"+current_id).prop('checked')) {
            //alert('checked');
            var is_supervised = 1;
        } else {
            var is_supervised = 0;
        }
        //return false;
        var action = "UpdateSupervisedTicket";
        $.ajax({
            type: "POST",
            url: "action.php",
            data: {current_id: current_id, action: action, is_supervised: is_supervised},
            cache: false,
            success: function(response)
            {
                // update_staff
                var obj = eval( "(" + response + ")" ) ;
                //console.log(obj); return false;

                if(obj == "2")
                {
                    <?php if($_SESSION["user_type"] == 2) { ?>
                    $("#EditDisable_"+current_id).addClass('disabled');
                    $("#supervised_"+current_id).addClass('disabled');
                    $("#supervised_"+current_id).attr('disabled', true);
                    $("#get_asi_"+current_id).attr('disabled', true);
                    $("#user_commisions_"+current_id).attr('disabled', true);
                    <?php } ?>
                }
            }
        });
    }
    function ChangePaymentStatus(current_id, selected_value, user_id){
        var PNR = $("#PNR_"+current_id).html();
        //var selected_text = "";
        if(selected_value == 1)
            selected_text = "Prossess";
        else if(selected_value == 2)
            selected_text = "Ticketed";
        else if(selected_value == 3)
            selected_text = "Void";
        else if(selected_value == 4)
            selected_text = "Refund";
        else if(selected_value == 5)
            selected_text = "PNR Expired";
        else if(selected_value == 6)
            selected_text = "Reissued";
        else if(selected_value == 7)
            selected_text = "Rejected";
        else if(selected_value == 8)
            selected_text = "Link Down";
        else if(selected_value == 9)
            selected_text = "In Prossess";
        var action = "UpdateTicketStatus";
        jQuery.ajax({
            type: "POST",
            url: "action.php",
            data: {current_id: current_id, action: action, selected_value: selected_value, user_id: user_id},
            cache: false,
            success: function(response)
            {
                // update_staff
                var obj = eval( "(" + response + ")" ) ;
                //console.log(obj); //return false;

                if(obj == "2")
                {
                    $("#color_pax_name_"+current_id).css('color', 'green');
                    $("#ticket_dropdown_"+current_id).prop('disabled', 'disabled');
                    window.location.href = "view_ticket";
                }
                else
                {
                    $("#color_pax_name_"+current_id).css('color', 'green');
                    $("#message_status").html('');
                    $("#message_status").html('Now this PNR '+PNR+' Ticket status is '+selected_text+'!');
                    $("#message_status").removeClass('hide'); 
                    window.location.href = "view_ticket";  
                }
                
            }
        });
    }
    function UpdateVendor(current_id, current_value) {
        //alert(current_id+"*****"+current_value);
        var action = "UpdateVendor";
        $.ajax({
            type: "POST",
            url: "action.php",
            data: {current_id: current_id, action: action, current_value: current_value},
            cache: false,
            success: function(response)
            {
                var obj = eval( "(" + response + ")" ) ;
                if(obj == "2")
                {
                    window.location.href = "view_ticket";
                }
            }
        });
    }
    </script>
    <style type="text/css">
    .table-responsive {
      overflow-x: inherit !important;
    }
    </style>
</body>

</html>
