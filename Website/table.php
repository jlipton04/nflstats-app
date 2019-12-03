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
    $tableColumns = null;
    $sql = "SELECT * FROM " . $tableName;

    $filter = $_GET["filter"];

    if ($filter != '') {
      $sql = $sql . " WHERE " . $filter;
    }

    $sql = $sql . ";";

    $result = mysqli_query($conn, $sql);

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
    <div id="navbar">
      <ul>
        <li><a class="active" href="index.php">Home</a></li>
        <li><a href="table.php?name=team">Tables</a></li>
        <li><a href="signup.php">Signup</a></li>
        <li><a href="signin.php">Sign In</a></li>
      </ul>
    </div>

    <div id="navbar">
      <ul>
        <li><a class="active" href="table.php?name=team">Team</a></li>
        <li><a href="table.php?name=game">Game</a></li>
        <li><a href="table.php?name=player">Player</a></li>
        <li><a href="table.php?name=passing">Passing</a></li>
        <li><a href="table.php?name=receiving">Receiving</a></li>
        <li><a href="table.php?name=rushing">Rushing</a></li>
      </ul>
    </div>

    <div class="row page-content">
      <div class="table-title"></div>
      <div class="filterContainer">
        <div class="numericalQueryBuilder">
          <select class="columnSelect">
            <?php for ($i = 0; $i < count($tableColumns); $i++) {
              if ($tableColumns[$i]["type"] == 'number') {
                echo '<option value="' . $tableColumns[$i]["column"] . '">' . $tableColumns[$i]["displayName"] . '</option>';
              }
            }?>
          </select>
          <select class="modeSelect">
            <option value="<"><</option>
            <option value="=">=</option>
            <option value=">">></option>
            <option value="!=">!=</option>
          </select>
          <input class="filterVal" type="number" />
          <input class="filterAdd" type="button" value="Add Filter" />
        </div>
        <div class="textQueryBuilder">
          <select class="columnSelect">
            <?php for ($i = 0; $i < count($tableColumns); $i++) {
              if ($tableColumns[$i]["type"] == 'varchar') {
                echo '<option value="' . $tableColumns[$i]["column"] . '">' . $tableColumns[$i]["displayName"] . '</option>';
              }
            }?>
          </select>
          <select class="modeSelect">
            <option value="=">=</option>
            <option value="!=">!=</option>
            <option value="LIKE">LIKE</option>
            <option value="NOT LIKE">NOT LIKE</option>
          </select>
          <input class="filterVal" type="text" />
          <input class="filterAdd" type="button" value="Add Filter" />
        </div>
        <input type="button" class="filterClear" value="Clear Filters" />
        <div class="current-query"><span class="query-label">Current Query: </span><?php echo $sql; ?></div>
      </div>
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
                  echo '<td><a target="_blank" href=record.php?action=edit&table=' . $tableName . '&id=' . $row[$tableColumns[$y]["column"]] . '>' . $row[$tableColumns[$y]["column"]] . '</a></td>';
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
