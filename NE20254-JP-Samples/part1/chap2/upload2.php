<?php
 $file = "/var/www/html/upload/file"; // ��¸����ե������̾��
 if(is_uploaded_file($userfile)) {
  copy($userfile, $file);
  print "$userfile �� $file �˥��åץ��ɤ��ޤ���";
 }
?>
