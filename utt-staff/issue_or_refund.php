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
                                    <div class="form-group col-lg-4 m-t-10">
                                        <label>Select Client</label>
                                        <select name="user_id" id="user_id" class="form-control" style="">
                                            <option value="">Select Client</option>
                                            <?php
                                            $SQL = "SELECT user_id, user_name FROM tbluser WHERE user_type = '0' AND user_status = '1' ORDER BY user_name";            
                                             $result = MySQLQuery($SQL);
                                             $air_line_id = "";
                                             while($row = mysql_fetch_array($result)) { // ,MYSQL_ASSOC
                                            ?>
                                            <option value="<?php echo $row['user_id']?>"><?php echo $row['user_name']?></option>
                                            <?php }  ?>
                                        </select>
                                    </div>
                                    <div class="clear"></div>
                                        <?php

                                        TextField("Pax Name", "pax_name", "", "20","6","form-control required");

										TextField("Sector", "sector", "", "20","6","form-control required");

										?>

                                        <div class="clear m-t-10"></div>

                                        <?php

                                        TextField("PNR", "pnr", "", "20","6","form-control required");

										TextField("Amount", "amount", "", "20","6","form-control required number_only");

										?>

                                        <div class="clear"></div>

                                        <div class="form-group col-lg-6 m-t-10">

                                        <label>Select Air Line</label>

						                  <?php TableComboMsSql("tblairlines", "air_line_name", "air_line_id", "", "air_line_id", "", "", "<option value=''>Select Air Line</option>", "form-control", ""); ?>

                                          </div>

                                         <div class="form-group col-lg-6 m-b-0 m-t-10">

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

