<?php
session_start(); // ���å���󳫻�

if (!isset($_SESSION['cnt'])){ // ���å�����ѿ��Ȥ���̤��Ͽ�ξ��
  $_SESSION['cnt'] = 0; // ���å�����ѿ��Ȥ�����Ͽ
}
?>
<html><body>
<?php
$_SESSION['cnt']++; // �����󥿤򥢥å�
print "�������������". $_SESSION['cnt'];
?>
</body></html>      
