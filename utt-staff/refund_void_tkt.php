<?php include_once('top.php');?>
<?php
$user_id = $_GET['user_id'];
$Where = "user_id = '".(int)$user_id."'";
$nRecUser = GetRecord('tbluser', $Where);
if(empty($_GET['start_date']))
    $start_date = date("Y-m-d");
else
    $start_date = $_GET['start_date'];

if(empty($_GET['end_date']))
    $end_date = date("Y-m-d");
else
    $end_date = date('Y-m-d', strtotime($_GET['end_date'] . ' +1 day'));
if(!empty($_GET['end_date']))
    $end_date1 = date('Y-m-d', strtotime($_GET['end_date']));
else
    $end_date1 = date('Y-m-d');
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
                    <h1 class="page-header" id="title_account_statement"><?php if(!empty($user_id)) echo "Refund/Void TKT: ". UserName($user_id); else echo "Refund/Void TKT";  ?></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <form action="" method="get" id="myForm">
            <?php TextField("Start Date", "start_date", $start_date, "10","3","form-control date_picker_pre2 m-t-10"); ?>
            <?php TextField("End Date", "end_date", $end_date1, "10","3","form-control date_picker_pre2 m-t-10"); ?>                    
            <div class="form-group col-lg-4 m-t-10 p-l-0">
                <label>Select Client</label>
                <select name="user_id" id="user_id" class="form-control" style="">
                    <option value="">Select Client</option>
                    <?php
                    $SQL = "SELECT user_id, user_name FROM tbluser WHERE (user_type = '0' || user_type = '3') AND user_status = '1' ORDER BY user_name";            
                     $result = MySQLQuery($SQL);
                     $air_line_id = "";
                     while($row = mysql_fetch_array($result)) { // ,MYSQL_ASSOC
                    if( !empty($user_id) && $row['user_id'] == $user_id ) 
                        $selected = "selected='selected'";
                    else
                        $selected = "";
                    ?>
                    <option value="<?php echo $row['user_id']?>" <?php echo $selected; ?>><?php echo $row['user_name']?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-lg-2" style="margin-top: 34px;">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
            </form>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <!-- Tickets Status (Refund or Void) -->
                    <div class="panel panel-default">
                        <div class="panel-heading bld">
                            Refund or void Tickets
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Pax Name</th>
                                            <th>Sector</th>
                                            <th>PNR</th>
                                            <th>Air line</th>
                                            <th>Mode</th>
                                            <th>User Name</th>
                                            <th>Ticket Status</th>
                                            <th class="text-center">Amount</th>
                                            <th>Commission</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $GrandTotalRefundVoid = 0;
                                        $SQL = "";
                                        $SQL = "SELECT * FROM tblissuerefund WHERE user_id = ".(int)$user_id." 
                                        AND (ticket_status = 3 OR ticket_status = 4) 
                                        AND (`date` BETWEEN '".$start_date."' AND '".$end_date."') 
                                        ORDER BY id ASC";         
                                         $result = MySQLQuery($SQL);
                                         while($row = mysql_fetch_array($result)) { // ,MYSQL_ASSOC
                                            $ticket_status = $row['ticket_status'];
                                            $inprocess_selected = "";
                                            $aproved_selected = "";
                                            $rejected_selected = "";
                                            if($ticket_status == 1)
                                                $ticket_status = "Prossess";
                                            else if($ticket_status == 2)
                                                $ticket_status = "Ticketed";
                                            else if($ticket_status == 3)
                                                $ticket_status = "Void";
                                            else if($ticket_status == 4)
                                                $ticket_status = "Refund";
                                            $GrandTotalRefundVoid += $row['amount'];
                                            $user_commisions = number_format($row['user_commisions'],0);
                                    ?>
                                        <tr class="odd gradeX">
                                            <td class="left"><?php echo date("d/m/Y", strtotime($row['date']));?></td>
                                            <td class="left"><?php echo $row['pax_name'];?></td>
                                            <td class="left"><?php echo $row['sector'];?></td>
                                            <td class="left" id="PNR_<?php echo $row['id'];?>"><?php echo $row['pnr'];?></td>
                                            <td class="left"><?php echo AirLinesName($row['air_line_id']);?></td>
                                            <td class="left"><?php echo $arrIssue[$row['mode_type'] - 1];?></td>
                                            <td class="left"><?php echo UserName($row['user_id']);?></td>
                                            <td class="left" style="padding-top: 0;padding-bottom: 0;"><?php echo $ticket_status; ?></td>
                                            <td class="text-right"><?php echo number_format($row['amount'],2);?></td>
                                            <td class="text-right"><?php echo $user_commisions; ?></td>
                                        </tr>
                                    <?php } ?>  
                                        <tr class="odd gradeX">
                                            <td colspan="9" class="left bld text-right"><?php echo number_format($GrandTotalRefundVoid,2); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                            
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
            <!-- /.row -->
            
            <!-- /.row -->
            
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
	<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                
                <div class="modal-body">Do you want to delete this record?</div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" id="DeleteRecord">Delete</button>
                    <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
   <input type="hidden" id="hd_opening_balance" value="<?php echo $OP_Balance; ?>" />
   <input type="hidden" id="hd_total_invoice" value=" <?php echo $GrandTotalInvoices; ?> " />
   <input type="hidden" id="hd_total_refund_or_void" value="<?php echo $GrandTotalRefundVoid; ?>" />
   <input type="hidden" id="hd_receive_payment" value="<?php echo $TotalBalancePayment; ?>" />
   <input type="hidden" id="client_id" value="<?php echo $_SESSION['client_id']; ?>" />
    <?php include_once('jquery.php');?>
    
    
    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });

        $("#user_id").on("change", function() {
            $("#myForm").submit();
        });

        // $("#search_date").on("change", function() {
        //     $("#myForm").submit();
        // });


		// Get Delete Record ID
		jQuery(document).on('click','.clsDelete',function(e){
			var DelID = jQuery(this).attr("id");
			$("#currentID").val(DelID);
		});	

        var available_balance = 0;
        var hd_opening_balance = 0;
        var hd_total_invoice = 0;
        var hd_total_refund_or_void = 0;
        var hd_receive_payment = 0;

        // Show all Total
        var hd_opening_balance = $("#hd_opening_balance").val();
        $("#opening_balance").html(hd_opening_balance);

        var hd_total_invoice = $("#hd_total_invoice").val();
        $("#total_invoice").html(addCommas(hd_total_invoice)+".00");

        var hd_total_refund_or_void = $("#hd_total_refund_or_void").val();
        $("#total_refund_or_void").html(addCommas(hd_total_refund_or_void)+".00");

        var hd_receive_payment = $("#hd_receive_payment").val();
        $("#receive_payment").html(addCommas(hd_receive_payment)+".00");

        available_balance = (parseInt(hd_opening_balance) + parseInt(hd_total_invoice)) - (parseInt(hd_total_refund_or_void) + parseInt(hd_receive_payment));
        //console.log(available_balance);
        if(isNaN(available_balance))
		  $("#available_balance").html('0.00');
        else
          $("#available_balance").html(addCommas(available_balance)+".00");  

        // Update Available Balance
        // var client_id = $("#client_id").val();
        // var current_available_balance = available_balance;
        // var action = "UpdateAvailableBalance";
        //     jQuery.ajax({
        //         type: "POST",
        //         url: "action.php",
        //         data: {client_id: client_id, action: action, current_available_balance: current_available_balance},
        //         cache: false,
        //         success: function(response)
        //         {
        //             console.log(response); return false;
        //             $("#message_status").html('');
        //             $("#message_status").html('Now this PNR '+PNR+' Ticket status is '+selected_text+'!');
        //             $("#message_status").removeClass('hide');
        //         }
        //     });

		// Update payment status
        jQuery(document).on('change','.get_payment_status',function(e){
            var current_id = $(this).attr('id');
            var selected_value = $(this).val();
            var PNR = $("#PNR_"+current_id).html();
            var selected_text = "";
            if(selected_value == 1)
                selected_text = "Prossess";
            else if(selected_value == 2)
                selected_text = "Ticketed";
            else if(selected_value == 3)
                selected_text = "Void";
            else if(selected_value == 4)
                selected_text = "Refund";
            var action = "UpdateTicketStatus";
            jQuery.ajax({
                type: "POST",
                url: "action.php",
                data: {current_id: current_id, action: action, selected_value: selected_value},
                cache: false,
                success: function(response)
                {
                    $("#message_status").html('');
                    $("#message_status").html('Now this PNR '+PNR+' Ticket status is '+selected_text+'!');
                    $("#message_status").removeClass('hide');
                }
            });
        });
    });
    function addCommas(nStr)
    {
        nStr += '';
        x = nStr.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
        }
        return x1 + x2;
    }
    </script>

</body>

</html>
