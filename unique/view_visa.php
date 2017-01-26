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
                                            <th>Passport Image</th>
                                            <th>Action</th>
                                            <th>View VISA Doc</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $SQL = "SELECT * FROM tblumrah WHERE user_id = ".(int)$_SESSION["client_id"]." ORDER BY id DESC";
                                         $result = MySQLQuery($SQL);
                                         while($row = mysql_fetch_array($result)) { // ,MYSQL_ASSOC
                                            $visa_status = $row['visa_status'];
                                            $inprocess_selected = "";
                                            $aproved_selected = "";
                                            $rejected_selected = "";
                                            if($visa_status == 1)
                                                $visa_status = "In Process";
                                            else if($visa_status == 2)
                                                $visa_status = "Approved";
                                            else if($visa_status == 3)
                                                $visa_status = "Rejected";
                                            //$inprocess_selected = "";

                                    ?>
                                        <tr class="odd gradeX" id="DelID_<?php echo $row['id'];?>">
                                            <td class="left"><?php echo $row['sur_name'];?></td>
                                            <td class="left"><?php echo $row['given_name'];?></td>
                                            <td class="left" id="Trans_<?php echo $row['id'];?>"><?php echo $row['passport_no'];?></td>
                                            <td class="left" style="padding-top: 0;padding-bottom: 0;"><?php echo $visa_status; ?></td>
                                            <td class="left"><a href="" id="<?php echo $row['id'];?>" data-toggle="modal" data-target=".bs-example-modal-lg2" class="show_passport">View Passport Image</a></td>
                                            <td class="left"><a href="" id="<?php echo $row['id'];?>" data-toggle="modal" data-target=".bs-example-modal-lg" class="show_dialog">View All Details</a></td>
                                            <td class="left"><a href="" id="<?php echo $row['id'];?>" data-toggle="modal" data-target=".bs-example-modal-lg5" class="show_visa_docs">Visa Docs</a></td>
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
                        console.log(response);
                        $("#visa_details").html(response);
                    }
                });
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
                        console.log(response);
                        var src1 = 'images/user_passport/'+response+'';
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
                        var src1 = 'images/visa_docs/'+response+'';
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
                        $("#message_status").html('');
                        $("#message_status").html('Now this Passport No '+Trans_id+' visa status is '+selected_text+'!');
                        $("#message_status").removeClass('hide');    
                    }
                }
            });
        });
    });
    </script>

</body>

</html>
