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
										echo "<textarea cols='' rows='7' name='bank_text' id='bank_text' class='form-control col-lg-6'>".$bank_accounts_text."</textarea>";
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
    <script>
        // Replace the <textarea id="bank_text"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace( 'bank_text', {
    colorButton_colors: '000,800000,8B4513,2F4F4F,008080,000080,4B0082,696969,B22222,A52A2A,DAA520,006400,40E0D0,0000CD,800080,808080,F00,FF8C00,FFD700,008000,0FF,00F,EE82EE,A9A9A9,FFA07A,FFA500,FFFF00,00FF00,AFEEEE,ADD8E6,DDA0DD,D3D3D3,FFF0F5,FAEBD7,FFFFE0,F0FFF0,F0FFFF,F0F8FF,E6E6FA,FFF',
    colorButton_enableMore: false 
    } );
    </script>
</body>

</html>
