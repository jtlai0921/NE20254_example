<?php
 $homedir = "/home/taro";
 if(!ereg('^[^./][^/]*$',$_POST['name'])){
   die ("invalid file name.");
 }
 $filename = $homedir . "/" . $_POST['name'];
 $basename = basename($filename);
 readfile($baseename);
?>
