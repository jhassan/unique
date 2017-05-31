<?php include_once('top.php');?>
<?php
$user_type = $_SESSION['user_type'];
if($user_type == 0)
    $front_client_id = $_SESSION['client_id'];
else if($user_type == 3)
    $front_client_id = $_GET['user_id'];   
$Where = "user_id = '".(int)$front_client_id."'";
$nRecUser = GetRecord('tbluser', $Where);
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
                    <h1 class="page-header">PAYMENTS RCV</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            
            <form action="" method="get" id="myForm">
            <?php TextField("Start Date", "start_date", $start_date, "10","3","form-control date_picker_pre2 m-t-10"); ?>
            <?php TextField("End Date", "end_date", $end_date1, "10","3","form-control date_picker_pre2 m-t-10"); ?>                            
            <?php if($user_type == 3) { ?>    
            <div class="form-group col-lg-4 m-t-10 p-l-0">
                <label>Select Client</label>
                <select name="user_id" id="user_id" class="form-control" style="">
                    <option value="">Select Client</option>
                    <?php
                    $SQL = "SELECT user_id, user_name FROM tbluser WHERE user_type = '0' AND user_status = '1' ORDER BY user_name";            
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
            <div class="col-lg-2" style="margin-top: 34px;">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
            <div class="clear"></div>
            </form>
            
            <!-- /.row -->
            <div class="row" style="margin-top: 25px;">
                <div class="col-lg-12">
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
                                        $SQL = "SELECT * FROM tblepayment 
                                        WHERE user_id = ".(int)$front_client_id." 
                                        AND payment_status = 2 
                                        AND (`date` BETWEEN '".$start_date."' AND '".$end_date."') 
                                        ORDER BY id ASC";            
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
        </div>
        <!-- /#page-wrapper -->

    </div>
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
		// Get Delete Record ID
		jQuery(document).on('click','.clsDelete',function(e){
			var DelID = jQuery(this).attr("id");
			$("#currentID").val(DelID);
		});	
    });
</script>
</body>
</html>
