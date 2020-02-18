<?php
require_once('cachelib.php');
pzcache_header(30); // ブラウザキャッシュ更新判定
// コンテンツ出力開始
print "<html><body>";
print "現在の時間::".time()."<br />";
print "Accept-Encoding::".$_SERVER['HTTP_ACCEPT_ENCODING']."<br />";
phpinfo();
// コンテンツ出力終了
?>
