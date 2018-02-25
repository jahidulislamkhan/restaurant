<?php
   session_start();
   session_unset($_SESSION['email']);
   if(session_destroy()) {
      header("Location: login.php");
   }
?>