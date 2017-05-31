<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Unique Travels</title>

    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link href="../dist/css/jquery-ui.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="../dist/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../bower_components/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <script src="ckeditor/ckeditor.js"></script>

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
	.cursor {cursor:pointer;}
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
	.m-r-0{ margin-left: 0px !important; }
	.m-r-5{ margin-left: 5px !important; }
	.m-r-10{ margin-left: 10px !important; }
	.m-r-15{ margin-left: 15px !important; }
	.m-r-20{ margin-left: 20px !important; }
    .hide {display: none !important;}
    .bld{font-weight: bold !important;}
    a.disabled {
       pointer-events: none;
       cursor: default;
    }
    .center { text-align: center !important;}
    body {
  text-transform: uppercase !important;
  }
    </style>

</head>
<?php 
    include_once('functions.php'); 
    include_once('log_array.php'); 
    $page_name = "";
    $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    if (strpos($actual_link, 'localhost') !== false) {
        $page_name = basename($_SERVER['PHP_SELF']);
    }
    elseif (strpos($actual_link, 'toursview.com') !== false) {
        $page_name = basename($_SERVER['PHP_SELF']);
    }

    $page_id = $PagePermission[$page_name];

?>