<?php include_once('top.php'); ?>



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

                    <h1 class="page-header hide">Issue or Refund</h1>

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

                            Issue or Refund

                        </div>

                        <div class="panel-body">

                            <div class="row">

                                <div class="col-lg-12">

                                    <form role="form" action="action.php" id="myForm" method="post">

                                    <input type="hidden" name="action" id="action" value="IssueOrRefund" />

                                        <?php

                                        TextField("Pax Name", "pax_name", "", "20","6","form-control required");

										TextField("Air Line Code", "sector", "", "2","6","form-control required");

										?>

                                        <div class="clear m-t-10"></div>

                                        <?php

                                        TextField("PNR", "pnr", "", "20","6","form-control required");

										TextField("Desitnation Code", "air_line_code", "", "3","6","form-control required");

										?>

                                        <div class="clear hide"></div>

                                        <div class="form-group col-lg-6 m-b-0">

                                        <label>Select Air Line</label>

						                  <?php TableComboMsSql("tblairlines", "air_line_name", "air_line_id", "client_id = 0", "air_line_id", "", "", "<option value=''>Select Air Line</option><option value='1'>IATA (BSP)</option>", "form-control", ""); ?>

                                          </div>

                                         <div class="form-group col-lg-6 m-b-0 m-t-0">

                                        <label>Mode</label>

										<?php ArrayComboBox("mode_type", "", $arrIssue, true, "", "", "form-control");?>

                                        </div> 

                                          

                                          

                                          <div class="clear"></div>

                                        <div class="form-group col-lg-6">

                                        <button type="submit" id="AirLineSave" class="btn btn-default m-t-10">Submit</button>

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
		var validate = jQuery('#myForm').validate();
	});

    </script>



</body>



</html>

