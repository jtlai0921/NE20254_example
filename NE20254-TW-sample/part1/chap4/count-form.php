<?php
session_start();  // �}�lSession
if (!isset($_SESSION['cnt'])) { // �p�ƪ�l��
  $_SESSION['cnt'] = 1;
}
print "�s������:".$_SESSION['cnt']++;
?>
<br>
<form action="<?php $_SERVER['PHP_SELF'];?>" method="POST">
<input type="submit" value="�p�ƥ[ 1" />
</form>
