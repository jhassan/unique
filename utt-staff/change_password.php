<?php include_once('top.php');
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
                    <h1 class="page-header">Change Password</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">

                    <?php if($_GET['msg'] == "true") {?>

					<div class="alert alert-success">Password change successfully!</div>

                    <?php } elseif($_GET['msg'] == "false") {  ?>

					<div class="alert alert-success">Password not change please enter correct old password!</div>	

					<?php } ?>	

                        <div class="panel-heading">
                            Change Password
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form role="form" action="action.php" id="myForm" method="post">
                                    <input type="hidden" name="action" id="action" value="ChangePassword" />
                                        <?php
                                        TextField("Old Password", "old_password", "", "20","6","form-control","Pass");
										echo "<div class='clear'></div>";
										TextField("New Password", "new_password", "", "20","6","form-control","pass");
										TextField("Confirm Password", "confirm_password", "", "20","6","form-control","pass");
										?>
                                        <div class="clear"></div>
                                        <div class="form-group col-lg-6">
                                        <button type="submit" class="btn btn-default m-t-10">Save</button>
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

    <?php include_once('jquery.php');?>
    <script type="text/javascript">
	jQuery(function (){
		//var validate = jQuery('#myForm').validate();
		/*jQuery.validator.setDefaults({
		  debug: true,
		  success: "valid"
		});
		$( "#myform" ).validate({
		  rules: {
			password: "required",
			password_again: {
			  equalTo: "#password"
			}
		  }
		});*/
		$("#myForm").validate({
			rules: {
				old_password: {
					required: true
				},
				new_password: {
					required: true,
					minlength: 6
				},
				confirm_password: {
					required: true,
					equalTo: "#new_password"
				},
			},
			messages: {
				old_password: {
					required: "required"
				},
				new_password: {
					required: "required",
					minlength: "Password is 6 character"
				},
				confirm_password: {
					required: "required",
					equalTo: "Equal to new password!"
				},
			}
		});

		
	});
    </script>

</body>

</html>
