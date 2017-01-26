<?php include_once('top.php'); 
    $ID = mysql_real_escape_string($_GET['id']);
    $Where = " id = ".(int)$ID."";
    $row = GetRecord('tblissuerefund', $Where);
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

                    <h1 class="page-header hide">Edit Ticket</h1>

                </div>

                <!-- /.col-lg-12 -->

            </div>

            <!-- /.row -->

            <div class="row" style="margin-top:25px;">

                <div class="col-lg-12">
                    <div class="panel panel-default">
                    <?php if($_GET['msg'] == "sent") {?>
					<div class="alert alert-success">Your request in processing!</div>
                    <?php } elseif($_GET['msg'] == "nosent") {  ?>
					<div class="alert alert-success">Email not sent successfully!</div>	
					<?php } ?>	

                        <div class="panel-heading">

                            Edit Ticket

                        </div>

                        <div class="panel-body">

                            <div class="row">

                                <div class="col-lg-12">

                                    <form role="form" action="action.php" id="myForm" method="post">

                                    <input type="hidden" name="action" id="action" value="UpdateTicket" />
                                    <input type="hidden" name="edit_id" id="edit_id" value="<?php echo $row['id']; ?>" />

                                        <?php

                                        TextField("Pax Name", "pax_name", $row['pax_name'], "20","6","form-control required");

										TextField("Sector", "sector", $row['sector'], "20","6","form-control required");

										?>

                                        <div class="clear m-t-10"></div>

                                        <?php

                                        TextField("PNR", "pnr", $row['pnr'], "20","6","form-control required");

										TextField("Amount", "pin", $row['pin'], "20","6","form-control required");

										?>

                                        <div class="clear"></div>


                                        <div class="form-group col-lg-6">

                                        <button type="submit" class="btn btn-default m-t-10">Edit</button>

                                        <button type="reset" class="btn btn-default hide">Reset Button</button>

                                        </div>

                                    </form>

                                </div>

                                <!-- /.col-lg-6 (nested) -->

                                

                                <!-- /.col-lg-6 (nested) -->

                            </div>

                            <!-- /.row (nested) -->

                        </div>

                        <!-- /.panel-body -->

                    </div>

                    <!-- /.panel -->

                </div>

                <!-- /.col-lg-12 -->

            </div>

            <!-- /.row -->

        </div>

        <!-- /#page-wrapper -->



    </div>

    <!-- /#wrapper -->



    <?php include_once('jquery.php');?>

    <script type="text/javascript">

	jQuery(function (){
		//var validate = jQuery('#myForm').validate();
	});

    </script>



</body>



</html>

