<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Tours View Login</title>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

  <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
<link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>

      <link rel="stylesheet" href="css/login.css">

  
</head>

<body>
  
<!-- Form Mixin-->
<!-- Input Mixin-->
<!-- Button Mixin-->
<!-- Pen Title-->
<div class="pen-title">
  <h1>Please Login Here</h1><span><a href='/unique/journey/home.php'>Back to Home Page</a></span>
</div>
<!-- Form Module-->
<div class="module form-module">
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
    <form action="../login.php" method="post">
      <input type="text" name="strNewLoginx" placeholder="Username"/>
      <input type="password" name="strNewPassword" placeholder="Password"/>
      <button type="submit">Login</button>
    </form>
    
  </div>
</div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='http://codepen.io/andytran/pen/vLmRVp.js'></script>

    <script src="js/index.js"></script>

</body>
</html>
