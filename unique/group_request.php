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

                    <h1 class="page-header hide">Group Request</h1>

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

                            Group Request

                        </div>

                        <div class="panel-body">

                            <div class="row">

                                <div class="col-lg-12">

                                    <form role="form" action="action.php" id="myForm" method="post">

                                    <input type="hidden" name="action" id="action" value="GroupRequest" />

                                        <?php

                                        TextField("No of Pax", "no_of_pax", "", "20","6","form-control required");

										TextField("Sector", "sector", "", "20","6","form-control required");

										?>
                                        <div class="clear"></div>
                                        <?php
                                        TextField("Preferd Airline", "preferd_airline", "", "20","6","form-control required");

                                        ?>

                                        <div class="clear m-t-10"></div>
                                        <div class="form-group col-lg-2">
                                            <label>One Way OR Return</label>
                                            <div class="clear"></div>
                                            <label class="radio-inline">
                                              <input type="radio" checked="" value="1" name="one_way_or_return">
                                              One Way </label>
                                            <label class="radio-inline">
                                              <input type="radio" value="0" name="one_way_or_return">
                                              Return </label>
                                          </div>
                                        <?php

                                        TextField("Date of Departure", "date_of_deparcher", "", "10","3","form-control date_picker");
                                        TextField("Date of Return", "date_of_return", "", "10","3","form-control date_picker hide");
                                        ?>


                                        

                                          <div class="clear"></div>

                                        <div class="form-group col-lg-6">

                                        <button type="submit" class="btn btn-default m-t-10">Submit</button>

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
        $(document).ready(function() {
            var validate = jQuery('#myForm').validate();
            $("input[name$='one_way_or_return']").click(function() {
                var id = $(this).val();
                if(id == 0)
                    $("#date_of_return").removeClass('hide');
                else
                    $("#date_of_return").addClass('hide');
            });
        });


    </script>



</body>



</html>

