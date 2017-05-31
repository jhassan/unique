<?php include_once('functions.php'); 
$ID = mysql_real_escape_string($_GET['id']);
$Where = " id = ".(int)$ID."";
$Where = " id = ".(int)$ID."";
$nRecUser = GetRecord('tblissuerefund', $Where);
$ticket_status = $nRecUser['ticket_status'];
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
else if($ticket_status == 7)
    $ticket_status = "Rejected";
else if($ticket_status == 8)
    $ticket_status = "Link Down";
else if($ticket_status == 9)
    $ticket_status = "In Prossess";

$WhereVendor = " vendor_id = ".(int)$nRecUser['vendor_id']."";
$VendorUser = GetRecord('tblvendor', $WhereVendor);  

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Tours View</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Ionicons -->
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css"> -->
  <!-- Theme style -->
  <!-- <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css"> -->

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  

  <style type="text/css" media="print">
@media print {
  
  #printPageButton {
    visibility: hidden;
  }
  body {
  text-transform: uppercase !important;
  font-size: 20px !important;
  }
  .record_div { margin-top: 15px !important; }
  #second_main_div{ float: left !important;}
  .borderless td, .borderless th, .borderless tr {
      border: none !important;
      /*border: 3px red solid !important;*/
  }
  .table-borderless tbody tr td,
  .table-borderless tbody tr th,
  .table-borderless thead tr th,
  .table-borderless thead tr td,
  .table-borderless tfoot tr th,
  .table-borderless tfoot tr td {
      border: none !important;
      /*border-top-color: 3px red solid !important;*/
  }
  .no_border td {
      border-top: none !important;
      /*border-top-color: 3px red solid !important;*/
  }
  .border_bottom td{
    border-bottom: 1px solid red !important;
  }
}
</style>
</head>
<body> <!-- onload="window.print();" -->
<div class="content-wrapper">  
<div class="row">
<button style="width: 60px; margin-left: 150px; margin-top: 10px;" onclick="printDiv2();" id="printPageButton" type="button" class="btn btn-block btn-primary">Print</button>
</div>
<div class="wrapper col-xs-10" id="mainDiv" style="margin-left: 120px;">

  <!-- Main content -->
  <div style="clear: both;"></div>
  
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-sm-12">
        <img src="images/logo/Tourslogo_2_.png" width="300">
        <div class="container">
        <table class="table borderless">
          <thead>
            <tr>
              <th><b class="pull-left">Date: <?php echo date("d/m/Y", strtotime($nRecUser['date'])); ?></b></th>
              <th>Vendor Name</th>
              <th><strong>Franchise Name</strong></th>
            </tr>
          </thead>
          <tbody>
            <tr class="no_border">
              <td class="no_border"><b>Invoice #: <?php echo $nRecUser['id']; ?></td>
              <td class="no_border"><?php echo $VendorUser['vendor_name'];?></td>
              <td class="no_border"><?php echo GetEmployeeName($nRecUser['user_id']); ?></td>
            </tr>
            <tr>
              <td class="no_border"><b>Today Invoice #: <?php echo $nRecUser['today_invoice_id']; ?></b></td>
              <td class="no_border"><b>Created By</b></td>
              <td class="no_border"><strong>Updated by</strong></td>
            </tr>
            <tr>
              <td class="no_border"></td>
              <td class="no_border"><?php echo UserName($nRecUser['user_id']); ?></td>
              <td class="no_border"><?php echo UserName($nRecUser['update_user_id']);?></td>
            </tr>
          </tbody>
        </table>
      </div>
      </div>
      
      <!-- /.col -->
    </div>
    <div style="clear: both;"></div>
    <!-- Table row -->
    <div class="row clear">
      <div class="col-xs-12 table-responsive record_div">
        <table class="table table-striped">
          <thead>
          <tr>
            <th>Date</th>
            <th>Pax Name</th>
            <th>Sector</th>
            <th>PNR</th>
            <th>Air Line</th>
            <th>Mode</th>
            <th>Ticket Status</th>
            <th>Desitnation Code</th>
          </tr>
          </thead>
          <tbody>
          <tr>
            <td><?php echo date("d/m/Y", strtotime($nRecUser['date'])); ?></td>
            <td><?php echo $nRecUser['pax_name']; ?></td>
            <td><?php echo $nRecUser['sector']; ?></td>
            <td><?php echo $nRecUser['pnr']; ?></td>
            <td><?php echo AirLinesName($nRecUser['air_line_id']); ?></td>
            <td><?php echo $arrIssue[$nRecUser['mode_type'] - 1];; ?></td>
            <td><?php echo $ticket_status; ?></td>
            <td><?php echo $nRecUser['air_line_code']; ?></td>
          </tr>
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <div class="row record_div">
        <div class="col-xs-4">
          <div class="table-responsive">
            <table class="table">
              <tr>
                <th style="width:50%">BASIC FARE</th>
                <td><?php echo number_format($nRecUser['basic_fare'],2); ?></td>
              </tr>
              <tr>
                <th>Tax</th>
                <td><?php echo number_format($nRecUser['tax'],2); ?></td>
              </tr>
              <tr>
                <th>TOTAL</th>
                <td><?php echo number_format($nRecUser['actual_fare_total'],2); ?></td>
              </tr>
            </table>
          </div>
        </div>
        <div class="col-xs-4">
          <div class="table-responsive">
            <table class="table">
              <tr>
                <th style="width:50%">CLINT % OR PSF:</th>
                <td><?php echo number_format($nRecUser['clint_psf_percent_value'],2); ?></td>
              </tr>
              <tr>
                <th>REFUND CHARGES</th>
                <td><?php echo number_format($nRecUser['refund_charges'],2); ?></td>
              </tr>
              <tr>
                <th>SERVICE CHARGES</th>
                <td><?php echo number_format($nRecUser['service_charges'],2); ?></td>
              </tr>
              <tr>
                <th>RECEIVABLE CHARGES</th>
                <td><?php echo number_format($nRecUser['amount'],2); ?></td>
              </tr>
            </table>
          </div>
        </div>
        <div class="col-xs-4">
          <div class="table-responsive">
            <table class="table">
              <tr>
                <th style="width:50%">FRANCHISE COMM.</th>
                <td><?php echo number_format($nRecUser['user_commisions'],2); ?></td>
              </tr>
              <tr>
                <th style="width:50%">Credit Limit</th>
                <td><?php echo ClientCreditLimit($nRecUser['user_id']); ?></td>
              </tr>
              <tr>
                <th style="width:50%">Available Balance</th>
                <td><?php echo ClientAvailBalance($nRecUser['user_id']); ?></td>
              </tr>
              <tr>
                <th style="width:50%">ID DATE</th>
                <td><?php
                $row = UserDetails($nRecUser['user_id']);
                if(!empty($row['id_date']) && $row['id_date'] != "0000-00-00") {
                 echo date("d/m/Y", strtotime($row['id_date'])); } ?></td>
              </tr>
              <tr>
                <th style="width:50%">Expire Guarantee</th>
                <td><?php
                $row = UserDetails($nRecUser['user_id']);
                if(!empty($row['expire_guarantee']) && $row['expire_guarantee'] != "0000-00-00") {
                 echo date("d/m/Y", strtotime($row['expire_guarantee'])); } ?></td>
              </tr>
            </table>
          </div>
        </div>

        <!-- /.col -->
      </div>
      <div class="col-xs-12">
        <img src="../images/ticket_print.png" width="100%">
      </div>
    <!-- /.row -->
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
</div>
<!-- ./wrapper -->
<style type="text/css">
body {
  text-transform: uppercase !important;
  }
  .border_bottom td{
    border-bottom: 1px solid red !important;
  }
  .clear { clear: both;}
  .borderless td, .borderless th, .borderless tr {
    border: none !important;
  }
  
</style>
<script type="text/javascript">
function printDiv2() {   
    // 1st
    var printContents = document.getElementById('mainDiv').innerHTML;
    var originalContents = document.body.innerHTML;
     document.body.innerHTML = printContents;
     window.print();
     document.body.innerHTML = originalContents;
  }
</script>



</body>
</html>
