<?php
 $homedir = "/home/taro";
 $filename = $homedir . "/" . $_REQUEST['name'];
 readfile($filename);
?>
