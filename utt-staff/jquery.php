<!-- jQuery -->

    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <script src="../bower_components/jquery/dist/jquery-ui.js"></script>



    <!-- Bootstrap Core JavaScript -->

    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>



    <!-- Metis Menu Plugin JavaScript -->

    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    

    <!-- DataTables JavaScript -->

    <script src="../bower_components/datatables/media/js/jquery.dataTables.min.js"></script>

    <script src="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>



    <!-- Morris Charts JavaScript -->

    <!--<script src="../bower_components/raphael/raphael-min.js"></script>

    <script src="../bower_components/morrisjs/morris.min.js"></script>

    <script src="../js/morris-data.js"></script>-->



    <!-- Custom Theme JavaScript -->
    <audio id="buzzer" src="audio/beep.mp3" type="audio/mp3">Your browser does not support the &#60;audio&#62; element.</audio>
    <script src="../bower_components/js/sb-admin-2.min.js"></script>

    <script src="../bower_components/js/jquery.validate.js"></script>

    <script type="text/javascript">

	$(document).ready(function(e) {
		$.ajaxSetup({ cache: false });
		var buzzer = $('#buzzer')[0];  
		<?php if(!empty($staff_permissions) && in_array('41', $staff_permissions)) { ?>
		// Check ticket unread
		var action = "CheckedUnreadTickets";		
		$.ajax({
		    type : "POST",
		    url: "action.php",
            data: {action: action},
		    success : function(data){
		    	//console.log(data);
		    	if(data > 0)
		    	{
		    		$("#undread_tickets").html('');
                	$("#undread_tickets").html(data);
                	//buzzer.play();    
    				return false;	
		    	}
		    	else
		    	{
		    		$("#undread_tickets").html('');
                	$("#undread_tickets").html(0);
		    	}
		    }
		});
		setInterval(function(){  
		
		var action = "CheckedUnreadTickets";		
		$.ajax({
		    type : "POST",
		    url: "action.php",
            data: {action: action},
		    success : function(data){
		    	//console.log(data);
		    	if(data > 0)
		    	{
		    		$("#undread_tickets").html('');
                	$("#undread_tickets").html(data);
                	buzzer.play();    
    				return false;	
		    	}
		    	else
		    	{
		    		$("#undread_tickets").html('');
                	$("#undread_tickets").html(0);
		    	}
		    }
		});
		},7000);
		<?php } if(!empty($staff_permissions) && in_array('39', $staff_permissions)) { ?>
		// Check payment unread
		var action = "CheckedUnreadPayments";		
		$.ajax({
		    type : "POST",
		    url: "action.php",
            data: {action: action},
		    success : function(data){
		    	//console.log(data);
		    	if(data > 0)
		    	{
		    		$("#undread_payments").html('');
                	$("#undread_payments").html(data);
                	//buzzer.play();    
    				return false;	
		    	}
		    	else
		    	{
		    		$("#undread_payments").html('');
                	$("#undread_payments").html(0);
		    	}
		    }
		});
		setInterval(function(){  
		//var buzzer = $('#buzzer')[0];  
		var action = "CheckedUnreadPayments";		
		$.ajax({
		    type : "POST",
		    url: "action.php",
            data: {action: action},
		    success : function(data){
		    	//console.log(data);
		    	if(data > 0)
		    	{
		    		$("#undread_payments").html('');
                	$("#undread_payments").html(data);
                	buzzer.play();    
    				return false;	
		    	}
		    	else
		    	{
		    		$("#undread_payments").html('');
                	$("#undread_payments").html(0);
		    	}
		    }
		});
		},7000);
		<?php } if(!empty($staff_permissions) && in_array('47', $staff_permissions)) { ?>
		// Check Visa unread
		var action = "CheckedUnreadVisa";		
		$.ajax({
		    type : "POST",
		    url: "action.php",
            data: {action: action},
		    success : function(data){
		    	//console.log(data);
		    	if(data > 0)
		    	{
		    		$("#undread_visa").html('');
                	$("#undread_visa").html(data);
                	//buzzer.play();    
    				return false;	
		    	}
		    	else
		    	{
		    		$("#undread_visa").html('');
                	$("#undread_visa").html(0);
		    	}
		    }
		});
		setInterval(function(){  
		//var buzzer = $('#buzzer')[0];  
		var action = "CheckedUnreadVisa";		
		$.ajax({
		    type : "POST",
		    url: "action.php",
            data: {action: action},
		    success : function(data){
		    	//console.log(data);
		    	if(data > 0)
		    	{
		    		$("#undread_visa").html('');
                	$("#undread_visa").html(data);
                	buzzer.play();    
    				return false;	
		    	}
		    	else
		    	{
		    		$("#undread_visa").html('');
                	$("#undread_visa").html(0);
		    	}
		    }
		});
		},7000);
		<?php } if(!empty($staff_permissions) && in_array('49', $staff_permissions)) { ?>
		// Check Request unread
		var action = "CheckedUnreadRequest";		
		$.ajax({
		    type : "POST",
		    url: "action.php",
            data: {action: action},
		    success : function(data){
		    	//console.log(data);
		    	if(data > 0)
		    	{
		    		$("#undread_request").html('');
                	$("#undread_request").html(data);
                	//buzzer.play();    
    				return false;	
		    	}
		    	else
		    	{
		    		$("#undread_request").html('');
                	$("#undread_request").html(0);
		    	}
		    }
		});
		setInterval(function(){  
		//var buzzer = $('#buzzer')[0];  
		var action = "CheckedUnreadRequest";		
		$.ajax({
		    type : "POST",
		    url: "action.php",
            data: {action: action},
		    success : function(data){
		    	//console.log(data);
		    	if(data > 0)
		    	{
		    		$("#undread_request").html('');
                	$("#undread_request").html(data);
                	buzzer.play();    
    				return false;	
		    	}
		    	else
		    	{
		    		$("#undread_request").html('');
                	$("#undread_request").html(0);
		    	}
		    }
		});
		},7000);
		<?php } ?>
		var dateToday = new Date(); 
		$( ".user_date_picker" ).datepicker({ dateFormat: 'dd-mm-yy' });
    	$( ".date_picker" ).datepicker({ dateFormat: 'yy-mm-dd', minDate: dateToday }).datepicker("setDate",new Date());

		$( ".date_picker_pre" ).datepicker({ dateFormat: 'yy-mm-dd', maxDate: '0' }).datepicker("setDate",new Date()); 

		$( ".date_picker_pre2" ).datepicker({ dateFormat: 'yy-mm-dd', maxDate: '0' }); 



		// Numeric only control handler

		jQuery.fn.ForceNumericOnly =

		function()

		{

			return this.each(function()

			{

				$(this).keydown(function(e)

				{

					var key = e.charCode || e.keyCode || 0;

					// allow backspace, tab, delete, enter, arrows, numbers and keypad numbers ONLY

					// home, end, period, and numpad decimal

					return (

						key == 8 || 

						key == 9 ||

						key == 13 ||

						key == 46 ||

						key == 110 ||

						key == 190 ||

						(key >= 35 && key <= 40) ||

						(key >= 48 && key <= 57) ||

						(key >= 96 && key <= 105));

				});

			});

		};   

		

		// Call Only numbers

		$(".number_only").ForceNumericOnly();

		// Keypress add commas in numbers

		 $('input.number_only').keyup(function(event){

			  // skip for arrow keys

			  if(event.which >= 37 && event.which <= 40){

				  event.preventDefault();

			  }

			  var $this = $(this);

			  var num = $this.val().replace(/,/gi, "").split("").reverse().join("");

			  var num2 = RemoveRougeChar(num.replace(/(.{3})/g,"$1,").split("").reverse().join(""));

			  // the following line has been simplified. Revision history contains original.

			  $this.val(num2);

		  });

		  

		  

		  $(".number_only2").ForceNumericOnly();

		// Keypress add commas in numbers

		 $('input.number_only2').keyup(function(event){

			  // skip for arrow keys

			  if(event.which >= 37 && event.which <= 40){

				  event.preventDefault();

			  }

			  var $this = $(this);

			  var text = $(this).val();

			  if ((text.indexOf('.') != -1) && (text.substring(text.indexOf('.')).length > 2)) {

					event.preventDefault();

				}

			  var num = $this.val().replace(/,/gi, "").split("").reverse().join("");

			  var num2 = RemoveRougeChar(num.replace(/(.{3})/g,"$1").split("").reverse().join(""));

			  // the following line has been simplified. Revision history contains original.

			  $this.val(num2);

		  });

		  

		  $('.number2222').keypress(function (event) {

				var text = $(this).val();

				if ((text.indexOf('.') != -1) && (text.substring(text.indexOf('.')).length > 2)) {

					event.preventDefault();

				}

			});

		  

		  // Add % in lase of the number

		  /*$('.last_char input[type=text]').on('keyup',function(){

            var oldstr=$('.last_char input[type=text]').val();

            var str=oldstr.replace('%',''); 

            $('.last_char input[type=text]').val(str+'%');        

        });*/

		$('.last_char input[type=text]').on('keyup',function(){

			var oldstr=$(this).val();

			var str=oldstr.replace('%',''); 

			$(this).val(str+'%');        

		});

    });

	

	function RemoveRougeChar(convertString)

	{

		if(convertString.substring(0,1) == ",")

		{

			return convertString.substring(1, convertString.length)            

		}

		return convertString;

	}    
	
	function CheckExistFieldName(value,table_name,field_name,label_name)
	{
		$.ajax({
			 url: 'action.php',
			 type: 'GET',
			 data: 'action=CheckValue&value='+value+'&table='+table_name+'&field_name='+field_name ,
			 async: false,
			 cache: false,
			 contentType: 'application/json; charset=utf-8',
			 processData: false,
			 success: function (response) {
				 data = eval('(' + response + ')');
				 if(data['true'] == "ok")
				 {
					alert(label_name+" is already exist please try other!");
					$("#"+field_name).val('');
					 $("#"+field_name).focus();
					 return false;
				 }
			 }
		   });
	}

    </script>

    

    