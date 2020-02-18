<?php
session_start(); // Session 開始

if (!isset($_SESSION['cnt'])){ // 未登錄Session變數的情形
  $_SESSION['cnt'] = 0; // 登錄Session變數
}
?>
<html><body>
<?php
$_SESSION['cnt']++; // 計數加 1
print "存取次數:". $_SESSION['cnt'];
?>
</body></html>
