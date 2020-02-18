<?php
session_start();  // 開始Session
if (!isset($_SESSION['cnt'])) { // 計數初始化
  $_SESSION['cnt'] = 1;
}
print "存取次數:".$_SESSION['cnt']++;
?>
<br>
<form action="<?php $_SERVER['PHP_SELF'];?>" method="POST">
<input type="submit" value="計數加 1" />
</form>
