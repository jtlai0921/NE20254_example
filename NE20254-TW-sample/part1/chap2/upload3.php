<?php
 $file = "/var/www/html/upload/file"; // �O�s�ɮת��W��
 if(move_uploaded_file($userfile, $file)){
  print "�N $userfile �W�Ǩ� $file �F";
 }
?>
