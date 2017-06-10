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
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">

    <link href="../bower_components/css/jquery-ui.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet" type="text/css">

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                <?php if(isset($_GET['error']) && $_GET['error'] == "1") {?>
                <div class="alert alert-danger">User Name and Password is wrong!</div>
                <?php } ?>
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    
                    <div class="panel-body">
                        <form role="form" action="login.php" method="post" id="LoginForm">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="User Name" name="strNewLoginx" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="strNewPassword" type="password" value="">
                                </div>
                                <div class="checkbox hide">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>
                                </div>
                                <div class="form-group col-lg-6" style="padding-left:0px;">
                                    <button type="submit" class="btn btn-default">Login</button>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <!--<a href="index.html" class="btn btn-lg btn-success btn-block">Login</a>-->
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js" type="text/javascript"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js" type="text/javascript"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../bower_components/js/sb-admin-2.min.js" type="text/javascript"></script>

</body>

</html>
