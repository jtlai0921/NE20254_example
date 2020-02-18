<?php
header('Content-Type: text/html; charset=utf-8');

/*
 * 計數器的測試程式
 */
//echo "<pre>";
//var_export($_SERVER);
//echo "</pre>";

// 讀取計數器函式
require_once "count.php";
// 儲存計數器的 DBM 檔名
$dbmfn="c:/temp/counter";

echo "<DL>";
echo "<DD>儲存計數值的 DBM 檔為 \"$dbmfn\" 。<br>";
echo "<DD>網頁路徑名稱 \"{$_SERVER['PHP_SELF']}\" 將設定成雜湊鍵。<br>";
$num = countup($dbmfn,$_SERVER['PHP_SELF']);
echo "<DD>現在的存取數為 ".$num."。<br>";
echo "</DL>";
echo "<BLOCKQUOTE>";
echo "存取計數清單:";
counterlist("$dbmfn");

$num = getcount($dbmfn,$_SERVER['PHP_SELF']);
echo "<br>如有 GD 可顯示影像:";
echo "<img src=\"strimg.php?count=$num\">\n";

echo "</BLOCKQUOTE>";
?>
