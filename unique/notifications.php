<?php include_once('top.php');

	// $strRow = "";

	// $whereNotes = " user_id = ".$_SESSION['client_id'];
	// $GetRecordNotes = GetRecord("tblnotification", $whereNotes);
	// $notes = $GetRecordNotes['notes'];

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

                    <h1 class="page-header hide">Notifications</h1>

                </div>

                <!-- /.col-lg-12 -->

            </div>

            <!-- /.row -->

            <div class="row" style="margin-top:25px;">

                <div class="col-lg-12">

                    <div class="panel panel-default">
                        <div class="panel-heading">

                            Notifications

                        </div>

                        <div class="panel-body">

                            <div class="row">

                                <div class="col-lg-12">
                                <?php
                                    $SQL = "SELECT * FROM tblnotification WHERE text_status = 1 ORDER BY `date` DESC";            
                                     $result = MySQLQuery($SQL);
                                     while($row = mysql_fetch_array($result)) { // ,MYSQL_ASSOC
                                     $text_color = $row['text_color'];
                                     $text_bold  = $row['text_bold'];
                                     if($text_color == 1)
                                        $text_color = "#000";
                                     elseif($text_color == 2)
                                        $text_color = "blue";
                                     elseif($text_color == 3)
                                        $text_color = "red";
                                     if($text_bold == 1)
                                        $text_bold = "bold";
                                ?>    
								<div class="form-group m-10">
                                    <h3 style="color: <?php echo $text_color; ?>; font-weight: <?php echo $text_bold; ?>"><?php echo $row['marque_text']; ?></h3>
                                    <h5>Date:<?php echo date("d-m-Y", strtotime($row['date'])); ?></h5>
                                    <img src="images/notification_images/<?php echo $row['text_image']; ?>" class="img-thumbnail" alt="Images">   
                                </div>
                                <?php } ?>

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

