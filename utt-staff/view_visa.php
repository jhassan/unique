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
                    <h1 class="page-header">View Visa</h1>
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
                            View Visa
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Sur Name</th>
                                            <th>Given Name</th>
                                            <th>Passport No</th>
                                            <th>Visa Status</th>
                                            <th>Created By</th>
                                            <th>Updated By</th>
                                            <th>Passport Image</th>
                                            <th>Action</th>
                                            <th>Upload VISA Doc</th>
                                            <th>View VISA Doc</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    	$SQL = "SELECT * FROM tblumrah ORDER BY id DESC";			
										 $result = MySQLQuery($SQL);
										 while($row = mysql_fetch_array($result)) { // ,MYSQL_ASSOC
                                            $visa_status = $row['visa_status'];
                                            $inprocess_selected = "";
                                            $aproved_selected = "";
                                            $rejected_selected = "";
                                            if($visa_status == 1)
                                                $inprocess_selected = "selected='selected'";
                                            else if($visa_status == 2)
                                                $aproved_selected = "selected='selected'";
                                            else if($visa_status == 3)
                                                $rejected_selected = "selected='selected'";
                                            if($visa_status == 1 && $_SESSION["user_type"] == 2)
                                                $disabled = "disabled='disabled'";
                                            else
                                                $disabled = "";
                                            $is_active = $row['is_active'];
                                            if($is_active == 1)
                                                $color = "green";
                                            else
                                                $color = "red";
                                            //$inprocess_selected = "";

									?>
                                        <tr class="odd gradeX" id="DelID_<?php echo $row['id'];?>">
                                            <td class="left" id="color_pax_name_<?php echo $row['id'];?>" style="color:<?php echo $color; ?>"><?php echo $row['sur_name'];?></td>
                                            <td class="left"><?php echo $row['given_name'];?></td>
                                            <td class="left" id="Trans_<?php echo $row['id'];?>"><?php echo $row['passport_no'];?></td>
                                            <td class="left" style="padding-top: 0;padding-bottom: 0;">
                                                <select name="visa_status" id="visa_status_dropdown_<?php echo $row['id'];?>" <?php echo $disabled; ?> class="get_visa_status form-control valid">
                                                  <option value="1" <?php echo $inprocess_selected; ?>>In process</option>
                                                  <option value="2" <?php echo $aproved_selected; ?>>Aproved</option>
                                                  <option value="3" <?php echo $rejected_selected; ?>>Rejected</option>
                                              </select>
                                            </td>
                                            <td class="left"><?php echo UserName($row['user_id']);?></td>
                                            <td class="left"><?php echo UserName($row['update_user_id']);?></td>
                                            <td class="left"><a href="" id="<?php echo $row['id'];?>" data-toggle="modal" data-target=".bs-example-modal-lg2" class="show_passport">Passport Image</a></td>
                                            <td class="left"><a href="" id="<?php echo $row['id'];?>" data-toggle="modal" data-target=".bs-example-modal-lg" class="show_dialog">All Details</a></td>
                                            <td class="left"><a href="" id="<?php echo $row['id'];?>" data-toggle="modal" data-target=".bs-example-modal-lg4" class="upload_visa_docs">Upload Visa Docs</a></td>
                                            <td class="left"><a href="" id="<?php echo $row['id'];?>" data-toggle="modal" data-target=".bs-example-modal-lg5" class="show_visa_docs">Visa Docs</a></td>
                                            <td class="left">
                                                <a <?php echo $disabled_edit; ?> href="edit_visa.php?id=<?php echo $row['id'];?>"><img height="16" width="16" src="../images/edit.png" alt="Edit"></a>
                                                <?php if($_SESSION["user_type"] == 1) { ?>
                                                &nbsp;&nbsp;&nbsp;<a class='cursor clsDelete' id="<?php echo $row['id'];?>"><img data-target="#myModal" data-toggle="modal" src="../images/delete.png" height="16" width="16" alt="Delete"></a>
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
<div class="modal fade bs-example-modal-lg4" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Upload Visa Docs</h4>
      </div>
      <div class="modal-body" align="center" style="padding: 0px;">
        <form role="form" onsubmit="return false;" action="action.php" id="docsUploadForm" method="post" enctype="multipart/form-data">
        <input type="hidden" name="action" id="action" value="UploadVisaDocs" />
        <input type="hidden" name="visa_doc_id" id="visa_doc_id" value="" />
        <div class="form-group m-r-15 m-t-10 col-lg-6">
            <label class="text-left">Upload Visa Docs</label>
            <input type="file" name="fileToUpload" id="fileToUpload" class="required" style="padding-left:73px;">
        </div>
        <div class="form-group col-lg-6">
        <button type="submit" id="docsUpload" class="btn btn-default m-t-10" style="margin-right: 29px;">Submit</button>
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
        $("#docsUpload").click(function (){
            var file_data = $('#fileToUpload').prop('files')[0];   
            var form_data = new FormData();                  
            form_data.append('fileToUpload', file_data);
            form_data.append('visa_doc_id', $("#visa_doc_id").val());
            $.ajax({
                        url: 'action.php?action=UploadVisaDocs', // point to server-side PHP script 
                        dataType: 'text',  // what to expect back from the PHP script, if anything
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: form_data,                         
                        type: 'post',
                        success: function(php_script_response){
                            window.location.href = 'view_visa';
                        }
             });
        });
        });
    </script>
