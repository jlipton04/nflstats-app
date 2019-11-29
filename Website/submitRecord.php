<?php
  function buildQuery($columns, $action, $table) {
    $sql = '';

    if ($action == 'insert') {
      $sql = $sql . 'INSERT INTO ' . $table . ' VALUES (';

      for ($i = 0; $i < count($columns); $i++) {
        $sql = $sql . '"' . $_POST[$columns[$i]["column"]] . '",';
      }

      $sql = $sql . ');';
    } else if ($action == 'update') {
      $sql = $sql . 'UPDATE ' . $table . ' ';
      $sql = $sql . 'SET ';
    } else if ($action == 'delete') {
      $sql = $sql . 'DELETE FROM ' . $table . ' ';
      $sql = $sql . 'WHERE ' . $columns[0]["column"] . '="' . $_POST[$columns[0]["column"]] . '";';
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
  $tableName = substr($_GET["table"], 1, strlen($_GET["table"])-2);
  $action = substr($_GET["action"], 1, strlen($_GET["action"])-2);

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

  $sql = buildQuery($tableColumns, $action, $tableName);

  echo $sql;

  $conn->close();
?>
