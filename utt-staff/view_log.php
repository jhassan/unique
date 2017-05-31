<?php include_once('top.php');
if(isset($_GET["user_id"])) $user_id = $_GET["user_id"];
if(isset($_GET["activity_type"])) $activity_type = $_GET["activity_type"];
if($activity_type == 1)
    $activity_type = "";
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
                    <h1 class="page-header">View Log</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            View Log
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <form id="SearchForm" action="">
                                    <div class="form-group col-lg-3 p-l-0">
                                    <?php TableComboMsSql("tbluser", "user_name", "user_id", "", "user_id", $user_id, "", "<option value=''>Select User</option>", "form-control", ""); ?>
                                    </div>
                                    <div class="form-group col-lg-3 p-l-0">
                                    <?php ArrayComboBox("activity_type", $activity_type, $arrLogType, true, "", "", "form-control", ""); ?>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <button type="submit" class="btn btn-default">Search</button>
                                    </div>
                                </form>
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>User Name</th>
                                            <th>Activity Type</th>
                                            <th>Descriptions</th>    
                                            <th>IP Address</th>
                                            <th>Date Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    	//$SQL = "SELECT * FROM tbllog ORDER BY id DESC";			
                                         $page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
                                        if ($page <= 0) $page = 1;

                                        $per_page = 20; // Set how many records do you want to display per page.

                                        $startpoint = ($page * $per_page) - $per_page;
                                        if(empty($user_id) && empty($activity_type))
                                        {   
                                         $SQL = "SELECT * FROM tbllog ORDER BY id DESC LIMIT {$startpoint} , {$per_page}"; 
                                        }
                                         elseif(!empty($user_id) && !empty($activity_type))
                                         {
                                             $SQL = "SELECT * FROM tbllog WHERE (user_id = '".$user_id."' AND activity_type = '".$activity_type."') ORDER BY id DESC LIMIT {$startpoint} , {$per_page}";
                                         }
                                         elseif(!empty($user_id) && empty($activity_type))
                                         {
                                             $SQL = "SELECT * FROM tbllog WHERE (user_id = '".$user_id."') ORDER BY id DESC LIMIT {$startpoint} , {$per_page}";
                                         }
                                         elseif(empty($user_id) && !empty($activity_type))
                                         {
                                             $SQL = "SELECT * FROM tbllog WHERE (activity_type = '".$activity_type."') ORDER BY id DESC LIMIT {$startpoint} , {$per_page}";
                                         }
                                         //echo $SQL; 
										 $result = MySQLQuery($SQL);
										 while($row = mysql_fetch_array($result)) { // ,MYSQL_ASSOC
        								?>
                                        <tr class="odd gradeX" id="DelID_<?php echo $row['id'];?>">
                                            <td class="left"><?php echo UserName($row['user_id']);?></td>
                                            <td class="left"><?php echo $arrLogType[$row['activity_type']-1];?></td>
                                            <td class="left"><?php echo $row['descriptions'];?></td>
                                            <td class="left"><?php echo $row['computer_name'];?></td>
                                            <td class="left"><?php echo date("d-m-Y h:i:s A", strtotime($row['date_time']));?></td>
                                        </tr>
									<?php } ?>	
                                        
                                    </tbody>
                                </table>
                                <?php
                                if(empty($user_id) && empty($activity_type))
                                {   
                                    $count_query = "tbllog ORDER BY id DESC";  
                                    echo pagination($count_query,$per_page,$page,$url='?'); 
                                }
                                 elseif(!empty($user_id) && !empty($activity_type))
                                 {
                                    $count_query = "tbllog WHERE (user_id = '".$user_id."' AND activity_type = '".$activity_type."') ORDER BY id DESC";
                                    echo pagination($count_query,$per_page,$page,$url='?user_id='.$user_id.'&activity_type='.$activity_type);
                                 }
                                 elseif(!empty($user_id) && empty($activity_type))
                                 {
                                    $count_query = "tbllog WHERE (user_id = '".$user_id."') ORDER BY id DESC";
                                    echo pagination($count_query,$per_page,$page,$url='?user_id='.$user_id.'');
                                 }
                                 elseif(empty($user_id) && !empty($activity_type))
                                 {
                                    $count_query = "tbllog WHERE (activity_type = '".$activity_type."') ORDER BY id DESC";
                                    echo pagination($count_query,$per_page,$page,$url='?activity_type='.$activity_type.'');
                                 }
                                // if(empty($search))
                                //    echo pagination($count_query,$per_page,$page,$url='?');         
                                // else
                                //    echo pagination($count_query,$per_page,$page,$url='?search='.$search.'&');
                                ?>
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
    <!-- Modal -->
   <?php include_once('jquery.php');?>
    
    
    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        
    });
    </script>

</body>

</html>
