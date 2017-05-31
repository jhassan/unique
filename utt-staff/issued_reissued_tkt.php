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
                    <h1 class="page-header" id="title_account_statement"><?php if(!empty($user_id)) echo "Issued/Reissued TKT: ". UserName($user_id); else echo "Issued/Reissued TKT";  ?></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <form action="" method="get" id="myForm">
            <?php TextField("Start Date", "start_date", $start_date, "10","3","form-control date_picker_pre2 m-t-10"); ?>
            <?php TextField("End Date", "end_date", $end_date1, "10","3","form-control date_picker_pre2 m-t-10"); ?>                
            <div class="form-group col-lg-3 m-t-10 p-l-0">
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
                                        $GrandTotalInvoices = 0;
                                        $SQL = "SELECT * FROM tblissuerefund WHERE user_id = ".(int)$user_id." 
                                        AND (ticket_status = 2 OR ticket_status = 6) 
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
                                            else if($ticket_status == 5)
                                                $ticket_status = "PNR Expired";
                                            else if($ticket_status == 6)
                                                $ticket_status = "Reissued";
                                            $GrandTotalInvoices += $row['amount'];
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
                                            <td colspan="9" class="left bld text-right"><?php echo number_format($GrandTotalInvoices,2); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                            
                        </div>
                        <!-- /.panel-body -->
                    </div>
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
    });    

    </script>

</body>

</html>
