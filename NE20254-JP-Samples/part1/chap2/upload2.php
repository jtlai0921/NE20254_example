<?php
 $file = "/var/www/html/upload/file"; // 保存するファイルの名前
 if(is_uploaded_file($userfile)) {
  copy($userfile, $file);
  print "$userfile を $file にアップロードしました";
 }
?>
