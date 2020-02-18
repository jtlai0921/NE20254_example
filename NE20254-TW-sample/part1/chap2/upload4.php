<?php
 $file = "/var/www/html/upload/file"; // 保存檔案的名稱
 $tmp_file = $_FILES['userfile']['tmp_name']; // 暫存檔名
 if ($_FILES['userfile']['error'] == UPLOAD_ERR_OK &&
     move_uploaded_file($tmp_file, $file)){
   print "將 $tmp_file 上傳到 $file 了";
 }
?>
