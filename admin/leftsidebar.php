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
 //var_dump($staff_permissions);
?>

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
                        <?php 
                        //var_dump($staff_permissions); die;
                        if(!empty($staff_permissions))
                        {
                        if ( in_array('2', $staff_permissions) || in_array('3', $staff_permissions) || in_array('4', $staff_permissions) || in_array('5', $staff_permissions)  ) { ?>
                        <li>

                            <a href="#"><i class="fa fa-files-o fa-fw"></i> User Management<span class="fa arrow"></span></a>

                            <ul class="nav nav-second-level">
                                <?php if (in_array('2', $staff_permissions)) { ?>
                                <li>

                                    <a href="users">Add User</a>

                                </li>
                                <?php } ?>
                                <?php if (in_array('5', $staff_permissions)) { ?>
                                <li>

                                    <a href="view_users">View User</a>

                                </li>
                                <?php } ?>

                            </ul>

                            <!-- /.nav-second-level -->

                        </li>
                        <?php } } ?>
                        <?php 
                        if(!empty($staff_permissions))
                        {
                        if (in_array('41', $staff_permissions)) { ?>
                        <li>

                            <a href="#"><i class="fa fa-files-o fa-fw"></i> Ticket Management<span class="fa arrow"></span></a>

                            <ul class="nav nav-second-level">
                                <?php if (in_array('41', $staff_permissions)) { ?>
                                <li>

                                    <a href="view_ticket">View Ticket</a>

                                </li>
                                <?php } ?>

                            </ul>

                            <!-- /.nav-second-level -->

                        </li>
                        <?php } } ?>
                        <?php 
                        if(!empty($staff_permissions))
                        {
                        if (in_array('39', $staff_permissions)) { ?>
                        <li>

                            <a href="#"><i class="fa fa-files-o fa-fw"></i> Payment Management<span class="fa arrow"></span></a>

                            <ul class="nav nav-second-level">
                                <?php if (in_array('39', $staff_permissions)) { ?>
                                <li>

                                    <a href="view_payment">View Payment</a>

                                </li>
                                <?php } ?>

                            </ul>

                            <!-- /.nav-second-level -->

                        </li>
                        <?php } } ?>
                        <?php 
                        if(!empty($staff_permissions))
                        {
                        if (in_array('47', $staff_permissions)) { ?>
                        <li>

                            <a href="#"><i class="fa fa-files-o fa-fw"></i> Visa Management<span class="fa arrow"></span></a>

                            <ul class="nav nav-second-level">
                                <?php if (in_array('47', $staff_permissions)) { ?>
                                <li>

                                    <a href="view_visa">View Visa</a>

                                </li>
                                <?php } ?>

                            </ul>

                            <!-- /.nav-second-level -->

                        </li>
                        <?php } } ?>
                        <?php 
                        if(!empty($staff_permissions))
                        {
                        if (in_array('49', $staff_permissions)) { ?>
                        <li>

                            <a href="#"><i class="fa fa-files-o fa-fw"></i> Group Management<span class="fa arrow"></span></a>

                            <ul class="nav nav-second-level">
                                <?php if (in_array('49', $staff_permissions)) { ?>
                                <li>

                                    <a href="view_request">View Request</a>

                                </li>
                                <?php } ?>

                            </ul>

                            <!-- /.nav-second-level -->

                        </li>
                        <?php } } ?>
                        <?php 
                        if(!empty($staff_permissions))
                        {
                        if ( in_array('7', $staff_permissions) || in_array('8', $staff_permissions) || in_array('9', $staff_permissions) || in_array('10', $staff_permissions) ) { ?>
                        <li>

                            <a href="#"><i class="fa fa-files-o fa-fw"></i> Employee Management<span class="fa arrow"></span></a>

                            <ul class="nav nav-second-level">
                                <?php if (in_array('7', $staff_permissions)) { ?>
                                <li>

                                    <a href="employee">Add Employee</a>

                                </li>
                                <?php } if (in_array('10', $staff_permissions)) { ?>
                                <li>

                                    <a href="view_employee">View Employee</a>

                                </li>
                                <?php } ?>
                            </ul>

                            <!-- /.nav-second-level -->

                        </li>
                        <?php } } ?>
                        <?php 
                        if(!empty($staff_permissions))
                        {
                        if ( in_array('12', $staff_permissions) || in_array('13', $staff_permissions) || in_array('14', $staff_permissions) || in_array('15', $staff_permissions) ) { ?>
                        <li>

                            <a href="#"><i class="fa fa-files-o fa-fw"></i>Air Lines<span class="fa arrow"></span></a>

                            <ul class="nav nav-second-level">
                                <?php if (in_array('12', $staff_permissions)) { ?>
                                <li>

                                    <a href="air_lines">Add Air Lines</a>

                                </li>
                                <?php } if (in_array('15', $staff_permissions)) { ?>
                                <li>

                                    <a href="view_air_lines">View Air Lines</a>

                                </li>
                                <?php } ?>
                            </ul>

                            <!-- /.nav-second-level -->

                        </li>
                        <?php } } ?>
                        <?php 
                        if(!empty($staff_permissions))
                        {
                        if ( in_array('17', $staff_permissions) || in_array('18', $staff_permissions) || in_array('19', $staff_permissions) || in_array('20', $staff_permissions) ) { ?>
                        <li>

                            <a href="#"><i class="fa fa-files-o fa-fw"></i>Logo Management<span class="fa arrow"></span></a>

                            <ul class="nav nav-second-level">
                                <?php if (in_array('17', $staff_permissions)) { ?>
                                <li>

                                    <a href="logo">Add Logo</a>

                                </li>
                                <?php } if (in_array('20', $staff_permissions)) { ?>
                                <li>

                                    <a href="view_logo">View Logo</a>

                                </li>
                                <?php } ?>
                            </ul>

                            <!-- /.nav-second-level -->

                        </li>
                        <?php } } ?>
                        <?php 
                        if(!empty($staff_permissions))
                        {
                        if ( in_array('27', $staff_permissions) || in_array('28', $staff_permissions) || in_array('29', $staff_permissions) || in_array('30', $staff_permissions) ) { ?>
                        <li>

                            <a href="#"><i class="fa fa-files-o fa-fw"></i>Banner Management<span class="fa arrow"></span></a>

                            <ul class="nav nav-second-level">
                                <?php if (in_array('27', $staff_permissions)) { ?>
                                <li>

                                    <a href="banner">Add Banner</a>

                                </li>
                                <?php } if (in_array('30', $staff_permissions)) { ?>
                                <li>

                                    <a href="view_banner">View Banner</a>

                                </li>
                                <?php } ?>
                            </ul>

                            <!-- /.nav-second-level -->

                        </li>
                        <?php } } ?>
                        <?php 
                        if(!empty($staff_permissions))
                        {
                        if ( in_array('22', $staff_permissions) || in_array('23', $staff_permissions) || in_array('24', $staff_permissions) || in_array('25', $staff_permissions) ) { ?>
                        <li>

                            <a href="#"><i class="fa fa-files-o fa-fw"></i>Top Banner Management<span class="fa arrow"></span></a>

                            <ul class="nav nav-second-level">
                                <?php if (in_array('22', $staff_permissions)) { ?>
                                <li>

                                    <a href="top_banner">Add Top Banner</a>

                                </li>
                                <?php } if (in_array('25', $staff_permissions)) { ?>
                                <li>

                                    <a href="view_top_banner">View Top Banner</a>

                                </li>
                                <?php } ?>
                            </ul>

                            <!-- /.nav-second-level -->

                        </li>
                        <?php } } ?>
                        <?php 
                        if(!empty($staff_permissions))
                        {
                        if ( in_array('32', $staff_permissions) || in_array('33', $staff_permissions) || in_array('34', $staff_permissions) || in_array('35', $staff_permissions) ) { ?>
                        <li>

                            <a href="#"><i class="fa fa-files-o fa-fw"></i>Text Management<span class="fa arrow"></span></a>

                            <ul class="nav nav-second-level">
                                <?php if (in_array('32', $staff_permissions)) { ?>
                                <li>

                                    <a href="text">Add Text</a>

                                </li>
                                <?php } if (in_array('34', $staff_permissions)) { ?>
                                <li>

                                    <a href="view_text">View Text</a>

                                </li>
                                <?php } ?>
                            </ul>

                            <!-- /.nav-second-level -->

                        </li>
                        <?php } } ?>
                        <?php 
                        if(!empty($staff_permissions))
                        {
                        if ( in_array('37', $staff_permissions) || in_array('45', $staff_permissions)  ) { ?>
                        <li>

                            <a href="#"><i class="fa fa-files-o fa-fw"></i>Bank Accounts Management<span class="fa arrow"></span></a>

                            <ul class="nav nav-second-level">
                                <?php if (in_array('37', $staff_permissions)) { ?>
                                <li>

                                    <a href="bank">Bank Accounts Text</a>

                                </li>
                                <?php } if (in_array('45', $staff_permissions)) { ?>
                                <li class="hide">

                                    <a href="view_bank_text">View bank Accounts Text</a>

                                </li>
                                <?php } ?>
                            </ul>

                            <!-- /.nav-second-level -->

                        </li>
                        <?php } } ?>
                    </ul>

                </div>

                <!-- /.sidebar-collapse -->

            </div>

            <!-- /.navbar-static-side -->