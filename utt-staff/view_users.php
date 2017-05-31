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
                    <h1 class="page-header">View User</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            View Users
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>User Name</th>
                                            <th>Air Lines Access</th>
                                            <th>Login Name</th>
                                            <th>User Type</th>
                                            <th>Enable/Disable</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    	$SQL = "SELECT * FROM tbluser WHERE user_status = '1' ORDER BY user_id DESC";			
										 $result = MySQLQuery($SQL);
										 while($row = mysql_fetch_array($result)) { // ,MYSQL_ASSOC
										 //$UserType = ($row['user_type'] == '1' ? 'Admin' : 'Client');
                                            if($row['user_type'] == 0)
                                                $UserType = "Client";
                                            else if($row['user_type'] == 1)
                                                $UserType = "Admin";
                                            else if($row['user_type'] == 2)
                                                $UserType = "Staff";
                                            else if($row['user_type'] == 3)
                                                $UserType = "Franchize User";
										 $Status = ($row['user_status'] == '1' ? 'Enable' : 'Disable');
									?>
                                        <tr class="odd gradeX" id="DelID_<?php echo $row['user_id'];?>">
                                            <td class="left"><?php echo $row['user_name'];?></td>
                                            <td class="left"><?php echo AirLinesCode($row['user_id']);?></td>
                                            <td class="left"><?php echo $row['user_login'];?></td>
                                            <td class="left"><?php echo $UserType;?></td>
                                            <td class="left"><?php echo $Status;?></td>
                                            <td class="leftsidebar"><a href="users?id=<?php echo $row['user_id'];?>"><img height="16" width="16" src="../images/edit.png" alt="Edit"></a>&nbsp;&nbsp;&nbsp;<a id="<?php echo $row['user_id'];?>" class='clsDelete'><img data-target="#myModal" data-toggle="modal" src="../images/delete.png" height="16" width="16" alt="Delete"></a></td>
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
		
		// Delete Record show Dialog Box
		jQuery(document).on('click','#DeleteRecord',function(e){
			var DelID = $("#currentID").val();
			var action = "DeleteUsers";
			jQuery.ajax({
				type: "POST",
				url: "action.php",
				data: {DelID : DelID, action : action},
				cache: false,
				success: function(response)
				{
                    console.log(response);
					if(response == 2)
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
