<?php
/*
 * ・「・ッ・サ・ケ・ォ・ヲ・��ソ。シ、ホ・ニ・ケ・ネ・ラ・�А次�鬣�
 */
//echo "<pre>";
//var_export($_SERVER);
//echo "</pre>";

// ・ォ・ヲ・��ソ。シ・ユ・。・��ッ・キ・逾��ノ、゜ケ��゜
require_once "count.php";
// ・ォ・ヲ・��ネハンツクDBM・ユ・。・、・�離�
$dbmfn="../data/counter";

echo "<DL>";
echo "<DD>・ォ・ヲ・��ネテヘ、��ンツク、ケ、��BM・ユ・。・、・�Ε� \"$dbmfn\" 、ヌ、ケ。」<br>";
echo "<DD>・レ。シ・ク、ホ・ム・ケフセ \"{$_SERVER['PHP_SELF']}\" 、��マ・テ・キ・蟶ー、ヒ、キ、゛、ケ。」<br>";
$num = countup($dbmfn,$_SERVER['PHP_SELF']);
echo "<DD>、ソ、タ、、、゛、ホ・「・ッ・サ・ケソ��マ".$num."、ヌ、ケ。」<br>";
echo "</DL>";
echo "<BLOCKQUOTE>";
echo "・「・ッ・サ・ケ・ォ・ヲ・��ネ・�Д院Ε�:";
counterlist("$dbmfn");

$num = getcount($dbmfn,$_SERVER['PHP_SELF']);
echo "<br>GD、ャ、「、�Ε潺ゐ���スシィ、筅ヌ、ュ、゛、ケ。ァ";
echo "<img src=\"strimg.php?count=$num\">\n";

echo "</BLOCKQUOTE>";
?>
