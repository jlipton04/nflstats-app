<html>
<head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" crossorigin="anonymous">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="styles.css">

  <script type="text/javascript" src="table.js"></script>

  <?php
    //Get POST Data
    $action = $_GET["action"];
    $tableName = $_GET["table"];
    $id = $_GET["id"];

    //Get JSON Table Data
    $strJsonFileContents = file_get_contents("tables/tableData.json");
    $tableData = json_decode($strJsonFileContents, true);

    //Matches table name from querystring to json data
    $tableName = substr($tableName,1,strlen($tableName)-2);
    $tableColumns = null;
    for ($i = 0; $i < count($tableData["tableNames"]); $i++) {
      if ($tableName == $tableData["tableNames"][$i]["name"]) {
        $tableColumns = $tableData["tableNames"][$i]["columns"];
      }
    }
  ?>
</head>
<body>
  <div class="container">
    <div class="row header">
      <div class="app-title">NFL STATS APP</div>
    </div>
    <div class="row page-content">
      <?php
        for ($i = 0; $i < count($tableColumns); $i++) {
          echo '<div class="input-label col-md-2">' . $tableColumns[$i]["displayName"] . ':</div>
                <div class="col-md-4"><input type="text" name="' . $tableColumns[$i]["column"] . '"/></div>';
        }
      ?>
    </div>
  </div>
</body>
</html>
