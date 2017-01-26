<?php $client_id = $_SESSION['client_id']; ?>
<div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search hide">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="home"><i class="fa fa-dashboard fa-fw"></i> Home</a>
                        </li>

                        <?php

                                	$whereNotes = " user_id = ".(int)$_SESSION['client_id'];

									$GetRecord = GetRecord("tbluser", $whereNotes);

									if($GetRecord['notes_status'] == 1)

									{

								?>

                                <li>

                                    <a href="notes.php"><i class="fa fa-files-o fa-fw"></i>Notes</a>

                                </li>

								<?php } ?>

                                <?php

                                	if($GetRecord['bank_accounts_status'] == 1)

									{

								?>

                                

                                <li>

                                    <a href="bank.php"><i class="fa fa-files-o fa-fw"></i>Bank Accounts</a>

                                </li>

                                <?php } ?>

                        <li>
                            <a href="#"><i class="fa fa-files-o fa-fw"></i> Air Lines<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                            
                            	<?php
									//$str = "";
                                	$strQuery  = "SELECT tblairlines.*,user_air_line_id 
													FROM `tbluserairlines` INNER JOIN `tblairlines` 
													ON `tblairlines`.`air_line_id` = `tbluserairlines`.`air_line_id` 
													WHERE `tbluserairlines`.`user_id` = '".(int)$client_id."' ";
									$nResult = MySQLQuery($strQuery);	
									while($rstRow = mysql_fetch_array($nResult)){ 
									
									?>
									
                                    <li>
                                    <a href="air_lines?id=<?php echo $rstRow['user_air_line_id'];?>"><img src="../admin/images/air_lines/<?php echo $rstRow['air_line_image'];?>" height="40" width="200" alt="Air Line"></a>
                                	</li>
                                    
                                    <?php
									}
								
								
								?>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <?php
																												if($GetRecord['umrah_status'] == 1)
																												{
																											?>
                        <li>
                            <a href="#"><i class="fa fa-files-o fa-fw"></i> Visa Processing<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
																											
                                <li>
                                    <a href="umrah">Umrah Feeding</a>
                                </li>
                                <li>
                                    <a href="view_visa">View Visa</a>
                                </li>
																											
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <?php } ?>
                        <li>
                            <a href="#"><i class="fa fa-files-o fa-fw"></i> Reports<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
								<?php

									if($GetRecord['sales_report_status'] == 1)

									{

								?>

                                <li>

                                    <a href="sales_report">Sales Report</a>

                                </li>

                                <?php } ?>

                                <li>
                                    <a href="issue_or_refund">Issue or Refund</a>
                                </li>
                                <li>
                                    <a href="view_ticket_status">Ticket Status</a>
                                </li>
                                <li>
                                    <a href="payment">Payment</a>
                                </li>
                                <li>
                                    <a href="payment_status">Payment Status</a>
                                </li>
                                <li>
                                    <a href="group_request">Group Request</a>
                                </li>
                                <li>
                                    <a href="view_request">View Request</a>
                                </li>
                              

                                

                            </ul>
                            <!-- /.nav-second-level -->
                        </li>

                        

                        <li>
                            <a href="#"><i class="fa fa-files-o fa-fw"></i> Feedback and Complains<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">

                                <li>

                                    <a href="feedback">Add Feedback</a>

                                </li>

                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->