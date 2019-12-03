<?php
  //Delete authentication cookie
  setcookie("auth", "", time() - 3600, "/");

  //Tells the user they are signed out and redirects them to teh homepage
  echo '<script type="text/javascript">
          window.location = "index.php";
          alert("You have been signed out successfully!");
        </script>';
?>
