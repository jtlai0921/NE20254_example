<?php
 $file = "/var/www/html/upload/file"; // ��¸����ե������̾��
 if(move_uploaded_file($userfile, $file)){
  print "$userfile �� $file �˥��åץ��ɤ��ޤ���";
 }
?>
