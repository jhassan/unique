<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Tours View</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/modern-business.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">

    .clear { clear:both !important;}

    .error { color: #F00 !important; font-weight:normal;}

    .p-0 { padding:0px !important;}

    .m-b-0 { margin-bottom: 0px; }

    .p-l-0 { padding-left: 0px !important;}

    .p-l-5 { padding-left: 5px !important;}

    .p-l-10 { padding-left: 10px !important;}

    /*.txt-box { width: 91px !important; padding:0px !important;}*/

    .dir-right{ direction:rtl;}

    .m-t-0{ margin-top: 0px !important; }

    .m-t-5{ margin-top: 5px !important; }

    .m-t-10{ margin-top: 10px !important; }

    .m-t-15{ margin-top: 15px !important; }

    .m-l-0{ margin-left: 0px !important; }

    .m-l-5{ margin-left: 5px !important; }

    .m-l-10{ margin-left: 10px !important; }

    .m-l-15{ margin-left: 15px !important; }

    .m-l-20{ margin-left: 20px !important; }
    
    #page-wrapper { min-height: 0px !important;}

    .bld{font-weight: bold !important;}

    </style>

</head>

<body>

<?php 
        include_once("conn.php");
        $SQL = "SELECT * FROM tbllogo WHERE logo_status = '1'  ORDER BY logo_id DESC";          
        $result = mysqli_query($connection, $SQL) or die(mysqli_connect_error());
        $strRow = mysqli_fetch_array($result);
        $Status = $strRow['logo_status'];
        $Image = $strRow['logo_image'];
?>
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="background-color: #606060;">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- <a class="navbar-brand" href="index4.php">ToursView</a> -->
                <?php if(!empty($Image)) {?>
                <div class="pull-left col-lg-4">
                <!-- <a class="navbar-brand" href="index4.php"> --><img src="../utt-staff/images/logo/<?php echo $Image;?>" height="160" 
                width="350" alt="Logo"><!-- </a> -->
                </div>
                <?php } ?>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <div class="pull-right col-lg-8" style="margin-top:15px;">
                        <form class="navbar-form navbar-right" role="form" action="login.php" method="post" id="LoginForm">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input class="form-control" placeholder="User Name" name="strNewLoginx" type="text" autofocus>
                        </div>

                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input class="form-control" placeholder="Password" name="strNewPassword" type="password" value="">                                        
                        </div>

                        <button type="submit" class="btn btn-primary">Login</button>
                   </form>
                </div>
                <ul class="nav navbar-nav navbar-right" style="margin-right: 0px;">
                    <li>
                        <a href="index">Home</a>
                    </li>
                    <li>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">About us <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="company_history">Company History</a>
                            </li>
                            <li>
                                <a href="our_mission">Our Mission</a>
                            </li>
                            <li>
                                <a href="ceo_message">CEO Massage</a>
                            </li>
                            <li>
                                <a href="why_us">Why us</a>
                            </li>
                            
                            <li>
                                <a href="our_team">Our Team</a>
                            </li>

                        </ul>
                    </li>
                    <li>
                        <a href="services">Services</a>
                    </li>
                    <li class="hide">
                        <a href="#">Our Products</a>
                    </li>
                    <li>
                        <a href="#">Our Franchise</a>
                    </li>

                    <li>
                        <a href="contact">Contact</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>