<html>
<head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" crossorigin="anonymous">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="styles.css">

  <script type="text/javascript" src="table.js"></script>

  <?php
    $game = array("game_id", "week", "day", "date", "time", "team_id", "w_or_l", "ot", "home_or_away", "opp_team_id", "points_scored", "points_allowed", "first_downs", "total_yards", "passing_yards", "rushing_yards", "turnovers_lost", "opp_first_downs", "opp_total_yards", "opp_passing_yards", "opp_rushing_yards", "opp_turnovers_lost");
    $player = array("player_id", "name", "position", "team_id");
    $strJsonFileContents = file_get_contents("tables/tableNames.json");
    var_dump($strJsonFileContents);
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
      </table>
    </div>
  </div>
</body>
</html>
