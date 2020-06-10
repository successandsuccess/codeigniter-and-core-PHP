<?php
//User session in ['user']
  session_start();
if($_SESSION['user_id']){
  //session_start();
  session_unset();
  session_destroy();
  header('Location: index.php');
}
?>