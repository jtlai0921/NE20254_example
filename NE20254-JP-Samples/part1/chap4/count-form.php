<?php
session_start();  // ���å����򳫻�
if (!isset($_SESSION['cnt'])) { // �����󥿽����
  $_SESSION['cnt'] = 1;
}
print "�����������:".$_SESSION['cnt']++;
?>
<br>
<form action="<?php $_SERVER['PHP_SELF'];?>" method="POST">
<input type="submit" value="������ȥ��å�" />
</form>
