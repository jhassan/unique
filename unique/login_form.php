<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Tours View Login</title>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

  <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
<link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>

      <link rel="stylesheet" href="css/login.css">
<style type="text/css">
  label.error { display: block; float: none; color: red; padding-left: 11.5em; vertical-align: top; }
</style>
  
</head>

<body>
  
<!-- Form Mixin-->
<!-- Input Mixin-->
<!-- Button Mixin-->
<!-- Pen Title-->
<div class="pen-title" style="padding: 0px;">
  <a href="home" style="float: left;"><img src="images/logo.png" alt=""></a>
  <div style="clear: both;"></div>
  <h1>Please Login Here</h1><span><a href='/unique/index'>Back to Home Page</a></span>
</div>
<!-- Form Module-->
<?php if(isset($_GET['error']) && $_GET['error'] == "1") {?>
      <div style="text-align: center; color: red; margin-top: 5px;">User Name and Password is wrong!</div>
  <?php } ?>
<div class="module form-module" style="margin-top: 20px;">
  <div class="form">
    <h2>Login to your account</h2>
    <form>
      <input type="text" placeholder="Username"/>
      <input type="password" placeholder="Password"/>
      <button >Login</button>
    </form>
  </div>

  <div class="form">
    <h2>Login to your account</h2>
    <form action="login.php" method="post" id="logn_form">
      <input type="text" name="strNewLoginx" placeholder="Username" class="required" />
      <input type="password" name="strNewPassword" placeholder="Password" class="required" />
      <button type="submit">Login</button>
    </form>
    
  </div>
</div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='http://codepen.io/andytran/pen/vLmRVp.js'></script>

    <script src="js/index.js"></script>
    <script src="dist/js/jquery.validate.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){
        $("#logn_form").validate();
      });
    </script>

</body>
</html>
