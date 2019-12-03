<?php
  //Delete authentication cookie
  setcookie("auth", "", time() - 3600);

  echo 'You have been successfully signed out.'
?>
