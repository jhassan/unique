<?php include_once('top.php');
		$Where = " bank_id = '1'";
		$strRow = GetRecord("tblbanktext", $Where);
		$bank_accounts_text = $strRow['bank_accounts_text'];?>

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
                    <h1 class="page-header">Bank Accounts Text</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Bank Accounts Text
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form role="form" action="action.php" id="myForm" method="post">
                                    <input type="hidden" name="action" id="action" value="AddBankText" />
						            <input type="hidden" name="ID" id="ID" value="<?php echo $ID; ?>" />
                                        <div class="form-group col-lg-12" style="margin-top:30px;">
										<?php
										echo "<textarea cols='' rows='7' name='bank_text' class='form-control col-lg-6'>$bank_accounts_text</textarea>";
										?>
                                        </div>
                                        <div class="clear"></div>
                                        <div class="form-group col-lg-6">
                                        <button type="submit" id="TextSave" class="btn btn-default m-t-10">Save</button>
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
