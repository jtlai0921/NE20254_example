<?php
 require_once("ZIPCode.php");

 switch ($_GET['fn']) {
  case 'getInfoByZIP':
    $address = ZIPCode::getInfoByZIP($_GET['num']);
    $result = "<address>$address</address>";
    break;
 }
 print '<?xml version="1.0" encoding="UTF-8"?>';
 if (!$address){
   print "<Fault>no result!</Fault>";
 } else {
   print "<ZIPCode>$result</ZIPCode>";
 }
?>
