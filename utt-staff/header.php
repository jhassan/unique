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
//var_dump($staff_permissions); ?>
<div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="home">Unique Travels</a>
                <?php if(!empty($staff_permissions) && in_array('41', $staff_permissions)) { ?>
                <a href="view_ticket" class="navbar-brand" style="color: red; text-decoration: underline;">Unread Tickets: <span id="undread_tickets">0</span></a>
                <?php } if(!empty($staff_permissions) && in_array('39', $staff_permissions)) { ?>
                <a href="view_payment" class="navbar-brand" style="color: red; text-decoration: underline;">Unread Payments: <span id="undread_payments">0</span></a>
                <?php } if(!empty($staff_permissions) && in_array('47', $staff_permissions)) { ?>
                <a href="view_visa" class="navbar-brand" style="color: red; text-decoration: underline;">Unread Visa: <span id="undread_visa">0</span></a>
                <?php } if(!empty($staff_permissions) && in_array('49', $staff_permissions)) { ?>
                <a href="view_request" class="navbar-brand" style="color: red; text-decoration: underline;">Unread Request: <span id="undread_request">0</span></a>
                <?php } ?>                
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                
                <!-- /.dropdown -->
                
                <!-- /.dropdown -->
                
                <!-- /.dropdown -->
                <li class="dropdown">
                    <?php
                     if(!empty($_SESSION["strUserName"])){
                        $session_user_name = "Login User: ".$_SESSION["strUserName"];
                    }
                    else
                    {
                        $session_user_name = "";   
                    }

                    ?>
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <?php echo $session_user_name; ?>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li class="hide"><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li class="hide"><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->