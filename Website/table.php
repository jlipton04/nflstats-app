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

    //GET QueryString
    $tableName = $_GET["name"];
    $tableColumns = null;

    //Writes table column names
    for ($i = 0; $i < count($tableData["tableNames"]); $i++) {
      if ($tableName == $tableData["tableNames"][$i]["name"]) {
        $tableColumns = $tableData["tableNames"][$i]["columns"];
      }
    }

    //var_dump($tableColumns);
    ?>
</head>
<body>
  <div class="container">
    <div class="row header">
      <div class="app-title">NFL STATS APP</div>
    </div>
    <div class="row page-content">
      <div class="table-title"></div>
      <table class="table-container">
        <thead>
          <tr><?php for ($i = 0; $i < count($tableColumns); $i++) { echo "<th>" . $tableColumns[$i]["displayName"] . "</th>"; } ?></tr>
        </thead>
        <tbody>
          <?php
            for ($x = 0; $x < 10; $x++) {
              echo "<tr>";
              for ($y = 0; $y < count($tableColumns); $y++) {
                //Make it pull from SQL query
                echo "<td>asdf</td>";
              }
              echo "</tr>";
            }
          ?>
      </tbody>
      </table>
    </div>
  </div>
</body>
</html>
