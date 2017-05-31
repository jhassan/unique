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
                    <h1 class="page-header">View Request</h1>
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
                            View Request
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>No of Pax</th>
                                            <th>Sector</th>
                                            <th>Preferd Airline</th>
                                            <th>One Way OR Return</th>
                                            <th>Date of Departure</th>
                                            <th>Date of Return</th>
                                            <th>Request Status</th>
                                            <th>Created By</th>
                                            <th>Updated By</th>
                                            <th>Add Comments</th>
                                            <th>View Comments</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    	$SQL = "SELECT * FROM tblgrouprequest ORDER BY id DESC";			
										 $result = MySQLQuery($SQL);
										 while($row = mysql_fetch_array($result)) { // ,MYSQL_ASSOC
                                            $request_status = $row['request_status'];
                                            $one_way_or_return = $row['one_way_or_return'];
                                            $update_status = $row['update_status'];
                                            $inprocess_selected = "";
                                            $prossesdehir_selected = "";
                                            $aproved_selected = "";
                                            $rejected_selected = "";
                                            if($request_status == 1)
                                                $inprocess_selected = "selected='selected'";
                                            else if($request_status == 2)
                                                $aproved_selected = "selected='selected'";
                                            else if($request_status == 3)
                                                $rejected_selected = "selected='selected'";
                                            else if($payment_status == 4)
                                                $prossesdehir_selected = "selected='selected'";
                                            if($update_status == 1 && $_SESSION["user_type"] == 2 && $row['update_user_id'] == $_SESSION["nUserId"])
                                                $disabled = "disabled='disabled'";
                                            else
                                                $disabled = "";
                                            if($one_way_or_return == 0)
                                                $way = "With Return";
                                            else if($one_way_or_return == 1)
                                                $way = "One Way";
                                            if($row['date_of_deparcher'] == "0000-00-00")
                                                $date_of_deparcher = "0000-00-00";
                                            else {
                                                $date_of_deparcher = date("d/m/Y",strtotime($row['date_of_deparcher']));
                                            }
                                            if($row['date_of_return'] == "0000-00-00")
                                                $date_of_return = "0000-00-00";
                                            else {
                                                $date_of_return = date("d/m/Y",strtotime($row['date_of_return']));
                                            }
                                            $is_active = $row['is_active'];
                                            if($is_active == 1)
                                                $color = "green";
                                            else
                                                $color = "red";
									?>
                                        <tr class="odd gradeX">
                                            <td class="left" id="color_pax_name_<?php echo $row['id'];?>" style="color:<?php echo $color; ?>"><?php echo $row['no_of_pax'];?></td>
                                            <td class="left"><?php echo $row['sector'];?></td>
                                            <td class="left" id="Trans_<?php echo $row['id'];?>"><?php echo $row['preferd_airline'];?></td>
                                            <td class="left"><?php echo $way;?></td>
                                            <td class="left"><?php echo $date_of_deparcher ;?></td>
                                            <td class="left"><?php echo $date_of_return;?></td>
                                            <td class="left" style="padding-top: 0;padding-bottom: 0;">
                                                <select name="visa_status" id="visa_status_dropdown_<?php echo $row['id'];?>" <?php echo $disabled; ?> class="get_request_status form-control valid">
                                                  <option value="1" <?php echo $inprocess_selected; ?>>In process</option>
                                                  <option value="4" <?php echo $prossesdehir_selected; ?>>Prossesdehir</option>
                                                  <option value="2" <?php echo $aproved_selected; ?>>Aproved</option>
                                                  <option value="3" <?php echo $rejected_selected; ?>>Rejected</option>
                                              </select>
                                            </td>
                                            <td class="left"><?php echo UserName($row['user_id']);?></td>
                                            <td class="left"><?php echo UserName($row['update_user_id']);?></td>
                                            <td class="left"><a href="" id="<?php echo $row['id'];?>" data-toggle="modal" data-target=".bs-example-modal-lg4" class="add_comments_amount">Add</a></td>
                                            <td class="left"><a href="" id="<?php echo $row['id'];?>" data-toggle="modal" data-target=".bs-example-modal-lg5" class="show_comments">View</a></td>
                                            <td class="left">
                                                <a <?php echo $disabled_edit; ?> href="edit_request.php?id=<?php echo $row['id'];?>"><img height="16" width="16" src="../images/edit.png" alt="Edit"></a>
                                                <?php if($_SESSION["user_type"] == 1) { ?>
                                                &nbsp;<a class='cursor clsDelete' id="<?php echo $row['id'];?>"><img data-target="#myModal" data-toggle="modal" src="../images/delete.png" height="16" width="16" alt="Delete"></a>
                                                <?php } ?>
                                            </td>
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
<div class="modal fade bs-example-modal-lg5" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">View Comments</h4>
      </div>
      <div class="modal-body" align="center" id="view_user_comments">
        <label style="float: left;" id="show_user_amount"></label>
        <div class="clear"></div>
        <label style="float: left;">Comments:</label>
        <div class="clear"></div>
        <p class="text-justify text-left" id="show_user_comments"></p>
      </div>
      <div class="clear"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>    
<div class="modal fade bs-example-modal-lg4" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Comments</h4>
      </div>
      <div class="modal-body" align="center" style="padding: 0px;">
        <form role="form" onsubmit="return false;" action="action.php" id="frm_add_comments" method="post" enctype="multipart/form-data">
        <input type="hidden" name="action" id="action" value="AddComments" />
        <input type="hidden" name="request_id" id="request_id" value="" />
        <div class="form-group m-r-15 m-t-10 col-lg-4">
            <label style="float: left;">Amount</label>
            <input type="text" name="amount" id="amount" class="form-control required">
        </div>
        <div class="clear"></div>
        <div class="form-group m-r-15 m-t-5 col-lg-8">
            <label style="float: left;">Comments</label>
            <textarea name="user_comments" id="user_comments" class="form-control required" cols="100" rows="2"></textarea>
        </div>
        <div class="clear"></div>
        <div class="form-group col-lg-6">
        <button type="submit" id="frmSubmit" style="float: left; margin-left:15px;" class="btn btn-default m-t-10">Submit</button>
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
        $("#frmSubmit").click(function (){
            //var file_data = $('#amount').val();   
            var form_data = new FormData();                  
            form_data.append('amount', $('#amount').val());
            form_data.append('user_comments', $('#user_comments').val());
            form_data.append('request_id', $("#request_id").val());
            $.ajax({
                        url: 'action.php?action=UpdateAmountComments', // point to server-side PHP script 
                        dataType: 'text',  // what to expect back from the PHP script, if anything
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: form_data,                         
                        type: 'post',
                        success: function(response){
                            window.location.href = 'view_request';
                        }
             });
        });
        });
    </script>
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
                responsive: true
        });
	
        //Show dialog add comments and amount
        $(".add_comments_amount").on('click', function(){
            var request_id = $(this).attr('id');
            $("#request_id").val(request_id);
            
            });

        // Get Delete Record ID
        jQuery(document).on('click','.clsDelete',function(e){
            var DelID = jQuery(this).attr("id");
            $("#currentID").val(DelID);
        });  

        //Show dialog with visa docs
        $(".show_comments").on('click', function(){
            var current_id = $(this).attr('id');
            //console.log(current_id);
            var action = "GetRequestComments";
            jQuery.ajax({
                    type: "POST",
                    url: "action.php",
                    data: {current_id: current_id, action: action},
                    cache: false,
                    success: function(response)
                    {
                        var obj = eval( "(" + response + ")" ) ;
                        //console.log(obj.amount); return false;
                        $("#show_user_amount").html('');
                        $("#show_user_amount").html('Amount: '+obj.amount);
                        $("#show_user_comments").html('');
                        $("#show_user_comments").html(obj.comments);
                    }
                });
            });

        // Update payment status
        jQuery(document).on('change','.get_request_status',function(e){
            var current_id = $(this).attr('id');
            var array = current_id.split('_');
            current_id = array[3];
            //console.log(current_id); return false;
            var selected_value = $(this).val();
            //var Trans_id = $("#Trans_"+current_id).html();
            var selected_text = "";
            if(selected_value == 1)
                selected_text = "In process";
            else if(selected_value == 2)
                selected_text = "Aproved";
            else if(selected_value == 3)
                selected_text = "Rejected";
            else if(selected_value == 4)
                selected_text = "Prossesdehir";
            var action = "UpdateRequestStatus";
            jQuery.ajax({
                type: "POST",
                url: "action.php",
                data: {current_id: current_id, action: action, selected_value: selected_value},
                cache: false,
                success: function(response)
                {
                    //console.log(response); return false;
                    // update_staff
                    var obj = eval( "(" + response + ")" ) ;
                    if(obj == "2")
                    {
                        $("#visa_status_dropdown_"+current_id).prop('disabled', 'disabled');
                        window.location.href = "view_request";
                    }
                    else
                    {
                        $("#color_pax_name_"+current_id).css('color', 'green');
                        $("#message_status").html('');
                        $("#message_status").html('Now status is '+selected_text+'!');
                        $("#message_status").removeClass('hide');    
                        window.location.href = "view_request";
                    }
                }
            });
        });
        // Delete Record show Dialog Box

        jQuery(document).on('click','#DeleteRecord',function(e){

            var DelID = $("#currentID").val();

            var action = "DeleteRequest";

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
    </script>

</body>

</html>
