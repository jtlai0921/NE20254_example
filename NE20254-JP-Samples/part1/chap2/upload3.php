<?php
 $file = "/var/www/html/upload/file"; // 保存するファイルの名前
 if(move_uploaded_file($userfile, $file)){
  print "$userfile を $file にアップロードしました";
 }
?>
