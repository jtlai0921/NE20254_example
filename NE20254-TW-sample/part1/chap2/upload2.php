<?php
 $file = "/var/www/html/upload/file"; // �O�s�ɮת��W��
 if(is_uploaded_file($userfile)) {
  copy($userfile, $file);
  print "�N $userfile �W�Ǩ� $file �F";
 }
?>
