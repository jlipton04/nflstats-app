<html>
<head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" crossorigin="anonymous">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="styles.css">

  <script type="text/javascript" src="table.js"></script>

  <?php
    //Connection info
    $servername = "mysql1.cs.clemson.edu";
    $username = "bpjoye";
    $password = "cpsc4620";
    $dbname = "nfl_db";

    //Connect to DB
    $conn = new mysqli($servername, $username, $password, $dbname);

    //Get POST Data
    $action = substr($_GET["action"], 1, strlen($_GET["action"])-2);
    $tableName = substr($_GET["table"], 1, strlen($_GET["table"])-2);
    $id = substr($_GET["id"], 1, strlen($_GET["id"])-2);

    //Get JSON Table Data
    $strJsonFileContents = file_get_contents("tables/tableData.json");
    $tableData = json_decode($strJsonFileContents, true);

    //Matches table name from querystring to json data
    $tableColumns = null;
    for ($i = 0; $i < count($tableData["tableNames"]); $i++) {
      if ($tableName == $tableData["tableNames"][$i]["name"]) {
        $tableColumns = $tableData["tableNames"][$i]["columns"];
      }
    }

    $sql = 'SELECT * FROM ' . $tableName . ' WHERE ' . $tableColumns[0]["column"] . '="' . $id . '";';
    $result = mysqli_query($conn, $sql);
  ?>
</head>
<body>
  <div class="container">
    <div class="row header">
      <div class="app-title">NFL STATS APP</div>
    </div>
    <div class="row page-content">
      <?php
        if ($action == 'edit') {
          $row = $result->fetch_assoc();
        }
        for ($i = 0; $i < count($tableColumns); $i++) { ?>
          <div class="input-label col-md-2"><?php echo $tableColumns[$i]["displayName"]; ?>:</div>
          <div class="col-md-4">
            <?php
              if ($action == 'add') {
                echo '<input type="text" name="' . $tableColumns[$i]["column"] . '"/>';
              } else if ($action == 'edit') {
                echo '<input type="text" name="' . $tableColumns[$i]["column"] . '" value="' . $row[$tableColumns[$i]["column"]] . '"/>';
              }
            ?>
          </div>
        <?php }

        $conn->close();
      ?>
      <div><input type="button" /></div>
    </div>
  </div>
</body>
</html>
