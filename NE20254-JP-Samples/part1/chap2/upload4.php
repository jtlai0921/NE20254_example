<?php
 $file = "/var/www/html/upload/file"; // ��¸����ե������̾��
 $tmp_file = $_FILES['userfile']['tmp_name']; // �ƥ�ݥ��ե�����̾
 if ($_FILES['userfile']['error'] == UPLOAD_ERR_OK &&
     move_uploaded_file($tmp_file, $file)){
   print "$tmp_file �� $file �˥��åץ��ɤ��ޤ���";
 }
?>
