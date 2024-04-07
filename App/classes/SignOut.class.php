<?php

  // Start session
  session_start();

  // Clear Session array
  $_SESSION = array();

  // Kill session
  session_destroy();

  // Redirect
  header("Location: /");

?>