<?php include_once('top.php');

	$strRow = "";

	if(!empty($_GET['id']))

	{

		$ID = $_GET['id'];

		$Where = "air_line_id = '".$ID."'";

		$strRow = GetRecord("tblairlines", $Where);

		$Name = $strRow['air_line_name'];

		$Code = $strRow['air_line_code'];

		$Image = $strRow['air_line_image'];

        $url_status = $strRow['url_status'];

        $air_line_url = $strRow['air_line_url'];

        // if($url_status == 1)
        // {
        //     $checked1 = 'checked="checked"';
        //     $checked2 = '';
        // }
        // else
        // {
        //     $checked2 = 'checked="checked"';
        //     $checked1 = '';
        // }
            
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

                    <h1 class="page-header">Air Lines</h1>

                </div>

                <!-- /.col-lg-12 -->

            </div>

            <!-- /.row -->

            <div class="row">

                <div class="col-lg-12">

                    <div class="panel panel-default">

                        <div class="panel-heading">

                            Air Lines

                        </div>

                        <div class="panel-body">

                            <div class="row">

                                <div class="col-lg-12">

                                    <form role="form" action="" id="myForm" method="post" enctype="multipart/form-data">

                                    <input type="hidden" name="action" id="action" value="AddAirLines" />

						            <input type="hidden" name="ID" id="ID" value="<?php echo $ID; ?>" />

                                        <?php

										if(isset($_POST['air_line_name']))

											$Name = $_POST['air_line_name'];

										else

											$Name = $Name;

                                        TextField("Name", "air_line_name", $Name, "20","6","form-control required");

										TextField("Air Line Code", "air_line_code", $Code, "3","6","form-control required","","onBlur='CheckExistFieldName(this.value,\"tblairlines\",\"air_line_code\",\"Air Line Code\");'");

										?>

                                        <div class="clear"></div>
                                        <div class="form-group col-lg-12 hide" style="margin-top:30px;">
                                        <label>Seelct URL</label>
                                        <label class="radio-inline">
                                          <input type="radio" <?php echo $checked1; ?> id="fixed_url" value="1" name="url_status">
                                          Fixed URL </label>
                                        <label class="radio-inline">
                                          <input type="radio" <?php echo $checked2; ?> value="2" name="url_status">
                                          Variable URL </label>
                                      </div>
                                      <div class="clear"></div>
                                      <div class="form-group m-b-0 col-lg-6 hide" id="url_input_div">
                                        <label>URL</label>
                                        <input type="text" class="form-control required" placeholder="URL" name="air_line_url" id="air_line_url" value=" <?php echo $air_line_url; ?>" maxlength="">
                                    </div>
                                      <div class="clear"></div>
                                        <div class="form-group m-r-15 m-t-10 col-lg-6 p-l-0">

                                            <label>Upload Air Line Image</label>

                                            <input type="file" name="fileToUpload" id="fileToUpload" class="required">

                                        </div>
                                        
                                        <div class="form-group col-lg-4 m-t-10">

                                        	<?php if(!empty($ID)) { ?>

                                            <img src="images/air_lines/<?php echo $Image;?>" height="25" width="70" alt="Air Line">

                                            <?php } ?>

                                        </div>

                                        <div class="clear"></div>

                                        <div class="form-group col-lg-6">

                                        <button type="submit" id="AirLineSave" class="btn btn-default m-t-10">Save</button>

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
        var fixed_url = $("#fixed_url").val();
        if(fixed_url == 1)
            $("#url_input_div").removeClass('hide');
        else
            $("#url_input_div").addClass('hide');       
        //$("div.desc").hide();
        $("input:radio[name='url_status']").click(function() {
            var test = $(this).val();
            //alert(test);
            if(test == 1)
                $("#url_input_div").removeClass('hide');
            else
            {
                $("#url_input_div").addClass('hide');
                $("#air_line_url").val('');
            }
                   
        });
    });

	jQuery(function (){

		//var validate = jQuery('#myForm').validate();

		//alert(validate); return false;

		//jQuery('#myForm').validate(); 

		 $("#myForm").submit(function(evt){	 

		   evt.preventDefault();

		

		   var formData = new FormData($(this)[0]); 

		

		   $.ajax({

			 url: 'action.php',

			 type: 'POST',

			 data: formData,

			 async: false,

			 cache: false,

			 contentType: false,

			 enctype: 'multipart/form-data',

			 processData: false,

			 success: function (response) {
                //alert(response);
                var obj = eval( "(" + response + ")" ) ;
				 if(obj == 3)

				 {

					 window.location.href="view_air_lines"; 

					 return true;

				 }

				else

				{

					//alert(response);

					return false;

				}

			 }

		   });

		

		   return false;

 });

		

		

		

		

		

		

	});

    </script>



</body>



</html>

