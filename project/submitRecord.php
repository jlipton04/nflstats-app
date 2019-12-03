<?php
  $signedIn = false;

  //Makes sure user is signed in to view page
  if(!isset($_COOKIE["auth"])) {
    //redirect to signin
    echo '<script type="text/javascript"> window.location = "signin.php"; </script>';
  } else {
    $signedIn = true;
  }
?>

<?php error_reporting(0); ?>

<?php
  //This function will build a query based on the query mode, tables and columns
  //It assumes certain POST fields based on the action
  function buildQuery($columns, $action, $table) {
    $sql = '';

    if ($action == 'add') {
      $sql = $sql . 'INSERT INTO ' . $table . ' (' . $_POST["columns"] . ') ';
      $sql = $sql . 'VALUES (' . $_POST["values"] . ')';
      $sql = $sql . ';';
    } else if ($action == 'edit') {
      $sql = $sql . 'UPDATE ' . $table . ' ';
      $sql = $sql . 'SET ' . $_POST["setStatement"] . ' ';
      $sql = $sql . 'WHERE ' . strstr($_POST["setStatement"], ",", true);
      $sql = $sql . ';';
    } else if ($action == 'delete') {
      $sql = $sql . 'DELETE FROM ' . $table . ' ';
      $sql = $sql . 'WHERE ' . $_POST["whereStatement"];
      $sql = $sql . ';';
    }

    return $sql;
  }

  //Connection info
  $servername = "mysql1.cs.clemson.edu";
  $username = "bpjoye";
  $password = "cpsc4620";
  $dbname = "nfl_db";

  //Connect to DB
  $conn = new mysqli($servername, $username, $password, $dbname);

  //Get POST Data
  $tableName = $_POST["table"];
  $action = $_POST["action"];

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

  //Builds query
  $sql = buildQuery($tableColumns, $action, $tableName);

  echo $sql;

  //Executes query
  $result = mysqli_query($conn, $sql);

  //Closes DB connection
  $conn->close();

  //Closes the page
  echo "<script>window.close();</script>";
?>
