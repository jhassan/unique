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

function redirect($url) {
    $baseUri=_URL_;

    if(headers_sent())
    {
        $string = '<script type="text/javascript">';
        $string .= 'window.location = "' . $baseUri.$url . '"';
        $string .= '</script>';

        echo $string;
    }
    else
    {
    if (isset($_SERVER['HTTP_REFERER']) AND ($url == $_SERVER['HTTP_REFERER']))
        header('Location: '.$_SERVER['HTTP_REFERER']);
    else
        header('Location: '.$baseUri.$url);

    }
    exit;
}
 // //var_dump($staff_permissions);
 if (!in_array($page_id, $staff_permissions)) {
    //echo "id";
    //header("Location: home.php");
    //redirect('home.php')
    //error_reporting(E_ALL); 
 //ini_set("display_errors", 1);
 //header("Location: home.php");
 //die();
    //die;
 }

 // else
 //    echo "out ";
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
                                <li>
                                    <a href="un_read_ticket">Un Read Ticket</a>
                                </li>
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
                                <li>
                                    <a href="un_read_payment">Un Read Payment</a>
                                </li>
                            </ul>

                            <!-- /.nav-second-level -->

                        </li>
                        <?php } } ?>
                        <?php 
                            if($_SESSION['user_type'] == 1){
                        ?>
                        <li>

                            <a href="#"><i class="fa fa-files-o fa-fw"></i> Log Management<span class="fa arrow"></span></a>

                            <ul class="nav nav-second-level">
                                <li>

                                    <a href="view_log">View Log</a>

                                </li>

                            </ul>

                            <!-- /.nav-second-level -->

                        </li>
                        <?php } ?>
                        <?php 
                        if(!empty($staff_permissions))
                        {
                        if (in_array('63', $staff_permissions) || in_array('64', $staff_permissions) || in_array('65', $staff_permissions)) { ?>
                        <li>

                            <a href="#"><i class="fa fa-files-o fa-fw"></i> Reports Management<span class="fa arrow"></span></a>

                            <ul class="nav nav-second-level">
                                <?php if (in_array('64', $staff_permissions)) { ?>
                                <li><a href="daily_sale">Daily Sale</a></li>
                                <?php } if (in_array('65', $staff_permissions)) { ?>
                                <li><a href="daily_payment">Daily Payment</a></li>
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
                        <?php 
                        if(!empty($staff_permissions))
                        {
                        if ( in_array('51', $staff_permissions) || in_array('52', $staff_permissions) || in_array('53', $staff_permissions) || in_array('54', $staff_permissions) ) { ?>
                        <li>
                            <a href="#"><i class="fa fa-files-o fa-fw"></i>Notification Management<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <?php if (in_array('51', $staff_permissions)) { ?>
                                <li>
                                    <a href="add_post">Add Post</a>
                                </li>
                                <?php } if (in_array('53', $staff_permissions)) { ?>
                                <li>

                                    <a href="view_post">View Post</a>

                                </li>
                                <?php } ?>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <?php } } ?>
                        <?php 
                        if(!empty($staff_permissions))
                        {
                        if ( in_array('55', $staff_permissions) || in_array('56', $staff_permissions) ) { ?>
                        <li>
                            <a href="#"><i class="fa fa-files-o fa-fw"></i>Check Client Statement<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <?php if (in_array('56', $staff_permissions)) { ?>
                                <li>
                                    <a href="account_statement">Account Statement</a>
                                </li>
                                <?php } ?>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <?php } } ?>
                        <?php 
                        if(!empty($staff_permissions))
                        {
                        if ( in_array('57', $staff_permissions) || in_array('58', $staff_permissions) ) { ?>
                        <li>
                            <a href="#"><i class="fa fa-files-o fa-fw"></i>Personal Info<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <?php if (in_array('58', $staff_permissions)) { ?>
                                <li>
                                    <a href="personal_info">Add Personal Info</a>
                                </li>
                                <?php } ?>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <?php } } ?>
                        <?php 
                        if(!empty($_SESSION["user_type"]) && $_SESSION["user_type"] == "1") { ?>
                        <li>
                            <a href="#"><i class="fa fa-files-o fa-fw"></i>Issue Or Refund/Payment<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="issue_or_refund">Add Issue Or Refund</a>
                                </li>
                                <li>
                                    <a href="payment">Add Payment</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <?php } ?>
                        <?php 
                        if(!empty($_SESSION["user_type"]) && $_SESSION["user_type"] == "1") { ?>
                        <li>
                            <a href="#"><i class="fa fa-files-o fa-fw"></i>Vendor Management<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="vendor">Add Vendor</a>
                                </li>
                                <li>
                                    <a href="view_vendor">View Vendor</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <?php } ?>
                        <?php 
                        if(!empty($_SESSION["user_type"]) && $_SESSION["user_type"] == "1") { ?>
                        <li>
                            <a href="#"><i class="fa fa-files-o fa-fw"></i>Other Management<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="others">Add Other</a>
                                </li>
                                <li>
                                    <a href="view_others">View Other</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <?php } ?>
                        <li>
                            <a href="#"><i class="fa fa-files-o fa-fw"></i>Accountancy Management<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
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
                            <a href="change_password">Change Password</a>
                        </li>
                    </ul>

                </div>

                <!-- /.sidebar-collapse -->

            </div>
            <!-- <div id="dialog" title="Confirmation Required">
  Are you sure about this?
</div> -->
            <?php
            $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
                if (strpos($actual_link, 'localhost') !== false) {
                    $set_url = $actual_link."/eticket/utt-staff";
                }
                elseif (strpos($actual_link, 'toursview.com') !== false) {
                    $set_url = $_SERVER[HTTP_HOST];
                }
                //var_dump($staff_permissions);
             // if (!in_array($page_id, $staff_permissions)) {
             //    echo "id";
             //    header("Location: home.php");
             //    //die;
             // }
             // else
             //    echo "out ";
            ?>
            <!-- /.navbar-static-side -->
            <script type="text/javascript" src="../bower_components/jquery/dist/jquery.min.js"></script>
            <script type="text/javascript">
                
                //window.location.href = "<?php echo $set_url; ?>/home";
                    //return false;
                <?php //} else { ?>    
                    //alert("adfasd");
                $(document).ready(function(){
                <?php if (!in_array($page_id, $staff_permissions)) { ?>
                     //alert("adfads");
                     //window.location = "<?php echo $set_url; ?>/home";
                     //return false;
                    //ConfirmDialog('Cannot access this page! Please cotact to first admin!');
                      <?php } else { ?> 
                            //alert("adfads");
                        <?php } ?>
                });

                function ConfirmDialog(message) {
                    $('<div></div>').appendTo('body')
                    .html('<div><h6>'+message+'?</h6></div>')
                    .dialog({
                        modal: true, title: 'Alert', zIndex: 10000, autoOpen: true,
                        width: 'auto', resizable: false,
                        buttons: {
                            // OK: function () {
                            //     // $(obj).removeAttr('onclick');                                
                            //     // $(obj).parents('.Parent').remove();
                            //     window.location.href = "<?php echo $set_url; ?>/home";
                            //     $('body').append('<h1>Confirm Dialog Result: <i>Yes</i></h1>');

                            //     $(this).dialog("close");
                            // },
                            OK: function () {     
                                window.location.href = "<?php echo $set_url; ?>/home";                                                            
                                $('body').append('<h1>Confirm Dialog Result: <i>No</i></h1>');

                                $(this).dialog("close");
                            }
                        },
                        close: function (event, ui) {
                            $(this).remove();
                        }
                    });
                };

            </script>