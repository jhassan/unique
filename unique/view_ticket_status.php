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
                    <h1 class="page-header">View Ticket Status</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            View Tickets Status
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
                                            <th class="hide">View Comment</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    	$SQL = "SELECT * FROM tblissuerefund WHERE user_id = ".(int)$_SESSION["client_id"]." ORDER BY id DESC";			
										 $result = MySQLQuery($SQL);
										 while($row = mysql_fetch_array($result)) { // ,MYSQL_ASSOC
                                            $ticket_status = $row['ticket_status'];
                                            $inprocess_selected = "";
                                            $aproved_selected = "";
                                            $rejected_selected = "";
                                            if($ticket_status == 1)
                                                $ticket_status = "Prossess";
                                            else if($ticket_status == 2)
                                                $ticket_status = "Ticketed";
                                            else if($ticket_status == 3)
                                                $ticket_status = "Void";
                                            else if($ticket_status == 4)
                                                $ticket_status = "Refund";
                                            else if($ticket_status == 5)
                                                $ticket_status = "PNR Expired";
                                            else if($ticket_status == 6)
                                                $ticket_status = "Reissued";
                                            else if($ticket_status == 7)
                                                $ticket_status = "Rejected";
                                            else if($ticket_status == 8)
                                                $ticket_status = "Link Down";
                                            else if($ticket_status == 9)
                                                $ticket_status = "In Prossess";
                                            else if($ticket_status == 10)
                                                $ticket_status = "Limit Exceeded";
                                            else if($ticket_status == 11)
                                                $ticket_status = "Flight Check-in";
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
                                            <td class="left" style="padding-top: 0;padding-bottom: 0;"><?php echo $ticket_status; ?></td>
                                            <td class="left hide"><a href="" id="<?php echo $row['id'];?>" data-toggle="modal" data-target=".bs-example-modal-lg4" class="add_new_comments">View Comment</a></td>
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
        <h4 class="modal-title" id="myModalLabel">View Comment</h4>
      </div>
      <div class="modal-body" align="center" style="padding: 0px;">
        <form role="form" onsubmit="return false;" action="action.php" method="post">
        <input type="hidden" name="action" id="action" value="UploadVisaDocs" />
        <input type="hidden" name="comment_id" id="comment_id" value="" />
        <div class="form-group m-r-15 m-t-10 col-lg-6">
            <textarea disabled="disabled" cols="80" rows="10" name="text_comments" id="text_comments"></textarea>
        </div>
        </form>
      </div>
      <div class="modal-footer">
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
                responsive: true,
                "order": [[ 0, "desc" ]]
        });
		// Get Delete Record ID
		jQuery(document).on('click','.clsDelete',function(e){
			var DelID = jQuery(this).attr("id");
			$("#currentID").val(DelID);
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
        jQuery(document).on('change','.get_payment_status',function(e){
            var current_id = $(this).attr('id');
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
                    $("#message_status").html('');
                    $("#message_status").html('Now this PNR '+PNR+' Ticket status is '+selected_text+'!');
                    $("#message_status").removeClass('hide');
                }
            });
        });
    });
    </script>

</body>

</html>
