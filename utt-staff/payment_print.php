<?php include_once('functions.php'); 
$ID = mysql_real_escape_string($_GET['id']);
$Where = " id = ".(int)$ID."";
$nRecUser = GetRecord('tblepayment', $Where);
$payment_status = $nRecUser['payment_status'];
if($payment_status == 1)
    $payment_status = "In Process";
else if($payment_status == 2)
    $payment_status = "Approved";
else if($payment_status == 3)
    $payment_status = "Rejected";
else if($payment_status == 4)
    $payment_status = "Prossesdehir";

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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <!-- <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css"> -->

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body> <!-- onload="window.print();" -->
<div class="row">
<button style="width: 60px; margin-left: 150px; margin-top: 10px;" onclick="printDiv2();" id="printPageButton" type="button" class="btn btn-block btn-primary">Print</button>
</div>

<div class="wrapper col-xs-10" id="mainDiv" style="margin-left: 120px;">

  <!-- Main content -->

  <section class="invoice" style="margin-top: 10px;">
    
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <img src="images/logo/Tourslogo_2_.png" width="300">
      </div>
      <!-- /.col -->
    </div>
    <div class="row">
      <div class="col-xs-12">
        <div class="container">
        <table class="table borderless">
          <thead>
            <tr>
              <th><b class="pull-left">Date: <?php echo date("d/m/Y", strtotime($nRecUser['date'])); ?></b></th>
              <th>Created By</th>
              <th><strong>Franchise Name</strong></th>
            </tr>
          </thead>
          <tbody>
            <tr class="no_border">
              <td class="no_border"><b>Invoice #: <?php echo $nRecUser['id']; ?></td>
              <td class="no_border"><?php echo UserName($nRecUser['user_id']); ?></td>
              <td class="no_border"><?php echo GetEmployeeName($nRecUser['user_id']); ?></td>
            </tr>
            <tr>
              <td class="no_border"><b>Today Invoice #: <?php echo $nRecUser['today_invoice_id']; ?></b></td>
              <td class="no_border"><b>ASI#</b></td>
              <td class="no_border"><strong>Updated by</strong></td>
            </tr>
            <tr>
              <td class="no_border"></td>
              <td class="no_border"><?php echo $nRecUser['asi_no']; ?></td>
              <td class="no_border"><?php echo UserName($nRecUser['update_user_id']);?></td>
            </tr>
          </tbody>
        </table>
      </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- Table row -->
    <div class="row">
      <div class="col-xs-12 table-responsive">
        <table class="table table-striped">
          <thead>
          <tr>
            <th>Date</th>
            <th>Amount</th>
            <th>TransductionID</th>
            <th>Bank</th>
            <th>Payment Status</th>
          </tr>
          </thead>
          <tbody>
          <tr>
            <td><?php echo date("d/m/Y", strtotime($nRecUser['date'])); ?></td>
            <td><?php echo number_format($nRecUser['amount'],0); ?></td>
            <td><?php echo $nRecUser['transection_id']; ?></td>
            <td><?php echo $arrBank[$nRecUser['bank_id'] - 1]; ?></td>
            <td><?php echo $payment_status; ?></td>
          </tr>
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <div class="row">
        <div class="col-xs-10">
            <img class="img-responsive" align="center" src="../unique/images/payment_scan_images/<?php echo $nRecUser['bank_slip_image']; ?>" alt="">
        </div>
    </div>
    <div class="row">
        <!-- accepted payments column -->
        <!-- /.col -->
        <div class="col-xs-6 hide">
          <p class="lead">Payment Methods:</p>
          <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
            Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg
            dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
          </p>
        </div>
        <div class="col-xs-6 pull-right hide">
          <div class="table-responsive">
            <table class="table pull-right">
              <tr>
                <th style="width:50%">Available Balance</th>
                <td><?php echo ClientAvailBalance($nRecUser['user_id']);?></td>
              </tr>
              <!-- <tr>
                <th>Tax (9.3%)</th>
                <td>$10.34</td>
              </tr>
              <tr>
                <th>Shipping:</th>
                <td>$5.80</td>
              </tr>
              <tr>
                <th>Total:</th>
                <td>$265.24</td>
              </tr> -->
            </table>
          </div>
        </div>
        <!-- /.col -->
      </div>
    <!-- /.row -->
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->

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
<style type="text/css">
body {
  text-transform: uppercase !important;
  }
.well {
  min-height: 20px;
  padding: 19px;
  margin-bottom: 20px;
  background-color: #fff !important;
  border: 1px solid #000 !important;
  border-radius: 2 !important;
  color: #000;
  /*.box-shadow(inset 0 1px 1px rgba(0,0,0,.05));
  blockquote {
    border-color: #ddd;
    border-color: rgba(0,0,0,.15);
  }*/
}
</style>
<style type="text/css" media="print">

@media print {
  #printPageButton {
    visibility: hidden;
  }
}
</style>
</body>
</html>
