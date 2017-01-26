<?php include_once('top.php');?>

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
                    <h1 class="page-header">View Payment</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12 alert alert-success hide" id="message_status"></div>
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
                                            <th>Amount</th>
                                            <th>TransductionID</th>
                                            <th>PIN</th>
                                            <th>Bank</th>
                                            <th>User Name</th>
                                            <th>Date</th>
                                            <th>Payment Status</th>
                                            <th>Scan Slip</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    	$SQL = "SELECT * FROM tblepayment ORDER BY id DESC";			
										 $result = MySQLQuery($SQL);
										 while($row = mysql_fetch_array($result)) { // ,MYSQL_ASSOC
                                            $payment_status = $row['payment_status'];
                                            $update_status = $row['update_status'];
                                            if($update_status == 1 && $_SESSION["user_type"] == 2)
                                                $disabled = "disabled='disabled'";
                                            else
                                                $disabled = "";
                                            $inprocess_selected = "";
                                            $aproved_selected = "";
                                            $rejected_selected = "";
                                            if($payment_status == 1)
                                                $inprocess_selected = "selected='selected'";
                                            else if($payment_status == 2)
                                                $aproved_selected = "selected='selected'";
                                            else if($payment_status == 3)
                                                $rejected_selected = "selected='selected'";
									?>
                                        <tr class="odd gradeX" id="<?php echo $row['id'];?>">
                                            <td class="left"><?php echo $row['amount'];?></td>
                                            <td class="left" id="Trans_<?php echo $row['id'];?>"><?php echo $row['transection_id'];?></td>
                                            <td class="left"><?php echo $row['pin'];?></td>
                                            <td class="left"><?php echo $arrBank[$row['bank_id'] - 1];?></td>
                                            <td class="left"><?php echo UserName($row['user_id']);?></td>
                                            <td class="left"><?php echo date("d-m-Y h:m:i A", strtotime($row['date']));?></td>
                                            <td class="left" style="padding-top: 0;padding-bottom: 0;">
                                                <select name="payment_status" id="payment_dropdown_<?php echo $row['id'];?>" <?php echo $disabled; ?> class="get_payment_status form-control valid">
                                                  <option value="1" <?php echo $inprocess_selected; ?>>In process</option>
                                                  <option value="2" <?php echo $aproved_selected; ?>>Aproved</option>
                                                  <option value="3" <?php echo $rejected_selected; ?>>Rejected</option>
                                              </select>
                                            </td>
                                            <td class="left"><a href="" id="<?php echo $row['id'];?>" data-toggle="modal" data-target=".bs-example-modal-lg" class="show_dialog">View Bank Slip</a></td>
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
   <input type="hidden" id="currentID" value="" />
    <?php include_once('jquery.php');?>
    
    
    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
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
                        $("#payment_dropdown_"+current_id).prop('disabled', 'disabled');
                    }
                    else
                    {
                        $("#message_status").html('');
                        $("#message_status").html('Now this TransductionID '+Trans_id+' payment status is '+selected_text+'!');
                        $("#message_status").removeClass('hide');    
                    }
				}
			});
		});
    });
    </script>

</body>

</html>
