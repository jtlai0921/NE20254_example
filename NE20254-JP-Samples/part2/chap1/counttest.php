<?php
/*
 * ���֡��á��������������򡦀����������ۡ��ˡ������͡��顦��������
 */
//echo "<pre>";
//var_export($_SERVER);
//echo "</pre>";

// �������򡦀����������桦�������á�������Ρ���������
require_once "count.php";
// �������򡦀��ͥϥ�ĥ�DBM���桦���������Υ�
$dbmfn="../data/counter";

echo "<DL>";
echo "<DD>�������򡦀��ͥƥء�����ĥ���������BM���桦������������ \"$dbmfn\" ���̡�������<br>";
echo "<DD>���졣���������ۡ��ࡦ���ե� \"{$_SERVER['PHP_SELF']}\" �����ޡ��ơ�����꺡����ҡ���������������<br>";
$num = countup($dbmfn,$_SERVER['PHP_SELF']);
echo "<DD>�������������������ۡ��֡��á�������������".$num."���̡�������<br>";
echo "</DL>";
echo "<BLOCKQUOTE>";
echo "���֡��á��������������򡦀��͡���������:";
counterlist("$dbmfn");

$num = getcount($dbmfn,$_SERVER['PHP_SELF']);
echo "<br>GD���㡢�֡����ߥ��À���������䦥̡��塢����������";
echo "<img src=\"strimg.php?count=$num\">\n";

echo "</BLOCKQUOTE>";
?>
