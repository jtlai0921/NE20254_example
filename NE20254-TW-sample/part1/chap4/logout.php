<?php
session_start();
if ($_GET['logout'] == 1){
  session_destroy();
  print "logout user.";
}
?>
