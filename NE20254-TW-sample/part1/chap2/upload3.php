<?php
 $file = "/var/www/html/upload/file"; // 保存檔案的名稱
 if(move_uploaded_file($userfile, $file)){
  print "將 $userfile 上傳到 $file 了";
 }
?>
