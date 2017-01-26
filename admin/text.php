<?php include_once('top.php');

	$strRow = "";

	if(!empty($_GET['id']))

	{

		$ID = $_GET['id'];

		$Where = "text_id = '".$ID."'";

		$strRow = GetRecord("tbltext", $Where);

		$Status = $strRow['text_status'];

		$Text = $strRow['marque_text'];
		
		$Bold = $strRow['text_bold'];
		
		$Color = $strRow['text_color'];

	}

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

                    <h1 class="page-header">Marquee Text</h1>

                </div>

                <!-- /.col-lg-12 -->

            </div>

            <!-- /.row -->

            <div class="row">

                <div class="col-lg-12">

                    <div class="panel panel-default">

                        <div class="panel-heading">

                            Marquee Text

                        </div>

                        <div class="panel-body">

                            <div class="row">

                                <div class="col-lg-12">

                                    <form role="form" action="action.php" id="myForm" method="post">

                                    <input type="hidden" name="action" id="action" value="AddText" />

						            <input type="hidden" name="ID" id="ID" value="<?php echo $ID; ?>" />

                                        <?php

                                        	TextField("Text", "textname", $Text, "500","6","form-control required");

										?>

                                        <div class="clear"></div>

                                        <div class="form-group m-l-20 m-t-15">
										<?php 
										if($Status == 1)
											$EnDis1 = 'checked=""';
										elseif($Status == 0)
											$EnDis0 = 'checked=""';	
										?>
                                        <label>Enable/Disable</label>
										<?php 
										if(empty($ID))
										{
										?>
                                        <label class="radio-inline">
                                        <input type="radio" value="1" id="optionsRadiosInline1" name="text_status">Enable
                                        </label>
                                        <label class="radio-inline">
                                        <input type="radio" value="0" id="optionsRadiosInline2" name="text_status">Disable
                                        </label>
                                         <?php } else { ?>   
                                         <label class="radio-inline">
                                        <input type="radio" value="1" <?php echo $EnDis1;?> id="optionsRadiosInline1" name="text_status">Enable
                                        </label>
                                        <label class="radio-inline">
                                        <input type="radio" value="0" <?php echo $EnDis0;?> id="optionsRadiosInline2" name="text_status">Disable
                                        </label>
                                        <?php } ?>
                                         

                                        </div>
                                        
                                        <div class="form-group m-l-20 m-t-15">

                                        <label>Select Color</label>
										<?php 
										if($Color == 1)
											$EnDisColor1 = 'checked=""';
										elseif($Color == 2)
											$EnDisColor2 = 'checked=""';
										elseif($Color == 3)
											$EnDisColor3 = 'checked=""';		
										?>
										<?php 
										if(empty($ID))
										{
										?>
                                       <label class="radio-inline">
                                      <input type="radio" checked="" value="1" id="optionsRadiosInline3" name="text_color">Black
                                        </label>
                                        <label class="radio-inline">
                                        <input type="radio" value="2" id="optionsRadiosInline4" name="text_color">Blue
                                        </label>
                                        <label class="radio-inline">
                                        <input type="radio" value="3" id="optionsRadiosInline5" name="text_color">Red
                                        </label>
										<?php } else { ?>
                                        <label class="radio-inline">
                                      <input type="radio" <?php echo $EnDisColor1;?> value="1" id="optionsRadiosInline3" name="text_color">Black
                                        </label>
                                        <label class="radio-inline">
                                        <input type="radio" <?php echo $EnDisColor2;?> value="2" id="optionsRadiosInline4" name="text_color">Blue
                                        </label>
                                        <label class="radio-inline">
                                        <input type="radio" <?php echo $EnDisColor3;?>  value="3" id="optionsRadiosInline5" name="text_color">Red
                                        </label>
                                        <?php } ?>
                                            

                                        </div>
                                        
                                        
                                        
                                        <div class="checkbox m-l-20">
                                                <label>
                                                	<?php 
													if($Bold == 1)
														$selctedBold = "checked";
														if(empty($ID))
														{
														?>
                                                    <input type="checkbox" name="text_bold" value="">Bold Text
                                                    <?php } else { ?>
                                                    <input type="checkbox" <?php echo $selctedBold; ?> name="text_bold" value="">Bold Text
                                                    <?php } ?>
                                                </label>
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

