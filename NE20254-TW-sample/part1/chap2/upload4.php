<?php
 $file = "/var/www/html/upload/file"; // �O�s�ɮת��W��
 $tmp_file = $_FILES['userfile']['tmp_name']; // �Ȧs�ɦW
 if ($_FILES['userfile']['error'] == UPLOAD_ERR_OK &&
     move_uploaded_file($tmp_file, $file)){
   print "�N $tmp_file �W�Ǩ� $file �F";
 }
?>
