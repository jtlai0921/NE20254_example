<?php
header('Content-Type: text/html; charset=utf-8');
require_once('cachelib.php');
pzcache_header(30); // 判斷瀏覽器快取內容是否為最新內容
// 開始輸出內容
print "<html><body>";
print "現在時間::".time()."<br />";
print "Accept-Encoding::".$_SERVER['HTTP_ACCEPT_ENCODING']."<br />";
phpinfo();
// 內容輸出結束
?>
