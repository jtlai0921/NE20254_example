<?php
 if (preg_match("/^[A-C]$/",$_REQUEST['section'])) {
  include($_REQUEST['section'] . '/option.php');
 }

 print $name."�ؤ褦����"; // ����������¹�
?>
