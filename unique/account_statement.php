<?php include_once('top.php');?>
<?php
$OP_Balance = 0;
$user_type = $_SESSION['user_type'];
if($user_type == 0)
    $front_client_id = $_SESSION['client_id'];
else if($user_type == 3)
    $front_client_id = $_GET['user_id'];
else if(isset($_GET['admin_user_id']) && !empty($_GET['admin_user_id']))
    $front_client_id = $_GET['admin_user_id'];       
$Where = "user_id = '".(int)$front_client_id."'";
$nRecUser = GetRecord('tbluser', $Where);
$OP_Balance = $nRecUser['opening_balance'];
$franchize_user_permissions = $_SESSION['franchize_user_permissions'];
?>
<?php
if(!empty($_SESSION["staff_permissions"]))
{
  $staff_permissions = $_SESSION["staff_permissions"];
  $staff_permissions = explode(',',$staff_permissions);
} 
else
{
    $staff_permissions = "";   
}
// if(empty($_GET['search_date']))
//     $current_date = date("Y-m-d");
// else
//     $current_date = $_GET['search_date'];
?>
<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <?php include_once('header.php');?>    

        <?php 
        if(empty($_GET['admin_user_id']))
            include_once('leftsidebar.php');
        ?>     
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Account Statement</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            
            <form action="" method="get" id="myForm">
            <?php if($user_type == 3) { ?>    
            <div class="form-group col-lg-4 m-t-10 p-l-0">
                <label>Select Client</label>
                <select name="user_id" id="user_id" class="form-control" style="">
                    <option value="">Select Client</option>
                    <?php
                    $SQL = "SELECT user_id, user_name FROM tbluser WHERE (user_type = '0' || user_type = '3') AND user_status = '1' ORDER BY user_name";            
                     $result = MySQLQuery($SQL);
                     $air_line_id = "";
                     while($row = mysql_fetch_array($result)) { // ,MYSQL_ASSOC
                    if( !empty($front_client_id) && $row['user_id'] == $front_client_id ) 
                        $selected = "selected='selected'";
                    else
                        $selected = "";
                    ?>
                    <?php 
                      if(!empty($franchize_user_permissions))
                      {
                        $array_permission = explode(',',$franchize_user_permissions);
                        if (in_array($row['user_id'], $array_permission)) { ?>
                          <option value="<?php echo $row['user_id']?>" <?php echo $selected; ?>><?php echo $row['user_name']?></option>
                    <?php } } } ?>
                </select>
            </div>
            <?php } ?>
            <?php //TextField("Select Date", "search_date", $current_date, "10","3","form-control date_picker_pre2 m-t-10"); ?>
            <div class="clear"></div>
            </form>
            
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel-body" style="padding: 0px; margin-top: 5px;">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Opening Balance</th>
                                            <th class="text-center">Total Invoices</th>
                                            <th class="text-center">Total Refund and Void</th>
                                            <th class="text-center">Receive Payment</th>
                                            <th class="text-center">Available Balance</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="odd gradeX">
                                            <td class="text-center bld"><?php echo number_format($OP_Balance,2); ?></td>
                                            <td id="total_invoice" class="text-center bld">0.00</td>
                                            <td id="total_refund_or_void" class="text-center bld">0.00</td>
                                            <td id="receive_payment" class="text-center bld">0.00</td>
                                            <td id="available_balance" class="text-center bld">0.00</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                            
                        </div>

                    <!-- Tickets Status (Ticketed) -->
                    <div class="panel panel-default">
                        <div class="panel-heading bld">
                             Issued Tickets
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>ASI #</th>
                                            <th>Invoice #</th>
                                            <th>Pax Name</th>
                                            <th>PNR</th>
                                            <th>Air line</th>
                                            <!-- <th>Mode</th> -->
                                            <th>User Name</th>
                                            <th>Ticket Status</th>
                                            <?php
                                            if(!empty($staff_permissions) && in_array('62', $staff_permissions))
                                            {
                                            ?>
                                            <th>Commission</th>
                                            <?php } ?>
                                            <th class="text-center">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $GrandTotalInvoices = 0;
                                        $SQL = "SELECT * FROM tblissuerefund WHERE user_id = ".(int)$front_client_id." AND (ticket_status = 2 OR ticket_status = 6) ORDER BY id ASC";         
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
                                            else if($ticket_status == 5)
                                                $ticket_status = "PNR Expired";
                                            else if($ticket_status == 6)
                                                $ticket_status = "Reissued";
                                            $GrandTotalInvoices += $row['amount'];
                                            $user_commisions = number_format($row['user_commisions'],0);
                                    ?>
                                        <tr class="odd gradeX">
                                            <td class="left"><?php echo date("d-M-y", strtotime($row['date']));?></td>
                                            <td align="center"><?php echo $row['asi_no'];?></td>
                                            <td align="center"><?php echo $row['id'];?></td>
                                            <td class="left"><?php echo $row['pax_name'];?></td>
                                            <td class="left" id="PNR_<?php echo $row['id'];?>"><?php echo $row['pnr'];?></td>
                                            <td class="left"><?php echo AirLinesName($row['air_line_id']);?></td>
                                            <!-- <td class="left"><?php echo $arrIssue[$row['mode_type'] - 1];?></td> -->
                                            <td class="left"><?php echo UserName($row['user_id']);?></td>
                                            <td class="left" style="padding-top: 0;padding-bottom: 0;"><?php echo $ticket_status; ?></td>
                                            <?php
                                            if(!empty($staff_permissions) && in_array('62', $staff_permissions))
                                            {
                                            ?>
                                            <td class="text-right"><?php echo number_format($user_commisions,2); ?></td>
                                            <?php } ?>
                                            <td class="text-right"><?php echo number_format($row['amount'],2);?></td>
                                            
                                        </tr>
                                    <?php } ?>  
                                        <tr class="odd gradeX">
                                            <td colspan="11" class="left bld text-right"><?php echo number_format($GrandTotalInvoices,2); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                            
                        </div>
                        <!-- /.panel-body -->
                    </div>
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
                                            <th>ASI #</th>
                                            <th>Invoice #</th>
                                            <th>Pax Name</th>
                                            <!-- <th>Sector</th> -->
                                            <th>PNR</th>
                                            <th>Air line</th>
                                            <!-- <th>Mode</th> -->
                                            <th>User Name</th>
                                            <th>Ticket Status</th>
                                            <?php
                                            if(!empty($staff_permissions) && in_array('62', $staff_permissions))
                                            {
                                            ?>
                                            <th>Commission</th>
                                            <?php } ?>
                                            <th class="text-center">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $GrandTotalRefundVoid = 0;
                                        $SQL = "";
                                        $SQL = "SELECT * FROM tblissuerefund WHERE user_id = ".(int)$front_client_id." AND (ticket_status = 3 OR ticket_status = 4) ORDER BY id ASC";         
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
                                            <td class="left"><?php echo date("d-M-y", strtotime($row['date']));?></td>
                                            <td align="center"><?php echo $row['asi_no'];?></td>
                                            <td align="center"><?php echo $row['id'];?></td>
                                            <td class="left"><?php echo $row['pax_name'];?></td>
                                            <!-- <td class="left"><?php echo $row['sector'];?></td> -->
                                            <td class="left" id="PNR_<?php echo $row['id'];?>"><?php echo $row['pnr'];?></td>
                                            <td class="left"><?php echo AirLinesName($row['air_line_id']);?></td>
                                            <!-- <td class="left"><?php echo $arrIssue[$row['mode_type'] - 1];?></td> -->
                                            <td class="left"><?php echo UserName($row['user_id']);?></td>
                                            <td class="left" style="padding-top: 0;padding-bottom: 0;"><?php echo $ticket_status; ?></td>
                                            <?php
                                            if(!empty($staff_permissions) && in_array('62', $staff_permissions))
                                            {
                                            ?>
                                            <td class="text-right"><?php echo number_format($user_commisions,2); ?></td>
                                            <?php } ?>
                                            <td class="text-right"><?php echo number_format($row['amount'],2);?></td>
                                        </tr>
                                    <?php } ?>  
                                        <tr class="odd gradeX">
                                            <td colspan="11" class="left bld text-right"><?php echo number_format($GrandTotalRefundVoid,2); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                            
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- Payment Status (Aproved) -->
                    <div class="panel panel-default">
                        <div class="panel-heading bld">
                            Aproved Payment
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>ASI #</th>
                                            <th>Invoice #</th>
                                            <th>TransductionID</th>
                                            <th>Bank</th>
                                            <th>User Name</th>
                                            <th>Payment Status</th>
                                            <th class="left text-right">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $TotalBalancePayment = 0;
                                        $SQL = "";
                                        $SQL = "SELECT * FROM tblepayment WHERE user_id = ".(int)$front_client_id." AND payment_status = 2 ORDER BY id ASC";            
                                         $result = MySQLQuery($SQL);
                                         while($row = mysql_fetch_array($result)) { // ,MYSQL_ASSOC
                                            $payment_status = $row['payment_status'];
                                            $inprocess_selected = "";
                                            $aproved_selected = "";
                                            $rejected_selected = "";
                                            if($payment_status == 1)
                                                $payment_status = "In Process";
                                            else if($payment_status == 2)
                                                $payment_status = "Approved";
                                            else if($payment_status == 3)
                                                $payment_status = "Rejected";
                                            $TotalBalancePayment += $row['amount'];
                                    ?>
                                        <tr class="odd gradeX">
                                            <td class="left"><?php echo date("d-M-y", strtotime($row['date']));?></td>
                                            <td align="center"><?php echo $row['asi_no'];?></td>
                                            <td align="center"><?php echo $row['id'];?></td>
                                            <td class="left"><?php echo $row['transection_id'];?></td>
                                            <td class="left"><?php echo $arrBank[$row['bank_id'] - 1];?></td>
                                            <td class="left"><?php echo UserName($row['user_id']);?></td>
                                            <td class="left"><?php echo $payment_status; ?></td>
                                            <td class="left text-right"><?php echo number_format($row['amount'],2);?></td>
                                        </tr>
                                    <?php } ?>  
                                           <tr class="odd gradeX">
                                            <td colspan="9" class="left bld text-right"><?php echo number_format($TotalBalancePayment,2); ?></td>
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
   <?php if(empty($_GET['admin_user_id'])) { ?>
    <input type="hidden" id="client_id" value="<?php echo $_SESSION['client_id']; ?>" />
    <?php } else { ?>
    <input type="hidden" id="client_id" value="<?php echo $_GET['admin_user_id']; ?>" />
    <?php } ?>
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
		if(isNaN(available_balance))
            available_balance = 0;
        $("#available_balance").html(addCommas(available_balance)+".00");

        // Update Available Balance
        var client_id = $("#client_id").val();
        var current_available_balance = available_balance;
        var action = "UpdateAvailableBalance";
            jQuery.ajax({
                type: "POST",
                url: "action.php",
                data: {client_id: client_id, action: action, current_available_balance: current_available_balance},
                cache: false,
                success: function(response)
                {
                    console.log(response); return false;
                    $("#message_status").html('');
                    $("#message_status").html('Now this PNR '+PNR+' Ticket status is '+selected_text+'!');
                    $("#message_status").removeClass('hide');
                }
            });

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
