<?php
 $file = "/var/www/html/upload/file"; // 保存するファイルの名前
 copy($userfile, $file);
 print "$userfile を $file にアップロードしました";
?>
