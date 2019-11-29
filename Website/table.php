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

    //Verify connection
    /*echo $conn->connect_error;
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    echo "Connected successfully";*/

    //Get JSON Table Data
    $strJsonFileContents = file_get_contents("tables/tableData.json");
    $tableData = json_decode($strJsonFileContents, true);

    //GET QueryString
    $tableName = $_GET["name"];
    //$tableName = substr($tableName,1,strlen($tableName)-2);
    $tableColumns = null;
    $sql = "SELECT * FROM " . $tableName . ";";

    $result = mysqli_query($conn, $sql);

    //echo $sql;

    //Matches table name from querystring to json data
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
      <div class="table-title"></div>
      <table class="table-container">
        <thead>
          <tr>
            <?php for ($i = 0; $i < count($tableColumns); $i++) { echo "<th>" . $tableColumns[$i]["displayName"] . "</th>"; } ?>
          </tr>
        </thead>
        <tbody>
          <?php
            while($row = $result->fetch_assoc()) {
              echo "<tr>";
              for ($y = 0; $y < count($tableColumns); $y++) {
                if ($y != 0) {
                  echo "<td>" . $row[$tableColumns[$y]["column"]] . "</td>";
                } else {
                  echo '<td><a href=record.php?action="edit"&table="' . $tableName . '"&id="' . $row[$tableColumns[$y]["column"]] . '">' . $row[$tableColumns[$y]["column"]] . '</a></td>';
                }
              }
              echo "</tr>";
            }
            $conn->close();
          ?>
      </tbody>
      </table>
    </div>
  </div>
</body>
</html>
