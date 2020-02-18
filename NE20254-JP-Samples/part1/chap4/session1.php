<?php
session_start(); // セッション開始

if (!isset($_SESSION['cnt'])){ // セッション変数として未登録の場合
  $_SESSION['cnt'] = 0; // セッション変数として登録
}
?>
<html><body>
<?php
$_SESSION['cnt']++; // カウンタをアップ
print "アクセス回数：". $_SESSION['cnt'];
?>
</body></html>      
