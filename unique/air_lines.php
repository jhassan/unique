<?php include_once('top.php');

	$ID = mysql_real_escape_string($_GET['id']);

	$Where = " user_air_line_id = ".(int)$ID."";

	$nRecUser = GetRecord('tbluserairlines', $Where);

	$Url = $nRecUser['user_url'];

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

                <div class="col-lg-12 hide">

                    <h1 class="page-header">Air Lines</h1>

                </div>

                <!-- /.col-lg-12 -->

            </div>

            <!-- /.row -->

            <div class="row" style="margin-top:25px;">

                <div class="col-lg-12">

                    <div class="panel panel-default">

                        <div class="panel-heading hide">

                            Air Lines

                        </div>

                        <div class="panel-body m-t-10 p-r-0">

                            <iframe width="800" height="600" scrolling="yes" frameborder="0" src=<?php echo $Url;?>></iframe>

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

		//jQuery('#myForm').validate();

	});

    </script>



</body>



</html>

