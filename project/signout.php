<?php
  //Delete authentication cookie
  setcookie("auth", "", time() - 3600, "/");

  echo '<script type="text/javascript">
          window.location = "index.php";
          alert("You have been signed out successfully!"); 
        </script>';
?>
