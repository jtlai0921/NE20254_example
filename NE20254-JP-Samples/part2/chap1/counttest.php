<?php
/*
 * ¡¦¡Ö¡¦¥Ã¡¦¥µ¡¦¥±¡¦¥©¡¦¥ò¡¦€€¥½¡£¥·¡¢¥Û¡¦¥Ë¡¦¥±¡¦¥Í¡¦¥é¡¦ú§¡¼¡¦ò§à
 */
//echo "<pre>";
//var_export($_SERVER);
//echo "</pre>";

// ¡¦¥©¡¦¥ò¡¦€€¥½¡£¥·¡¦¥æ¡¦¡£¡¦€€¥Ã¡¦¥­¡¦î§€€¥Î¡¢¡¬¥±€€¡¬
require_once "count.php";
// ¡¦¥©¡¦¥ò¡¦€€¥Í¥Ï¥ó¥Ä¥¯DBM¡¦¥æ¡¦¡£¡¦¡¢¡¦öÎ¥»
$dbmfn="../data/counter";

echo "<DL>";
echo "<DD>¡¦¥©¡¦¥ò¡¦€€¥Í¥Æ¥Ø¡¢€€¥ó¥Ä¥¯¡¢¥±¡¢õ¥BM¡¦¥æ¡¦¡£¡¦¡¢¡¦ö¦¥Þ \"$dbmfn\" ¡¢¥Ì¡¢¥±¡£¡×<br>";
echo "<DD>¡¦¥ì¡£¥·¡¦¥¯¡¢¥Û¡¦¥à¡¦¥±¥Õ¥» \"{$_SERVER['PHP_SELF']}\" ¡¢€€¥Þ¡¦¥Æ¡¦¥­¡¦êº¡¼¡¢¥Ò¡¢¥­¡¢¡«¡¢¥±¡£¡×<br>";
$num = countup($dbmfn,$_SERVER['PHP_SELF']);
echo "<DD>¡¢¥½¡¢¥¿¡¢¡¢¡¢¡«¡¢¥Û¡¦¡Ö¡¦¥Ã¡¦¥µ¡¦¥±¥½€€¥Þ".$num."¡¢¥Ì¡¢¥±¡£¡×<br>";
echo "</DL>";
echo "<BLOCKQUOTE>";
echo "¡¦¡Ö¡¦¥Ã¡¦¥µ¡¦¥±¡¦¥©¡¦¥ò¡¦€€¥Í¡¦ô§¥±¡¦¥Í:";
counterlist("$dbmfn");

$num = getcount($dbmfn,$_SERVER['PHP_SELF']);
echo "<br>GD¡¢¥ã¡¢¡Ö¡¢ø¦¥ß¥¤ðÃ€€¥¹¥·¥£¡¢ä¦¥Ì¡¢¥å¡¢¡«¡¢¥±¡£¥¡";
echo "<img src=\"strimg.php?count=$num\">\n";

echo "</BLOCKQUOTE>";
?>
