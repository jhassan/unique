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
if(isset($_GET["user_id"])) $user_id = $_GET["user_id"];
if(isset($_GET["vendor_id"])) $vendor_id = $_GET["vendor_id"];
if(isset($_GET["status_id"])) $status_id = $_GET["status_id"];
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
                    <h1 class="page-header">View Daily Sale</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12 alert alert-success hide" id="message_status"></div>
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            View Daily Sale
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <form id="SearchForm" action="">
                                    <div class="form-group col-lg-3 p-l-0">
                                    <?php TextField("Select Date", "id_date", $id_date, "10","","form-control","",""); ?>
                                    </div>
                                    <div class="form-group col-lg-3 m-b-10">
                                        <label style="float: left;">Select Vendor</label>
                                       <select name="vendor_id" id="vendor_id" class="form-control valid required">
                                      <option value="0">Select Vendor</option>
                                      <?php
                                      $SQLV = "SELECT * FROM tblvendor ORDER BY vendor_name";            
                                     $resultv = MySQLQuery($SQLV);
                                     while($rowv = mysql_fetch_array($resultv)) { // ,MYSQL_ASSOC
                                      if( !empty($vendor_id) && $rowv['vendor_id'] == $vendor_id ) 
                                            $vselected = "selected='selected'";
                                        else
                                            $vselected = "";
                                      ?>
                                      <option value="<?php echo $rowv['vendor_id'];?>" <?php echo $vselected; ?>><?php echo $rowv['vendor_name'];?></option>
                                      <?php } ?> 
                                      </select>
                                    </div>
                                    <div class="form-group col-lg-3 p-l-0">
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
                                    <div class="form-group col-lg-3 p-l-0">
                                        <label>Select Status</label>
                                        <select name="status_id" id="status_id" class="form-control" style="">
                                            <option value="">Select Status</option>
                                            <?php
                                                foreach($arrTicketStatus as $key => $status):
                                                 if( !empty($status_id) && ($key + 1) == $status_id ) 
                                                    $selected = "selected='selected'";
                                                else
                                                    $selected = "";   
                                            ?>
                                            <option value="<?php echo $key + 1; ?>" <?php echo $selected; ?>><?php echo $status?></option>
                                            <?php endforeach; ?>
                                        </select>
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
                                <h2 align="center" style="font-size: 37px;">Tours View</h2><p clas="text-center" align="center" style="font-size:16px;">9-A, First Floor, Grand Hotel Davis Road, Lahore Pakistan</p><h4 align="center" style="font-weight: bold; text-decoration: underline;">Daily Sale Report</h4><h4 align="left" style="font-size: 15px; text-align: center; font-weight: bold;">Date: <?php echo $id_date; ?> </h4><table>
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
                                            <th>Status Invoice#</th>
                                            <th>Date</th>
                                            <th>Pax Name</th>
                                            <th>Air Line Code</th>
                                            <th>PNR</th>
                                            <th>Air line</th>
                                            <th>Amount</th>
                                            <th>Created By</th>
                                            <th>Ticket Status</th>
                                            <th>View Vendor</th> 
                                            <th>Mode</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
                                        if ($page <= 0) $page = 1;

                                        $per_page = 20; // Set how many records do you want to display per page.
                                        $id_date = date("Y-m-d", strtotime($id_date)); 
                                        $startpoint = ($page * $per_page) - $per_page;
                                        if(!empty($id_date) && !empty($vendor_id) && !empty($user_id))
                                        {
                                           $SQL = "SELECT * FROM tblissuerefund WHERE `date` LIKE '".$id_date."%' AND user_id = '".(int)$user_id."' AND vendor_id = '".(int)$vendor_id."' ORDER BY id DESC LIMIT {$startpoint} , {$per_page}"; 
                                        }
                                        else if(!empty($id_date) && $vendor_id != 0)
                                        {
                                            $SQL = "SELECT * FROM tblissuerefund WHERE `date` LIKE '".$id_date."%' AND vendor_id = '".(int)$vendor_id."' ORDER BY id DESC LIMIT {$startpoint} , {$per_page}";
                                        }
                                        else if(!empty($id_date) && !empty($user_id))
                                        {
                                            $SQL = "SELECT * FROM tblissuerefund WHERE `date` LIKE '".$id_date."%' AND user_id = '".(int)$user_id."' ORDER BY id DESC LIMIT {$startpoint} , {$per_page}";
                                        }
                                        else if(!empty($id_date) && !empty($status_id))
                                        {
                                            $SQL = "SELECT * FROM tblissuerefund WHERE `date` LIKE '".$id_date."%' AND ticket_status = '".(int)$status_id."' ORDER BY id DESC LIMIT {$startpoint} , {$per_page}";
                                        }
                                        else
                                        $SQL = "SELECT * FROM tblissuerefund WHERE `date` LIKE '".$id_date."%' ORDER BY id DESC LIMIT {$startpoint} , {$per_page}";
                                        //echo $SQL;
                                         $result = mysqli_query($conn, $SQL);
                                         if (mysqli_num_rows($result) != 0) {
										 while($row = mysqli_fetch_array($result)) { // ,MYSQL_ASSOC
                                            $disabled_sur = "";
                                            $disabled_checked = "";
                                            $disabled_class = "";
                                            $disabled = "";
                                            $pnr_expired = "";
                                            $ticket_status = $row['ticket_status'];
                                            $update_status = $row['update_status'];
                                            $is_supervised = $row['is_supervised'];
                                            $user_commisions = number_format($row['user_commisions'],0);
                                            $edit_rows_status = $row['edit_rows_status'];
                                            if($edit_rows_status == 1 && $_SESSION["user_type"] == 2)
                                                $disabled_edit = "disabled='disabled'";
                                            else
                                                $disabled_edit = "";
                                            if($update_status == 1 && $_SESSION["user_type"] == 2)
                                                $disabled = "disabled='disabled'";
                                            else
                                                $disabled = "";
                                            if($is_supervised == 1 && $_SESSION["user_type"] == 2)
                                            {
                                                $disabled_sur = "disabled='disabled'";
                                                $disabled_checked = "checked='checked'";
                                                $disabled_class = "disabled";
                                                $asi_input_disabled = "disabled";
                                            }
                                            elseif($is_supervised == 1 && $_SESSION["user_type"] == 1)
                                            {
                                                $disabled_checked = "checked='checked'";
                                            }
                                            else
                                                $asi_input_disabled = "";
                                            $is_active = $row['is_active'];
                                            if($is_active == 1)
                                                $color = "black";
                                            else
                                                $color = "red";
                                            $date = date("Y-m-d", strtotime($row['date']));
                                            $main_id = $row['id'];

                                            // update vendor status
                                            $vendor_disabled = "";
                                            if($row['vendor_status'] == 1 && $_SESSION["user_type"] == 2)
                                                $vendor_disabled = "disabled='disabled'";
                                            else
                                                $vendor_disabled = "";
                                            // Disable show dialog button
                                            //echo $ticket_status ."----". $row['vendor_id'];
									?>
                                        <tr class="odd gradeX" id="DelID_<?php echo $row['id'];?>">
                                            <td class="center"><?php echo $row['id'];?></td>
                                            <td class="center"><?php echo $row['today_invoice_id'];?></td>
                                            <td class="center"><?php echo $row['today_status_id'];?></td>
                                            <td class="left"><?php echo date("dMy H:i", strtotime($row['date']));?></td>
                                            <td class="left" id="color_pax_name_<?php echo $row['id'];?>" style="color:<?php echo $color; ?>"><?php echo $row['pax_name'];?></td>
                                            <td class="left"><?php echo $row['sector'];?></td>
                                            <td class="left" id="PNR_<?php echo $row['id'];?>"><?php echo $row['pnr'];?></td>
                                            <td class="left"><?php echo AirLinesName($row['air_line_id']);?></td>
                                            <td class="text-right"><?php echo number_format($row['amount'],2);?></td>
                                            <td class="left"><?php echo UserName($row['user_id']);?></td>
                                            <td class="left"><?php echo $arrTicketStatus[$ticket_status - 1];?></td>
                                            <td class="left"><?php echo GetVendorName($row['vendor_id']);?></td>
                                            <td class="left" id="ModeType_<?php echo $row['id'];?>"><?php echo $arrIssue[$row['mode_type'] - 1];?></td>
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
            // Vendor search
            $("#vendor_id").change(function (){
                $('#SearchForm').submit(); 
            });
            // Client search
            $("#user_id").change(function (){
                $('#SearchForm').submit(); 
            });
            // Client search
            $("#status_id").change(function (){
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
