<?php include_once('top.php');?>
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
if(isset($_GET["id_date"])) 
{
    $id_date = $_GET["id_date"];
    $id_date = date("d-m-Y", strtotime($id_date));
}
else
    $id_date = date("d-m-Y");

if(isset($_GET["bank_type"])) $bank_type = $_GET["bank_type"];
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
                    <h1 class="page-header">View Daily Payment</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12 alert alert-success hide" id="message_status"></div>
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            View Daily Payment
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <form id="SearchForm" action="">
                                    <div class="form-group col-lg-3 p-l-0">
                                    <?php TextField("Select Date", "id_date", $id_date, "10","","form-control","",""); ?>
                                    </div>
                                     <div class="form-group col-lg-3 p-l-0">
                                     <label>Select Bank</label>
                                    <?php ArrayComboBox("bank_type", $bank_type, $arrBank, true, "", "Select Bank", "form-control"); ?>
                                    </div>   

                                    
                                    <div class="form-group col-lg-4 hide">
                                        <button type="submit" class="btn btn-default">Search</button>
                                    </div>
                                </form>
                                <div class="clear"></div>
                                <div class="row">
<button style="width: 60px; margin-left: 15px; margin-top: 10px;" onclick="printDiv2();" id="printPageButton" type="button" class="btn btn-block btn-primary">Print</button>
</div>
                                <div class="clear"></div>
                                <div id="PrintDiv">
                                <div id="heading_div">
                                <h2 align="center" style="font-size: 37px;">Tours View</h2><p clas="text-center" align="center" style="font-size:16px;">9-A, First Floor, Grand Hotel Davis Road, Lahore Pakistan</p><h4 align="center" style="font-weight: bold; text-decoration: underline;">Daily Payment Report</h4><h4 align="left" style="font-size: 15px; text-align: center; font-weight: bold;">Date: <?php echo $id_date; ?> </h4><table>
                                <tbody><tr class="filters">
                                </tr>
                                <tr class="filters">
                                    
                                </tr>
                                <tr class="filters hide">
                                    
                                </tr>
                                </tbody></table>
                            </div>
                                <table class="table table-responsive table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Invoice#</th>
                                            <th>Today Invoice#</th>    
                                            <th>Date</th>
                                            <th>Amount</th>
                                            <th>TransductionID</th>
                                            <th>Bank</th>
                                            <th>Created By</th>
                                            <th>Updated By</th>
                                            <th>Payment Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
                                        if ($page <= 0) $page = 1;

                                        $per_page = 100; // Set how many records do you want to display per page.
                                        $id_date = date("Y-m-d", strtotime($id_date)); 
                                        $startpoint = ($page * $per_page) - $per_page;
                                        if(!empty($id_date) && !empty($bank_type))
                                        {
                                            $SQL = "SELECT * FROM tblepayment WHERE `date` LIKE '".$id_date."%' AND bank_id = ".$bank_type." ORDER BY id DESC LIMIT {$startpoint} , {$per_page}";    
                                        }
                                        else if(!empty($bank_type))
                                            $SQL = "SELECT * FROM tblepayment WHERE bank_id = ".$bank_type." ORDER BY id DESC LIMIT {$startpoint} , {$per_page}";
                                        else if(!empty($id_date))
                                            $SQL = "SELECT * FROM tblepayment WHERE `date` LIKE '".$id_date."%' ORDER BY id DESC LIMIT {$startpoint} , {$per_page}";
                                        //echo $SQL;
                                         $result = mysqli_query($conn, $SQL);
                                         if (mysqli_num_rows($result) != 0) {
										 while($row = mysqli_fetch_array($result)) { // ,MYSQL_ASSOC
                                            $disabled_sur = "";
                                            $disabled_checked = "";
                                            $disabled_class = "";
                                            $payment_status = $row['payment_status'];
									?>
                                        <tr class="odd gradeX" id="DelID_<?php echo $row['id'];?>">
                                            <td class="center"><?php echo $row['id'];?></td>
                                            <td class="center"><?php echo $row['today_invoice_id'];?></td>
                                            <td id="color_pax_name_<?php echo $row['id'];?>" style="color:<?php echo $color; ?>" class="left"><?php echo date("dMy h:m", strtotime($row['date']));?></td>
                                            <td class="left"><?php echo number_format($row['amount'],2);?></td>
                                            <td class="left" id="Trans_<?php echo $row['id'];?>"><?php echo $row['transection_id'];?></td>
                                            <td class="left"><?php echo $arrBank[$row['bank_id'] - 1];?></td>
                                            <td class="left"><?php echo UserName($row['user_id']);?></td>
                                            <td class="left"><?php echo UserName($row['update_user_id']);?></td>
                                            <td class="left" style="padding-top: 0;padding-bottom: 0;"><?php echo $arrPaymentStatus[$payment_status - 1];?></td>
                                        </tr>
									<?php } } else {
                                            echo "No records are found.";
                                            } ?>	
                                        
                                    </tbody>
                                </table>
                                </div>
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
    <?php include_once('jquery.php');?>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#id_date').datepicker({
            inline : true,
            onSelect : function(){
                $('#SearchForm').submit();   
            }
            });

            $('#bank_type').change(function(){
                $('#SearchForm').submit();   
            });

            
        });
    function printDiv2() {   
    // 1st
    var printContents = document.getElementById('PrintDiv').innerHTML;
    var originalContents = document.body.innerHTML;
     document.body.innerHTML = printContents;
     window.print();
     document.body.innerHTML = originalContents;
  }    
    </script>
    <style type="text/css">
    .table-responsive {
      overflow-x: inherit !important;
    }
    </style>
    
</body>

</html>
