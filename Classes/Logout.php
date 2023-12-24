<?php 
 
 session_start();
 unset($_SESSION['id_comum']);
 unset($_SESSION['id_admin']);
 header("location: ../login.php");
 
?>