</div>
<div class="modal fade bs-example-modal-lg3" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">View Visa Docs</h4>
      </div>
      <div class="modal-body" align="center" id="visa_docs_image">
        <img src="" width="600">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade bs-example-modal-lg2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">View Passport Image</h4>
      </div>
      <div class="modal-body" align="center" id="passport_image">
        <img src="" width="600">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade bs-example-modal-lg5" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">View Visa Docs Image</h4>
      </div>
      <div class="modal-body" align="center" id="visa_docs_image">
        <img src="" width="600">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade bs-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">View All Details</h4>
      </div>
      <div class="modal-body" align="center" id="visa_details">
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
            var action = "GetVisaDetail";
            jQuery.ajax({
                    type: "POST",
                    url: "action.php",
                    data: {current_id: current_id, action: action},
                    cache: false,
                    success: function(response)
                    {
                        //console.log(response);
                        $("#visa_details").html(response);
                    }
                });
            });

        //Show dialog upload visa docs
        $(".upload_visa_docs").on('click', function(){
            var current_id = $(this).attr('id');
            $("#visa_doc_id").val(current_id);
            
            });

        //Show dialog with passport image
        $(".show_passport").on('click', function(){
            var current_id = $(this).attr('id');
            //console.log(current_id);
            var action = "GetPassportImageName";
            jQuery.ajax({
                    type: "POST",
                    url: "action.php",
                    data: {current_id: current_id, action: action},
                    cache: false,
                    success: function(response)
                    {
                        //console.log(response);
                        var src1 = '../unique/images/user_passport/'+response+'';
                        $("#passport_image img").attr("src", src1);
                        //$("#bank_slip_image")
                    }
                });
            });

        //Show dialog with visa docs
        $(".show_visa_docs").on('click', function(){
            var current_id = $(this).attr('id');
            //console.log(current_id);
            var action = "GetVisaDocsImageName";
            jQuery.ajax({
                    type: "POST",
                    url: "action.php",
                    data: {current_id: current_id, action: action},
                    cache: false,
                    success: function(response)
                    {
                        //console.log(response);
                        var src1 = '../unique/images/visa_docs/'+response+'';
                        $("#visa_docs_image img").attr("src", src1);
                        //$("#bank_slip_image")
                    }
                });
            });

        // Update payment status
        jQuery(document).on('change','.get_visa_status',function(e){
            var current_id = $(this).attr('id');
            var array = current_id.split('_');
            current_id = array[3];
            //console.log(current_id); return false;
            var selected_value = $(this).val();
            var Trans_id = $("#Trans_"+current_id).html();
            var selected_text = "";
            if(selected_value == 1)
                selected_text = "In process";
            else if(selected_value == 2)
                selected_text = "Aproved";
            else if(selected_value == 3)
                selected_text = "Rejected";
            var action = "UpdateVisaStatus";
            jQuery.ajax({
                type: "POST",
                url: "action.php",
                data: {current_id: current_id, action: action, selected_value: selected_value},
                cache: false,
                success: function(response)
                {
                    // update_staff
                    var obj = eval( "(" + response + ")" ) ;
                    if(obj == "2")
                    {
                        $("#visa_status_dropdown_"+current_id).prop('disabled', 'disabled');
                    }
                    else
                    {
                        $("#color_pax_name_"+current_id).css('color', 'green');
                        $("#message_status").html('');
                        $("#message_status").html('Now this Passport No '+Trans_id+' visa status is '+selected_text+'!');
                        $("#message_status").removeClass('hide');    
                    }
                }
            });
        });
        
        // Delete Record show Dialog Box

        jQuery(document).on('click','#DeleteRecord',function(e){

            var DelID = $("#currentID").val();

            var action = "DeleteVisa";

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
