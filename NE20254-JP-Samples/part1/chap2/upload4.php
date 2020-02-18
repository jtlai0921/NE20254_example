<?php
 $file = "/var/www/html/upload/file"; // 保存するファイルの名前
 $tmp_file = $_FILES['userfile']['tmp_name']; // テンポラリファイル名
 if ($_FILES['userfile']['error'] == UPLOAD_ERR_OK &&
     move_uploaded_file($tmp_file, $file)){
   print "$tmp_file を $file にアップロードしました";
 }
?>
