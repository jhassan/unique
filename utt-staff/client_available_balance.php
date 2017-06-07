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
                    <h1 class="page-header">Client Available Balance</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12 alert alert-success hide" id="message_status"></div>
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Client Available Balance
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <div id="PrintDiv">
                                <table class="table table-responsive table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Client Name</th>
                                            <th>Available Balance</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
                                        if ($page <= 0) $page = 1;

                                        $per_page = 20; // Set how many records do you want to display per page.
                                        $startpoint = ($page * $per_page) - $per_page;
                                        $SQL = "SELECT `available_balance`, user_name FROM tblavailablebalance 
                                                INNER JOIN tbluser on tbluser.user_id = tblavailablebalance.client_id
                                                WHERE `staus_id` = '1' AND user_status = 1 AND user_type = '0' ORDER BY user_name ASC LIMIT {$startpoint} , {$per_page}";
                                        //echo $SQL;
                                         $result = mysqli_query($conn, $SQL);
                                         if (mysqli_num_rows($result) != 0) {
										 while($row = mysqli_fetch_array($result)) { // ,MYSQL_ASSOC
									?>
                                        <tr class="odd gradeX" id="DelID_<?php echo $row['id'];?>">
                                            <td class="left"><?php echo $row['user_name'];?></td>
                                            <td class="left"><?php echo number_format($row['available_balance'],2);?></td>
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
            $('#dataTables-example').DataTable({
                responsive: true
            });
        });
    </script>
    <style type="text/css">
    .table-responsive {
      overflow-x: inherit !important;
    }
    </style>
    
</body>

</html>
