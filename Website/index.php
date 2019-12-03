<?php
  $signedIn = false;

  if(!isset($_COOKIE["auth"])) {
    //redirect to signin
    echo '<script type="text/javascript"> window.location = "signin.php"; </script>';
  } else {
    $signedIn = true;
  }
?>

<html>
<head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" crossorigin="anonymous">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="styles.css">

  <script type="text/javascript" src="table.js"></script>

  <?php
    //Get JSON Table Data
    $strJsonFileContents = file_get_contents("tables/tableData.json");
    $tableData = json_decode($strJsonFileContents, true);
  ?>
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
      </ul>
    </div>
    <div class="row page-content">
      <div class="index-summary">
        <p>Welcome to the NFL Stats Web Portal for CPSC 4620.</p>
        <p>Created by: Jacob Lipton, and Ben Joye</p>
        <img src="logo.png" height="100" width="100">
        <img src="nfllogo.jpg" height="100" width="100">
      </div>
    </div>
  </div>
</body>
</html>
