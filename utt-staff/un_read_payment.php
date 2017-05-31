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
                    <h1 class="page-header">View Un Read Payment</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12 alert alert-success hide" id="message_status"></div>
                <?php if($_GET['msg'] == "edit") {?>
                <div class="alert alert-success">Your record is updated successfully!</div>
                <?php }  ?>
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            View Payment
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Invoice#</th>
                                            <th>Today Invoice#</th>    
                                            <th class="sorting_desc">Date</th>
                                            <th>Amount</th>
                                            <th>TransductionID</th>
                                            <th>Bank</th>
                                            <th>Created By</th>
                                            <th>Updated By</th>
                                            <th>Payment Status</th>
                                            <th>Scan Slip</th>
                                            <th>Action</th>
                                            <?php
                                            if(!empty($staff_permissions) && in_array('60', $staff_permissions))
                                            {
                                            ?>
                                            <th>Super.</th>
                                            <th>Print</th>
                                            <?php } ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    	 $SQL = "SELECT * FROM tblepayment WHERE is_active = 0 ORDER BY id DESC";			
										 $result = MySQLQuery($SQL);
										 while($row = mysql_fetch_array($result)) { // ,MYSQL_ASSOC
                                            $disabled_sur = "";
                                            $disabled_checked = "";
                                            $disabled_class = "";
                                            $payment_status = $row['payment_status'];
                                            $update_status = $row['update_status'];
                                            $is_supervised = $row['is_supervised'];
                                            if($update_status == 1 && $_SESSION["user_type"] == 2)
                                                $disabled = "disabled='disabled'";
                                            else
                                                $disabled = "";
                                            $inprocess_selected = "";
                                            $prossesdehir_selected = "";
                                            $aproved_selected = "";
                                            $rejected_selected = "";
                                            if($payment_status == 1)
                                                $inprocess_selected = "selected='selected'";
                                            else if($payment_status == 2)
                                                $aproved_selected = "selected='selected'";
                                            else if($payment_status == 3)
                                                $rejected_selected = "selected='selected'";
                                            else if($payment_status == 4)
                                                $prossesdehir_selected = "selected='selected'";
                                            $is_active = $row['is_active'];
                                            if($is_active == 1)
                                                $color = "green";
                                            else
                                                $color = "red";
                                            if($is_supervised == 1 && $_SESSION["user_type"] == 2)
                                            {
                                                $disabled_sur = "disabled='disabled'";
                                                $disabled_checked = "checked='checked'";
                                                $disabled_class = "disabled";
                                            }
                                            elseif($is_supervised == 1 && $_SESSION["user_type"] == 1)
                                            {
                                                $disabled_checked = "checked='checked'";
                                            }
									?>
                                        <tr class="odd gradeX" id="DelID_<?php echo $row['id'];?>">
                                            <td class="center"><?php echo $row['id'];?></td>
                                            <td class="center"><?php echo $row['today_invoice_id'];?></td>
                                            <td id="color_pax_name_<?php echo $row['id'];?>" style="color:<?php echo $color; ?>" class="left"><?php echo date("dMy h:m", strtotime($row['date']));?></td>
                                            <td class="left"><?php echo number_format($row['amount'],2);?></td>
                                            <td class="left" id="Trans_<?php echo $row['id'];?>"><?php echo $row['transection_id'];?></td>
                                            <td class="left"><?php echo $arrBank[$row['bank_id'] - 1];?></td>
                                            <td class="left"><?php echo UserName($row['user_id']);?></td>
                                            <td class="left"><?php echo UserName($row['update_user_id']);?></td>
                                            <td class="left" style="padding-top: 0;padding-bottom: 0;">
                                                <select name="payment_status" id="payment_dropdown_<?php echo $row['id'];?>" <?php echo $disabled; ?> class="get_payment_status form-control valid">
                                                  <option value="1" <?php echo $inprocess_selected; ?>>In process</option>
                                                  <option value="4" <?php echo $prossesdehir_selected; ?>>Prossesdehir</option>
                                                  <option value="2" <?php echo $aproved_selected; ?>>Aproved</option>
                                                  <option value="3" <?php echo $rejected_selected; ?>>Rejected</option>
                                              </select>
                                            </td>
                                            <td class="left"><a href="" id="<?php echo $row['id'];?>" data-toggle="modal" data-target=".bs-example-modal-lg" class="show_dialog">View Bank Slip</a></td>
                                            <td class="left">
                                                <a class="<?php echo $disabled_class; ?>" id="EditDisable_<?php echo $row['id'];?>" <?php echo $disabled_edit; ?> <?php echo $disabled_edit; ?> href="edit_payment.php?id=<?php echo $row['id'];?>"><img height="16" width="16" src="../images/edit.png" alt="Edit"></a>
                                                <?php if($_SESSION["user_type"] == 1) { ?>
                                                &nbsp;&nbsp;&nbsp;<a class='cursor clsDelete' id="<?php echo $row['id'];?>"><img data-target="#myModal" data-toggle="modal" src="../images/delete.png" height="16" width="16" alt="Delete"></a>
                                                <?php } ?>
                                            </td>
                                            <?php
                                            if(!empty($staff_permissions) && in_array('60', $staff_permissions))
                                            {
                                            ?>
                                            <td class="left"><input class="<?php echo $disabled_class; ?>" style="margin-left: 15px;" <?php echo $disabled_sur; ?> <?php echo $disabled_checked; ?> type="checkbox" name="supervised" id="supervised_<?php echo $row['id'];?>" value="" onclick="GetSupervised(<?php echo $row['id'];?>);"></td>
                                            <?php } ?>
                                            <td class="left"><a target="_blank" href="payment_print.php?id=<?php echo $row['id'];?>"><button type="button" class="btn btn-block btn-primary">Print</button></a></td>
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
<!-- Modal -->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">View Bank Slip</h4>
      </div>
      <div class="modal-body" align="center" id="bank_slip_image">
        <img src="" width="600">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
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
<input type="hidden" id="currentID" value="" />
    <?php include_once('jquery.php');?>
    
    
    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true,
                "order": [[ 0, "desc" ]]
        });
        // $('#example').DataTable( {
        //     "order": [[ 3, "desc" ]]
        // } );
		// Get Delete Record ID
		jQuery(document).on('click','.clsDelete',function(e){
			var DelID = jQuery(this).attr("id");
			$("#currentID").val(DelID);
		});	

        //Show dialog with image
        $(".show_dialog").on('click', function(){
            var current_id = $(this).attr('id');
            //console.log(current_id);
            var action = "GetImageName";
            jQuery.ajax({
                    type: "POST",
                    url: "action.php",
                    data: {current_id: current_id, action: action},
                    cache: false,
                    success: function(response)
                    {
                        console.log(response);
                        var src1 = '../unique/images/payment_scan_images/'+response+'';
                        $("#bank_slip_image img").attr("src", src1);
                        //$("#bank_slip_image")
                    }
                });
            });
        //});
        
		
		// Update payment status
		jQuery(document).on('change','.get_payment_status',function(e){
			var current_id = $(this).attr('id');
            var array = current_id.split('_');
            current_id = array[2];
            var selected_value = $(this).val();
            var Trans_id = $("#Trans_"+current_id).html();
            var selected_text = "";
            if(selected_value == 1)
                selected_text = "In process";
            else if(selected_value == 2)
                selected_text = "Aproved";
            else if(selected_value == 3)
                selected_text = "Rejected";
			var action = "UpdatePaymentStatus";
			jQuery.ajax({
				type: "POST",
				url: "action.php",
				data: {current_id: current_id, action: action, selected_value: selected_value},
				cache: false,
				success: function(response)
				{
					// $("#message_status").html('');
     //                $("#message_status").html('Now this TransductionID '+Trans_id+' payment status is '+selected_text+'!');
     //                $("#message_status").removeClass('hide');
                    // update_staff
                    var obj = eval( "(" + response + ")" ) ;
                    //console.log(obj); //return false;

                    if(obj == "2")
                    {
                        $("#color_pax_name_"+current_id).css('color', 'green');
                        $("#payment_dropdown_"+current_id).prop('disabled', 'disabled');
                        window.location.href = "view_payment";
                    }
                    else
                    {
                        $("#color_pax_name_"+current_id).css('color', 'green');
                        $("#message_status").html('');
                        $("#message_status").html('Now this TransductionID '+Trans_id+' payment status is '+selected_text+'!');
                        $("#message_status").removeClass('hide'); 
                        window.location.href = "view_payment";   
                    }
				}
			});
		});

        // Delete Record show Dialog Box

        jQuery(document).on('click','#DeleteRecord',function(e){

            var DelID = $("#currentID").val();

            var action = "DeletePayment";

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
        var action = "UpdateSupervisedPayment";
        jQuery.ajax({
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
                    <?php } ?>
                }
            }
        });
    }
    </script>

</body>

</html>
