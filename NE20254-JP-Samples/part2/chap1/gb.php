<?php
//   Original version was found in example programs of
// PHP/FI-2.0 by Rasmus Lerdorf <rasmus@lerdorf.on.ca> in 1997.
// Ported to PHP4 by Jun Kuwamrua <juk@yokohama.email.ne.jp> in 2000.
// Ported to PHP5 with SQLite by Jun Kuwamrua in 2005.
//
//  History:
//      2005-02-09 JuK port to PHP5.
//      2002-02-01 Rui modification for register_globals=Off.
//      2001-10-14 JuK restruct if-blocks.
//      2001-09-30 JuK split into parts.
//      2000-07-19 JuK port to PHP4.
//      1999-04-29 JuK modified for PHP3.
//      1997-05-21 JuK modified to �ˀ��說� for RCCM web page.
require_once 'gbdb.php';
$DEBUG=0;
?>
<html>
<head>
<title>GuestLog</title>
</head>
<meta HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=x-euc-jp">
<body bgcolor="#ffffff" text="#000000" link="#1760c0" vlink="#107020">
<center>
<img src="guestbook.jpg" border="0" width="200" alt="Guestbook">
</center>
<hr>
<font size ="6">�����������͡�����</font>
<font size="3">
<a href="<?php echo $_SERVER['PHP_SELF']; ?>"> [���女��] </a>
<a href="<?php echo $_SERVER['PHP_SELF']; ?>?mode=read&days=1"> [����؀� </a>
<a href="<?php echo $_SERVER['PHP_SELF']; ?>?mode=admin"> [���Υ؀� </a>
</font><br>
<blockquote>
<hr size="1">

<?php
if($DEBUG)include("gbdebug.php");
// ��������PHP���桦�����������ۥ��ͥȡ����ᡢ�ۥ΀��㡢������������ DB �ե����͡���������������
// ���ϥϥա��ۥե��������ҥ����奨���������������͡�䴥ȥ̥����̡������ס���
$fl = split( "\.", basename($_SERVER['SCRIPT_NAME']), 2);
$fn = "../data/$fl[0]";
//$fn = "$fl[0]";  // No directory path for PostgreSQL

// DB���ۥ̥��������Υ؀��ࡦ�����������Ρ��ۥʥߥޥ�(�ա��ʥߥޥ����ۥ����)
include "gbpwadd.php";

$mode = '';
if (! empty($_GET['mode']) ) $mode = $_GET['mode'];
     
switch ($mode) {
 case 'read':
	 // ���女��ۥ˥Ρ������ߡ���
	 include "gbread.php";
	 break;
 case 'admin':
	 // ���Υ؀��ࡦ�����������Ρ��ۥ��ۥ̥�
	 include "gbpwchk.php";
	 if (!isset($_POST['GUESTBOOKPASS'])) {
		 // ���Υ؀��ࡦ�����������Υˀ��ޥ�����
		 include "gbpwform.php";
	 } else {
		 // ���女��ۥϥॱ��
		 if (!$_POST['GUESTBOOKFUNC']){
			 // ���女��ۥϥॱ���إࡦ�桦���������
			 include "gbadmform.php";
		 } else {
			 // ���女��ۥϥॱ�������
			 include "gbadmproc.php";
		 }
	 }
	 break;
 default:
	 unset($_POST['GUESTBOOKPASS']);
	 
	 // ���女��
	 if (!$_POST['GuestComment']) {
		 // ���女��إࡦ�桦���������(���̥��ۡ��졣������)
		 include "gbform.php";
	 } else {
		 // �����������͡��������ҥ����奱����
		 include "gbwrite.php";
		 // �ƥ��ʀ��䡢�ꡦ⣥����À���
		 include "gbmail.php";
	 }
	 break;
}

include "gbtrailer.php";
?>
