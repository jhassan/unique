<?php $client_id = $_SESSION['client_id']; ?>
<div class="navbar-default sidebar m-t-0" role="navigation">
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
                        <?php
                         if(!empty($_SESSION["strUserName"])){
                            $session_user_name = "Login User: ".$_SESSION["strUserName"];
                        }
                        else
                        {
                            $session_user_name = "";   
                        }

                    ?>
                        <li>
                            <p class="bld m-l-10 p-l-10" style="color: #337ab7;"><?php echo $session_user_name; ?></p>
                        </li>

                        <?php 
                                $SQL22 = "SELECT * FROM tbllog WHERE user_id = '".(int)$_SESSION['client_id']."' AND `activity_type` = 2 ORDER BY id DESC LIMIT 1,1 ";            
                                $result22 = mysql_query($SQL22) or die(mysql_error());
                                $row22 = mysql_fetch_array($result22);
                        ?>
                        <li>
                            <p class="bld m-l-10 p-l-10 m-t-10" style="color: #337ab7; font-size: 12px; line-height: 7px;">Last Login Detail:</p>
                            <p class="bld m-l-10 p-l-10 m-t-10" style="color: #337ab7; float: left; width: 85px; font-size: 12px; line-height: 7px;">Date</p><p class="bld m-l-10 p-l-10 m-t-10" style="color: #337ab7; float: left; font-size: 12px; line-height: 7px;">Time</p>
                            <p class="bld m-l-10 p-l-10" style="color: #337ab7; float: left; clear: both; font-size: 12px; line-height: 7px;"><?php echo date("d-m-Y", strtotime($row22['date_time'])); ?></p><p class="bld m-l-10 p-l-10" style="color: #337ab7; float: left; font-size: 12px; line-height: 7px;"><?php echo date("h:i:s A", strtotime($row22['date_time'])); ?></p>
                        </li>
                        <li class="clear">
                            <p class="bld m-l-10 p-l-10" style="color: #337ab7; line-height: 7px; font-size: 12px;">IP Address:<?php echo $row22['computer_name']; ?></p>
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

                                    <a href="notes.php"><i class="fa fa-files-o fa-fw"></i>Company Agreement</a>

                                </li>

								<?php } ?>
                                <li>

                                    <a href="notifications"><i class="fa fa-files-o fa-fw"></i>Notifications</a>

                                </li>
                                <?php

                                	if($GetRecord['bank_accounts_status'] == 1)

									{

								?>

                                

                                <li>

                                    <a href="bank.php"><i class="fa fa-files-o fa-fw"></i>Bank Accounts</a>

                                </li>

                                <?php } ?>
                                

                        <li>
                            <a href="#"><i class="fa fa-files-o fa-fw"></i> Make Reservation<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                            
									
                                    <li>
                                    <a href="flights">Flights</a>
                                	</li>
                                    <!-- <li class="hide">
                                    <a href="others">Others</a>
                                    </li> -->
                                    
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
                                    <a href="umrah">Passport Feeding</a>
                                </li>
                                <li>
                                    <a href="view_visa">View Visa</a>
                                </li>
																											
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <?php } ?>
                        <li>
                            <a href="#"><i class="fa fa-files-o fa-fw"></i>Accountancy<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="account_statement">Account Summery</a>
                                </li>
                                <li>
                                    <a href="issued_reissued_tkt">Issued/reissued TKT</a>
                                </li>
                                <li>
                                    <a href="refund_void_tkt">Refund/Void TKT</a>
                                </li>
                                <li>
                                    <a href="payment_rcv">Payments RCV</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-files-o fa-fw"></i> Operations<span class="fa arrow"></span></a>
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
                                    <a href="group_request">Group Request</a>
                                </li>
                                <li>
                                    <a href="view_request">View Request</a>
                                </li>
                                
                                <li>
                                    <a href="payment">Make Payment Invoice</a>
                                </li>
                                <li>
                                    <a href="payment_status">Payment Status</a>
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
                                <li>

                                    <a href="personal_info">Contact Detail</a>

                                </li>

                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="change_password">Change Password</a>
                        </li>
                        <li>
                            <a href="logout">Logout</a>
                        </li>
                    </ul>
                </div>
                <div class="sidebar-nav navbar-collapse" style="height: 260px; width: 240px; padding: 10px;">
                    <marquee scrollamount="1" style="background: #f8f8f8; width: 240px; padding-top:15px; padding-bottom:2px; text-align: justify;" class="p-20" direction="up">

                    <?php 

                        $SQLText = "SELECT * FROM tbltext WHERE text_status = 1 ORDER BY text_id DESC";         

                             $resultText = MySQLQuery($SQLText);
                             if(count($resultText) > 0)
                             {
                             while($rowText = mysql_fetch_array($resultText)) { // ,MYSQL_ASSOC
                             $color = $rowText['text_color'];
                             $bold = $rowText['text_bold'];
                             if($color == 1)
                                $classColor = "black";
                             else if($color == 2)
                                $classColor = "blue";
                             else if($color == 3)
                                $classColor = "red";        
                            if($bold == 1)
                                $classBold = "bld"; 

                    ?>

                    <p style="width: 240px; text-align: justify; padding-right:15px;" class="<?php echo $classColor;?> <?php echo $classBold;?>"><?php echo $rowText['marque_text']; ?></p>

                     <?php } }?>

                    </marquee>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
<style type="text/css">

marquee p

{

    /*white-space:nowrap;*/

    float: left;

    /*padding-left: 200px;*/
    /*width: 200px !important;*/
    text-align: left;

}
.red { color:#F00; }
.blue{ color:#00C;}
.black{ color:#000;}
.bld{ font-weight: bold;}
</style>