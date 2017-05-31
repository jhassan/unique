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

                    <h1 class="page-header">View Air Lines</h1>

                </div>

                <!-- /.col-lg-12 -->

            </div>

            <!-- /.row -->

            <div class="row">

                <div class="col-lg-12">

                    <div class="panel panel-default">

                        <div class="panel-heading">

                            Air Lines

                        </div>

                        <!-- /.panel-heading -->

                        <div class="panel-body">

                            <div class="dataTable_wrapper">

                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">

                                    <thead>

                                        <tr>

                                            <th>Name</th>

                                            <th>Code</th>

                                            <th>Image</th>

                                            <th>URL</th>

                                            <th>Action</th>

                                        </tr>

                                    </thead>

                                    <tbody>

                                    <?php

                                    	$SQL = "SELECT * FROM tblairlines WHERE client_id = 0 ORDER BY air_line_id DESC";			

										 $result = MySQLQuery($SQL);

										 while($row = mysql_fetch_array($result)) { // ,MYSQL_ASSOC
                                            if(empty($row['air_line_name']))
                                            {
                                                $UserName = UserDetails((int)$row['client_id']);
                                                $air_line_name = "BSP CAREER_".$UserName['user_name'];
                                            }        
                                            else
                                                $air_line_name = $row['air_line_name'];
									?>

                                        <tr class="odd gradeX" id="DelID_<?php echo $row['air_line_id'];?>">

                                            <td class="center"><?php echo $air_line_name;?></td>

                                            <td class="center"><?php echo $row['air_line_code'];?></td>

                                            <td class="center"><?php if(!empty($row['air_line_image'])) { ?><img src="images/air_lines/<?php echo $row['air_line_image'];?>" height="25" width="70" alt="Air Line"> <?php } ?></td>

                                            <td class="center"><a target="_blank" href="<?php echo $row['air_line_url'];?>">URL</a></td>

                                            <td class="center"><a href="air_lines?id=<?php echo $row['air_line_id'];?>"><img height="16" width="16" src="../images/edit.png" alt="Edit"></a>&nbsp;&nbsp;&nbsp;<a class='cursor clsDelete' id="<?php echo $row['air_line_id'];?>"><img data-target="#myModal" data-toggle="modal" src="../images/delete.png" height="16" width="16" alt="Delete"></a></td>

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

			var action = "DeleteAirLines";

			jQuery.ajax({

				type: "POST",

				url: "action.php",

				data: {DelID : DelID, action : action},

				cache: false,

				success: function(response)

				{

					if(response == "Record Deleted Successfully!")

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

