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
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Pax Name</th>
                                            <th>Sector</th>
                                            <th>PNR</th>
                                            <th>Amount</th>
                                            <th>Air line</th>
                                            <th>Mode</th>
                                            <th>User Name</th>
                                            <th>Date</th>
                                            <th>Ticket Status</th>
                                            <th>Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    	$SQL = "SELECT * FROM tblissuerefund ORDER BY id DESC";			
										 $result = MySQLQuery($SQL);
										 while($row = mysql_fetch_array($result)) { // ,MYSQL_ASSOC
                                            $ticket_status = $row['ticket_status'];
                                            $update_status = $row['update_status'];
                                            $edit_rows_status = $row['edit_rows_status'];
                                            if($edit_rows_status == 1 && $_SESSION["user_type"] == 2)
                                                $disabled_edit = "disabled='disabled'";
                                            else
                                                $disabled_edit = "";
                                            if($update_status == 1 && $_SESSION["user_type"] == 2)
                                                $disabled = "disabled='disabled'";
                                            else
                                                $disabled = "";
                                            $prossess_selected = "";
                                            $ticketed_selected = "";
                                            $void_selected = "";
                                            $refund_selected = "";
                                            if($ticket_status == 1)
                                                $prossess_selected = "selected='selected'";
                                            else if($ticket_status == 2)
                                                $ticketed_selected = "selected='selected'";
                                            else if($ticket_status == 3)
                                                $void_selected = "selected='selected'";
                                            else if($ticket_status == 4)
                                                $refund_selected = "selected='selected'";
									?>
                                        <tr class="odd gradeX" id="DelID_<?php echo $row['id'];?>">
                                            <td class="left"><?php echo $row['pax_name'];?></td>
                                            <td class="left"><?php echo $row['sector'];?></td>
                                            <td class="left" id="PNR_<?php echo $row['id'];?>"><?php echo $row['pnr'];?></td>
                                            <td class="left"><?php echo $row['pin'];?></td>
                                            <td class="left"><?php echo AirLinesName($row['air_line_id']);?></td>
                                            <td class="left"><?php echo $arrIssue[$row['mode_type'] - 1];?></td>
                                            <td class="left"><?php echo UserName($row['user_id']);?></td>
                                            <td class="left"><?php echo date("d-m-Y h:m:i A", strtotime($row['date']));?></td>
                                            <td class="left" style="padding-top: 0;padding-bottom: 0;">
                                                <select name="ticket_status" id="ticket_dropdown_<?php echo $row['id'];?>" <?php echo $disabled; ?> class="get_payment_status form-control valid">
                                                  <option value="1" <?php echo $prossess_selected; ?>>Prossess</option>
                                                  <option value="2" <?php echo $ticketed_selected; ?>>Ticketed</option>
                                                  <option value="3" <?php echo $void_selected; ?>>Void</option>
                                                  <option value="4" <?php echo $refund_selected; ?>>Refund</option>
                                              </select>
                                            </td>
                                            <td class="left"><a class="btn btn-primary" role="button" <?php echo $disabled_edit; ?> href="edit_ticket.php?id=<?php echo $row['id'];?>">Edit</a></td>
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
		
		// Update payment status
        jQuery(document).on('change','.get_payment_status',function(e){
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
                        $("#ticket_dropdown_"+current_id).prop('disabled', 'disabled');
                    }
                    else
                    {
                        $("#message_status").html('');
                        $("#message_status").html('Now this PNR '+PNR+' Ticket status is '+selected_text+'!');
                        $("#message_status").removeClass('hide');    
                    }
                    
                }
            });
        });
    });
    </script>

</body>

</html>
