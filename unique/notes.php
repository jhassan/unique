<?php include_once('top.php');

	$strRow = "";

	$whereNotes = " user_id = ".$_SESSION['client_id'];
	$GetRecordNotes = GetRecord("tbluser", $whereNotes);
	$notes = $GetRecordNotes['notes'];

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

                    <h1 class="page-header hide">Notes</h1>

                </div>

                <!-- /.col-lg-12 -->

            </div>

            <!-- /.row -->

            <div class="row" style="margin-top:25px;">

                <div class="col-lg-12">

                    <div class="panel panel-default">
                        <div class="panel-heading">

                            Notes

                        </div>

                        <div class="panel-body">

                            <div class="row">

                                <div class="col-lg-12">

										<div class="form-group m-10">

                                            <textarea disabled style="background-color:#FFF; height:250px" class="form-control col-lg-6" name="bank_text" rows="7" cols=""><?php echo $notes;?>
</textarea>

                                        </div>

                                        <div class="clear"></div>


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

