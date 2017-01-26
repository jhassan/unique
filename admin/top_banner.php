<?php include_once('top.php');



	$strRow = "";



	if(!empty($_GET['id']))



	{



		$ID = $_GET['id'];



		$Where = "banner_id = '".$ID."'";



		$strRow = GetRecord("tbltopbanner", $Where);



		$Status = $strRow['banner_status'];



		$Image = $strRow['banner_image'];



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



                    <h1 class="page-header">Top Banner</h1>



                </div>



                <!-- /.col-lg-12 -->



            </div>



            <!-- /.row -->



            <div class="row">



                <div class="col-lg-12">



                    <div class="panel panel-default">



                        <div class="panel-heading">



                            Top Banner



                        </div>



                        <div class="panel-body">



                            <div class="row">



                                <div class="col-lg-12">



                                    <form role="form" action="" id="myForm" method="post" enctype="multipart/form-data">



                                    <input type="hidden" name="action" id="action" value="AddTopBanner" />



						            <input type="hidden" name="ID" id="ID" value="<?php echo $ID; ?>" />



                                        <div class="form-group m-r-15 m-t-10 col-lg-6">



                                            <label>Upload Banner</label>



                                            <input type="file" name="fileToUpload" id="fileToUpload" class="required">



                                        </div>



                                        <div class="form-group col-lg-4 m-t-10">



                                        	<?php if(!empty($ID)) { ?>



                                            <img src="images/top_banners/<?php echo $Image;?>" height="25" width="70" alt="Air Line">



                                            <?php } ?>



                                        </div>



                                        <div class="clear"></div>



                                        <div class="form-group m-l-20 m-t-15">



                                        <label>Enable/Disable</label>



                                        <label class="radio-inline">



                                            <input type="radio" checked="" value="1" id="optionsRadiosInline1" name="banner_status">Enable



                                        </label>



                                        <label class="radio-inline">



                                            <input type="radio" value="0" id="optionsRadiosInline2" name="banner_status">Disable



                                        </label>



                                            



                                        </div>



                                        <div class="clear"></div>



                                        <div class="form-group col-lg-6">



                                        <button type="submit" id="BannerSave" class="btn btn-default m-t-10">Save</button>



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



				 if(response == "upload")



				 {



					 window.location.href="/admin/view_top_banner"; 



					 return true;



				 }



				else



				{



					alert(response);



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



