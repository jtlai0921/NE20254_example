<?php
session_start(); // Session �}�l

if (!isset($_SESSION['cnt'])){ // ���n��Session�ܼƪ�����
  $_SESSION['cnt'] = 0; // �n��Session�ܼ�
}
?>
<html><body>
<?php
$_SESSION['cnt']++; // �p�ƥ[ 1
print "�s������:". $_SESSION['cnt'];
?>
</body></html>
