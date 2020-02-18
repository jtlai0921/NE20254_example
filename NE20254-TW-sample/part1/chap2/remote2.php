<?php
 if (preg_match("/^[A-C]$/",$_REQUEST['section'])) {
  include($_REQUEST['section'] . '/option.php');
 }

 print "歡迎來到".$name; // 執行某個處理
?>
