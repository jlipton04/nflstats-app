<?php
  //Connection info
  $servername = "mysql1.cs.clemson.edu";
  $username = "bpjoye";
  $password = "cpsc4620";
  $dbname = "nfl_db";

  //Connect to DB
  $conn = new mysqli($servername, $username, $password, $dbname);

  $email = $_POST["email"];
  $password = $_POST["password"];

  if ($email != '' && $password != '') {
    $sql = 'SELECT * FROM user WHERE ';
    $sql = $sql . "email = '" . $email . "' AND ";
    $sql = $sql . "password = '" . $password . "';";

    $result = mysqli_query($conn, $sql);

    if ($result->num_rows == 0) {
      echo "Wrong username/password combo";
    } else {
      //Success
      $cookie_name = "auth";
      $cookie_value = "true";
      setcookie($cookie_name, $cookie_value, time() + (1800), "/"); // 86400 = 1 day

      echo isset($_COOKIE['auth']);

      echo '<script type="text/javascript"> window.location = "index.php"; </script>';
    }
  }
?>
<html>
<head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" crossorigin="anonymous">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" crossorigin="anonymous"></script>

  <link rel="stylesheet" href="styles.css">

  <script type="text/javascript" src="signin.js"></script>
</head>
<body>
  <div class="container">
    <div class="row header">
      <div class="app-title">NFL STATS APP</div>
    </div>
    <div id="navbar">
      <ul>
        <li><a class="active" href="index.php">Home</a></li>
        <li><a href="table.php?name=team">Tables</a></li>
        <li><a href="signup.php">Signup</a></li>
        <li><a href="signin.php">Sign In</a></li>
        <li><a href="signout.php">Sign Out</a></li>
      </ul>
    </div>
    <div class="row page-content">
      <div class="offset-sm-2 col-sm-8 signup-container row">
        <div class="col-md-12 signup-title">Sign In</div>
        <form class="signin-form" action="signin.php" method="POST">
          <div class="row">
            <div class="offset-md-2 col-md-4 input-label">Email:</div><div class="col-md-6"> <input class="signin-input" type="email" name="email" /> </div>
            <div class="offset-md-2 col-md-4 input-label">Password:</div><div class="col-md-6"> <input class="signin-input" type="password" name="password" /> </div>
            <div class="offset-md-5 col-md-2"> <input class="signup-input" type="button" value="Sign In" id="signinSubmit" /> </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
