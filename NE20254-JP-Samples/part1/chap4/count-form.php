<?php
session_start();  // セッションを開始
if (!isset($_SESSION['cnt'])) { // カウンタ初期化
  $_SESSION['cnt'] = 1;
}
print "アクセス回数:".$_SESSION['cnt']++;
?>
<br>
<form action="<?php $_SERVER['PHP_SELF'];?>" method="POST">
<input type="submit" value="カウントアップ" />
</form>
