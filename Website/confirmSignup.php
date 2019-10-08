<html>
<head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" crossorigin="anonymous">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" crossorigin="anonymous"></script>

  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div class="container">
    <div class="row header">
      <div class="app-title">NFL STATS APP</div>
    </div>
    <div class="row page-content">
      <div class="offset-sm-2 col-sm-8 signup-container row">
        <div class="col-md-12 signup-title">Thank you for signing up!</div>
        <?php var_dump($_POST["email"]); //TODO add SQL HERE or in head ?>
      </div>
    </div>
  </div>
</body>
</html>
